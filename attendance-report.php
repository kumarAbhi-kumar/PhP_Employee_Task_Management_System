<?php 
    require_once("./authentication.php");
    require_once("./includes/header.php");

    // check admin
    $user_role = $_SESSION['user_role'];

    $page_name = "Attendance Report";
    include("./includes/sidebar.php");

    if(isset($_POST["filter_date"])){
        
        header("Location: attendance-report.php?date=".$_POST['dt']);
    }

?>

<?php $date = isset($_GET['date']) ? date("Y-m-d", strtotime($_GET['date'])) : date('Y-m-d') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<main class="flex-1 p-10">
    <div class="bg-white flex justify-between rounded-md shadow-md mb-6">
        <h2 class="text-lg px-4 py-2 font-semibold mb-4">Attendance Management</h2>
        <div class="p-6 flex justify-evenly rounded-md">
        <form action="attendance-report.php" method="GET" id="filterForm">
            <input name="dt" type="date" id="date" value="<?= $date ?>" class="border">
            <button class="bg-blue-500 mr-2 ml-2 text-white px-4 py-2 rounded-md hover:bg-blue-600" type="button" id="filter">
                Filter
            </button>
        </form>
        <button id="printButton" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600" onclick="printDiv()">
            Print
        </button>
        </div>
    </div>

    <section class="container mx-auto p-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div id="printableTable" onclick="printDiv()" class="w-full overflow-x-auto">
                    <table class="w-full">
                        
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">S. N.</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">In Time</th>
                                <th class="px-4 py-3">Out Time</th>
                                <th class="px-4 py-3">Total Duration</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                        <?php 
                            $sql = "SELECT a.*, b.fullname 
                            FROM attendance_info a
                            LEFT JOIN tbl_admin b ON(a.atn_user_id = b.user_id) where ('{$date}' BETWEEN date(a.in_time) and date(a.out_time))
                            ORDER BY a.aten_id DESC";
                            $info = $obj_admin->manage_all_info($sql);
                            $serial  = 1;
                            $num_row = $info->rowCount();
                            if($num_row==0){
                              echo '<tr><td colspan="7">No Data found</td></tr>';
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
                            </tr>
                            <?php } ?>
                        
                        </tbody>
                        
                    </table>
                </div>
            </div>
    </section>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>  
</main>

<script>
    document.getElementById('filter').addEventListener('click', function() {
        var selectedDate = document.getElementById('date').value;
        var url = 'attendance-report.php?date=' + selectedDate;
        window.location.href = url;
    });

    function printDiv() {
     window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTable").innerHTML;
     window.frames["print_frame"].window.focus();
     window.frames["print_frame"].window.print();
   }
</script>

<?php include('./includes/footer.php') ?>