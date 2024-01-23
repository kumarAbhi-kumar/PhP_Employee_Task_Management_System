<?php 

    require_once("./authentication.php");
    include("./includes/header.php");


    if(isset($_POST['atd_punch_in'])){
        $obj_admin->atd_puch_in($_POST);
    }

    if(isset($_POST['atd_punch_out'])){
        $obj_admin->atd_punch_out($_POST);
    }

    $page_name="Attendance";
    include("./includes/sidebar.php");

    if(isset($_GET['delete_attendance'])){
        $action_id = $_GET['aten_id'];
        
        $sql = "DELETE FROM attendance_info WHERE aten_id = :id";
        $sent_po = "attendance-logs.php";
        $obj_admin->delete_data_by_this_method($sql,$action_id,$sent_po);
    }
?>

<main class="flex-1 p-10">
    <div class="bg-white p-6 flex justify-between rounded-md shadow-md mb-6">
        <h2 class="text-lg font-semibold mb-4">Attendance Management</h2>
        <!-- Button to open the modal -->
<?php 
            $sql = "SELECT * FROM attendance_info
                    WHERE atn_user_id = $user_id AND out_time IS NULL";
            $info = $obj_admin->manage_all_info($sql);
            $row = $info->fetch(PDO::FETCH_ASSOC);
            $num_of_rows = $info->rowCount();
            if ($num_of_rows == 0) {?>
            <form method="post" role="form">
                <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                <button type="submit" id="atd_punch_in" name="atd_punch_in" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:text-green-700 hover:bg-green-100">
                    Check In!
                </button>
            </form>
    </div>        
<?php } else { ?>
            <form method="post">
                <input type="hidden"  name="punch_in_time" value="<?php echo $row['in_time']?>">
                <input type="hidden"  name="aten_id" value="<?php echo $row['aten_id']?>">
                <button name="atd_punch_out" id="atd_punch_out" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:text-red-700 hover:bg-red-100">
                    Check Out!
                </button>
            </form>
        
    </div>

    <div class="bg-green-100 p-6 flex justify-evenly rounded-md shadow-md mb-6">
        <h2 class="text-lg font-semibold text-green-700 mb-4">Clocked In</h2>
    </div>
<?php }?>

    <section class="container mx-auto p-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">S. N.</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">In Time</th>
                                <th class="px-4 py-3">Out Time</th>
                                <th class="px-4 py-3">Total Duration</th>
                                <?php if($user_role == 1) {?>
                                    <th class="px-4 py-3">Action</th>
                                <?php }?>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php 
                                if($user_role == 1){
                                    $sql = "SELECT a.*, b.fullname 
                                    FROM attendance_info a
                                    LEFT JOIN tbl_admin b ON(a.atn_user_id = b.user_id)
                                    ORDER BY a.aten_id DESC";
                                }else{
                                    $sql = "SELECT a.*, b.fullname 
                                    FROM attendance_info a
                                    LEFT JOIN tbl_admin b ON(a.atn_user_id = b.user_id)
                                    WHERE atn_user_id = $user_id
                                    ORDER BY a.aten_id DESC";
                                }

                                $info = $obj_admin->manage_all_info($sql);
                                $serial = 1;
                                $num_row = $info->rowCount();
                                if ($num_row == 0) {
                                    echo '<tr><td colspan="6" class="px-4 py-3 text-sm border">No Data found</td></tr>';
                                }

                                while( $row = $info->fetch(PDO::FETCH_ASSOC) ){
                            ?>
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $serial; $serial++; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['fullname']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold text-green-700 hover:bg-green-100 border"><?php echo $row['in_time']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold text-yellow-700 hover:bg-yellow-100 border"><?php echo $row['out_time']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php 
                                    if($row['total_duration'] == NULL){
                                        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                                        $current_time = $date->format('d-m-Y H:i:s');

                                        $dteStart = new DateTime($row['in_time']);
                                        $dteEnd   = new DateTime($current_time);
                                        $dteDiff  = $dteStart->diff($dteEnd);
                                        echo $dteDiff->format("%H:%I:%S");  
                                    }
                                    else {
                                        echo $row["total_duration"];
                                    }
                                ?>
                                </td>
                                <?php if($user_role == 1) {  ?>
                                    <td class="px-4 py-3 text-md border">
                                        <a title="Delete" href="?delete_attendance=delete_attendance&aten_id=<?php echo $row['aten_id']; ?>" onclick=" return check_delete(); ?">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </td>
                                <?php } else { ?>
                                    <td></td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                </div>
            </div>
    </section>

</main>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?php 
    // include('includes/footer.php');
?>
