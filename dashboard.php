<?php 
    require_once("./authentication.php");
    include("./includes/header.php");
    include("./includes/sidebar.php");

    $user_role = $_SESSION['user_role'];

    if(isset($_POST['add_task_post'])){
        $obj_admin->add_new_task($_POST);
    }

    if(isset($_GET['delete_task'])){
        $action_id = $_GET['task_id'];
        
        $sql = "DELETE FROM task_info WHERE task_id = :id";
        $sent_po = "dashboard.php";
        $obj_admin->delete_data_by_this_method($sql,$action_id,$sent_po);
      }
    
?>

<?php if(isset($_SESSION['Task_msg'])) {?>
        <script>
            Swal.fire({
                title: 'Done!',
                text: '<?php echo $_SESSION['Task_msg']; ?>',
                icon: 'success';
            });
        </script>
    <?php }?>

    <?php if(isset($_SESSION['update_user_pass'])) {?>
        <script>
            Swal.fire({
                title: 'Password Updated',
                icon: 'success',
            });
        </script>
        
    <?php } unset($_SESSION['update_user_pass']); ?>

<main class="flex-1 p-10">
        <div class="bg-white p-6 rounded-md shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-4">Task Overview</h2>
            <div class="grid grid-cols-3 gap-4">
                <?php 
                    
                    for ($status = 0; $status <= 2; $status++) {
                        // SQL query for the current status
                        if($user_role == 1){
                            $sql = "SELECT COUNT(*) as status_count FROM task_info WHERE status = $status";
                        }
                        else{
                            $sql = "SELECT COUNT(*) as status_count FROM task_info WHERE status = $status AND t_user_id = ".$user_id;
                        }
                    
                        // Execute the query
                        $result = $obj_admin->manage_all_info($sql);
                    
                        
                        // Fetch the result as an associative array
                        $row = $result->fetch(PDO::FETCH_ASSOC);
                        $statusCounts[$status] = $row['status_count'];
                    
                            // Free the result set
                        $result->closeCursor();
                    }
                ?>
                <div class="p-4 bg-blue-200 rounded-md">
                    <p class="text-xl font-bold text-blue-800"><?php echo $statusCounts[0]+$statusCounts[1]+$statusCounts[2];?></p>
                    <p class="text-gray-600">Total Tasks</p>
                </div>
                <div class="p-4 bg-green-200 rounded-md">
                    <p class="text-xl font-bold text-green-800"><?php echo $statusCounts[2];?></p>
                    <p class="text-gray-600">Completed Tasks</p>
                </div>
                <div class="p-4 bg-yellow-200 rounded-md">
                    <p class="text-xl font-bold text-yellow-800"><?php echo $statusCounts[1];?></p>
                    <p class="text-gray-600">Tasks in Progress</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-md flex justify-between shadow-md mb-6">
            <h2 class="text-lg font-semibold ">Task Management</h2>
            <!-- Button to open the modal -->
            <button id="openTaskModal" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Assign New Task
            </button>
        </div>

        <div id="taskModalOverlay" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>

        <!-- Modal content -->

        <div id="taskModal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-md shadow-md hidden">
            <div class="flex justify-end">
                <!-- Close button (cross sign) in the upper right corner -->
                <button id="closeTaskModal" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <h2 class="text-lg font-semibold mb-4">Assign New Task</h2>
            <!-- Task assignment form with fieldset and legend -->
            <form role="form" action="" method="post" autocomplete="off">
                <fieldset>
                    <legend class="text-sm font-medium text-gray-700 mb-2">Task Information</legend>
                    <div class="mb-4">
                        <label for="taskTitle" class="block text-sm font-medium text-gray-700">Task Title</label>
                        <input type="text" id="taskTitle" required name="task_title" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="employeeSelect" class="block text-sm font-medium text-gray-700">Select Employee</label>
                            <?php 
                                $sql = "SELECT user_id, fullname FROM tbl_admin WHERE user_role = 2";
                                $info = $obj_admin->manage_all_info($sql);   
                            ?>
                        <select id="employeeSelect" name="assign_to[]" required class="mt-1 p-2 w-full border rounded-md">
                            <option value="">Select Emloyee</option>

                            <?php while($row = $info->fetch(PDO::FETCH_ASSOC)){ ?>
                                <option value="<?php echo $row['user_id']; ?>"><?php echo $row['fullname']; ?></option>
                            <?php } ?>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="taskDescription" class="block text-sm font-medium text-gray-700">Task Description</label>
                        <textarea id="taskDescription" required name="task_description" rows="3" class="mt-1 p-2 w-full border rounded-md"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <!-- Assign Time (Start Time) -->
                        <div>
                            <label for="startTime" class="block text-sm font-medium text-gray-700">Start Time</label>
                            <input type="text" required id="startTime" name="t_start_time" class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <!-- Deadline -->
                        <div>
                            <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                            <input type="text" required id="deadline" name="t_end_time" class="mt-1 p-2 w-full border rounded-md">
                        </div>
                    </div>
                </fieldset>
                <div class="flex justify-end mt-4">
                    <!-- Submit button for the form (replace with actual form submission logic) -->
                    <button type="submit" name="add_task_post" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Assign Task</button>
                </div>
            </form>
        </div>

        <section class="container mx-auto p-6 pt-0 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">S.N.</th>
                                <th class="px-4 py-3">Task Title</th>
                                <th class="px-4 py-3">Assigned To</th>
                                <th class="px-4 py-3">Start Time</th>
                                <th class="px-4 py-3">Deadline</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php 
                                if($user_role == 1){
                                    $sql = "SELECT a.*, b.fullname 
                                          FROM task_info a
                                          INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id)
                                          ORDER BY a.task_id DESC";
                                  }else{
                                    $sql = "SELECT a.*, b.fullname 
                                    FROM task_info a
                                    INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id)
                                    WHERE a.t_user_id = $user_id
                                    ORDER BY a.task_id DESC";
                                  } 

                                $info = $obj_admin->manage_all_info($sql);
                                $serial = 1;
                                $num_row = $info->rowCount();
                                if ($num_row == 0) {
                                    echo '<tr><td colspan="7" class="px-4 py-3 text-sm border">No Data found</td></tr>';
                                }

                                while( $row = $info->fetch(PDO::FETCH_ASSOC) ){
                            ?>
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $serial; $serial++; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['t_title']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['fullname']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['t_start_time']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['t_end_time']; ?></td>
                                <?php 
                                    if($row['status'] == 1){
                                        echo '<td class="px-4 py-3 text-md hover:bg-gray-100 text-orange-700 font-semibold border">In Progress</td>';
                                    }
                                    elseif($row['status'] == 2){
                                        echo '<td class="px-4 py-3 text-md hover:bg-green-100 text-green-700 font-semibold border">Completed</td>';
                                    }
                                    else {
                                        echo '<td class="px-4 py-3 text-md hover:bg-red-100 text-red-700 font-semibold border">In-Complete</td>';
                                    }
                                ?>  
                                <td class="px-4 py-3 flex justify-evenly text-md font-semibold border">
                                    <a title="Updae Task" href="edit-task.php?task_id=<?php echo $row['task_id'];?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                            <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                        </svg>
                                    </a>
                                    <?php if($user_role == 1) { ?>
                                    <a title="Delete Task" href="?delete_task=delete_task&task_id=<?php echo $row['task_id'];?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                </div>
            </div>
    </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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



        flatpickr('#deadline', {
	        enableTime: true,
            minDate: "today",
	    });

        flatpickr('#startTime', {
            enableTime: true,
            minDate: "today",
        });

    </script>



<?php include("./includes/footer.php") ?>