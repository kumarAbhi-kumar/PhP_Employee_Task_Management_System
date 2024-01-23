<?php 
    include("./includes/header.php");
    include("./includes/sidebar.php");

    if($user_role != 1){
        header("Location: dashboard.php");
    }

    if(isset($_POST['add_new_employee'])){
      $error = $obj_admin->add_new_user($_POST);
    }

    if(isset($_GET['delete_user'])){
        $action_id = $_GET['admin_id'];
      
        $task_sql = "DELETE FROM task_info WHERE t_user_id = $action_id";
        $delete_task = $obj_admin->db->prepare($task_sql);
        $delete_task->execute();
      
        $attendance_sql = "DELETE FROM attendance_info WHERE atn_user_id = $action_id";
        $delete_attendance = $obj_admin->db->prepare($attendance_sql);
        $delete_attendance->execute();
        
        $sql = "DELETE FROM tbl_admin WHERE user_id = :id";
        $sent_po = "manage-employee.php";
        $obj_admin->delete_data_by_this_method($sql,$action_id,$sent_po);
      }
?>


<?php if(isset($_SESSION['update_user_pass'])) {?>
        <script>
            Swal.fire({
                title: 'Password Updated',
                icon: 'success',
            });
        </script>
        
    <?php } unset($_SESSION['update_user_pass']); ?>

<?php if(isset($_SESSION['User_Added'])) {?>
        <script>
            Swal.fire({
                title: 'User Added',
                icon: 'success',
            });
        </script>
        
    <?php } unset($_SESSION['User_Added']); ?>

<?php if(isset($_SESSION['deleted_data'])) {?>
        <script>
            Swal.fire({
                title: 'User Deleted',
                icon: 'success',
            });
        </script>
        
    <?php } unset($_SESSION['deleted_data']); ?>

<main class="flex-1 p-10">
        <div class="bg-white p-6 flex justify-between rounded-md shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-4">Employee Management</h2>
            <!-- Button to open the modal -->
            <button id="openTaskModal" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Add New Employee!
            </button>   
        </div>

        

        <div id="taskModalOverlay" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>

        <div id="taskModal" class="fixed top-1/2 left-1/2 transform w-1/4 -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-md shadow-md hidden">
            <div class="flex justify-between">
                <h2 class="text-lg font-semibold mb-4">Add Employee Details</h2>
                <!-- Close button (cross sign) in the upper right corner -->
                <button id="closeTaskModal" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Task assignment form with fieldset and legend -->
            <form role="form" method="post" action="">
                <fieldset>
                    <!-- <legend class="text-sm font-medium text-gray-700 mb-2">Task Information</legend> -->
                    <div class="mb-4">
                        <label for="taskTitle" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="taskTitle" name="em_fullname" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="taskTitle" class="block text-sm font-medium text-gray-700">UserName</label>
                        <input type="text" id="taskTitle" name="em_username" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="taskTitle" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" id="taskTitle" name="em_email" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                </fieldset>
                <div class="flex justify-end mt-4">
                    <!-- Submit button for the form (replace with actual form submission logic) -->
                    <button type="submit" name="add_new_employee" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Employee</button>
                </div>
            </form>
        </div>

        <section class="container mx-auto p-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div id="printableTable" class="w-full overflow-x-auto">
                    <table class="w-full">  
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">UserName</th>
                                <th class="px-4 py-3">Temp Password</th>
                                <th class="px-4 py-3">Details</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                        <?php 
                            $sql = "SELECT * FROM tbl_admin WHERE user_role = 2 ORDER BY user_id DESC";
                            $info = $obj_admin->manage_all_info($sql);
            
                            $serial  = 1;
                            $total_expense = 0.00;
                            while( $row = $info->fetch(PDO::FETCH_ASSOC) ){
                        ?>
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $serial; $serial++; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['fullname']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['email']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['username']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['temp_password']; ?></td>
                                <td class="px-4 py-3 flex justify-evenly text-md font-semibold border">
                                    <a title="Update User Credentials" href="update-employee.php?admin_id=<?php echo $row['user_id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                            <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                        </svg>
                                    </a>
                                    <a title="Delete User" href="?delete_user=delete_user&admin_id=<?php echo $row['user_id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


    </main>

    <script>
        // Button and modal elements
        // JavaScript to handle modal functionality
        const openTaskModalButton = document.getElementById('openTaskModal');
        const taskModalOverlay = document.getElementById('taskModalOverlay');
        const taskModal = document.getElementById('taskModal');
        const closeTaskModalButton = document.getElementById('closeTaskModal');
    
        // Event listeners
        openTaskModalButton.addEventListener('click', () => {
            taskModalOverlay.classList.remove('hidden');
            taskModal.classList.remove('hidden');
        });
    
        closeTaskModalButton.addEventListener('click', () => {
            taskModalOverlay.classList.add('hidden');
            taskModal.classList.add('hidden');
        });
    </script>

<?php 
    include("./includes/footer.php");
?>