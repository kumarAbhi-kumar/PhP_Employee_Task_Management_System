<?php 
    require_once("./authentication.php");
    include("./includes/header.php");

    // admin check 
    $user_role = $_SESSION['user_role'];

    $admin_id = $_GET['admin_id'];

    if(isset($_POST['btn_admin_password'])){
        $error = $obj_admin->admin_password_change($_POST,$admin_id);
    }

    $page_name="Admin";
    include("./includes/sidebar.php");

?>

<?php if(isset($error)){ ?>
    <script>
            Swal.fire({
                title: 'Invalid Credentials',
                text: '<?php echo $info ?>',
                icon: 'error'
            });
        </script>
<?php } ?>

<div class="fixed top-0 left-0 w-full h-full bg-black opacity-50"></div>

   <div class="fixed top-1/2 left-1/2 transform w-1/4 -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-md shadow-md">
    <div class="flex justify-between">
        <h2 class="text-lg font-semibold mb-4">Change Admin Password</h2>
            <button id="closeTaskModal"  class="text-gray-500 hover:text-gray-700">
                <a href="manage-admin.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </button>
    </div>
    <form role="form" action="" method="post" autocomplete="off">
    <!-- Task assignment form with fieldset and legend -->
    <div class="mb-4">
        <label for="admin_old_password" class="block text-sm font-medium text-gray-700">Old Password</label>
        <input placeholder="Enter Old Password" type="text" id="taskTitle" name="admin_old_password" class="mt-1 p-2 w-full border rounded-md" val required>
    </div>
    <div class="mb-4">
        <label for="admin_new_password" class="block text-sm font-medium text-gray-700">New Password</label>
        <input placeholder="Enter Old Password" type="text" id="taskTitle" name="admin_new_password" class="mt-1 p-2 w-full border rounded-md" val required>
    </div>
    <div class="mb-4">
        <label for="admin_cnew_password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
        <input placeholder="Enter Old Password" type="text" id="taskTitle" name="admin_cnew_password" class="mt-1 p-2 w-full border rounded-md" val required>
    </div>
    
   <div class="flex justify-end mt-4">
        <button type="submit" name="btn_admin_password" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Task</button>
    </div>
    </form>
   </div>
