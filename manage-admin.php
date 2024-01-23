<?php 
    include("./includes/header.php");
    include("./includes/sidebar.php");

    $page_name = "Admin";

    

    if(isset($_POST['update_current_employee'])){
        $obj_admin->update_admin_data($_POST,$user_id);
    }
?>

<main class="flex-1 p-10">
        <div class="bg-white p-6 rounded-md flex justify-between shadow-md mb-6">
            <h2 class="text-lg font-semibold ">Task Management</h2>
            <!-- Button to open the modal -->
            <button id="openTaskModal" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Edit Your Info!
            </button>
        </div>

        <div id="taskModalOverlay" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>

        <div id="taskModal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-md shadow-md hidden">
            <div class="flex justify-end">
                <!-- Close button (cross sign) in the upper right corner -->
                <button id="closeTaskModal" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <h2 class="text-lg font-semibold mb-4">Edit Admin Info</h2>
            <!-- Task assignment form with fieldset and legend -->
            <form role="form" action="" method="post" autocomplete="off">
                <fieldset>
                    <?php  
                        $sql = "SELECT * FROM tbl_admin WHERE user_id = ".$user_id;
                        $info = $obj_admin->manage_all_info($sql);
                        $row = $info->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="mb-4">
                        <label for="fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="fu" name="em_fullname" value="<?php echo $row['fullname']; ?>" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="em_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" id="fu" name="em_email" value="<?php echo $row['email']; ?>" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="em_username" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="fu" name="em_username" value="<?php echo $row['username']; ?>" class="mt-1 p-2 w-full border rounded-md">
                    </div>
                </fieldset>
                <div class="flex justify-evenly mt-4">
                    <button type="submit" name="update_current_employee" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update</button>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        <a href="admin-password-change.php?admin_id=<?php echo $row['user_id']; ?>">Change Password</a>
                    </button>
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
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                        <?php 
                            $sql = "SELECT * FROM tbl_admin WHERE user_role = 1";
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
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

</main>

<script>

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