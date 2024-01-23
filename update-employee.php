<?php 
    include("./includes/header.php");
    include("./includes/sidebar.php");

    if($user_role != 1){
        header("Location: dashboard.php");
    }

    $admin_id = $_GET['admin_id'];

    if(isset($_POST['update_current_employee'])){
        $obj_admin->update_user_data($_POST,$admin_id);
    }

    if(isset($_POST['btn_user_password'])){
        $obj_admin->update_user_password($_POST,$admin_id);
    }

    $sql = "SELECT * FROM tbl_admin WHERE user_id='$admin_id' ";
    $info = $obj_admin->manage_all_info($sql);
    $row = $info->fetch(PDO::FETCH_ASSOC);

?>

<div class="fixed top-0 left-0 w-full h-full bg-black opacity-50"></div>

   <div class="fixed top-1/2 left-1/2 transform w-1/4 -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-md shadow-md">
    <div class="flex justify-between">
        <h2 class="text-lg font-semibold mb-4">Edit Task</h2>
            <button id="closeTaskModal"  class="text-gray-500 hover:text-gray-700">
                <a href="manage-employee.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </button>
    </div>
    <form role="form" action="" method="post" autocomplete="off">
    <!-- Task assignment form with fieldset and legend -->
        <div class="mb-4">
            <label for="task_title" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" id="em_fullname" name="em_fullname" class="mt-1 p-2 w-full border rounded-md" value="<?php echo $row['fullname']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="task_title" class="block text-sm font-medium text-gray-700">UserName</label>
            <input type="text" id="em_username" name="em_username" class="mt-1 p-2 w-full border rounded-md" value="<?php echo $row['username']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="task_title" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="em_email" name="em_email" class="mt-1 p-2 w-full border rounded-md" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="flex justify-end mt-4">
    <!-- Submit button for the form (replace with actual form submission logic) -->
            <button type="submit" name="update_current_employee" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Emplyee Details</button>
        </div>

    </form>

    <form action="" method="post" role="form" autocomplete="off">
        <div class="mb-4">
            <label for="task_title" class="block text-sm font-medium text-gray-700">New Passowrd</label>
            <input type="text" id="employee_password" name="employee_password" class="mt-1 p-2 w-full border rounded-md"  required>
        </div>
        <div class="flex justify-end mt-4">
    <!-- Submit button for the form (replace with actual form submission logic) -->
            <button type="submit" name="btn_user_password" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Passowrd</button>
        </div>
    </form>
    
   </div>

   
