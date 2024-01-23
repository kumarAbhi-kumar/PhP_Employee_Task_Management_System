<?php 
    require_once("./authentication.php");
    include("./includes/header.php");
    include("./includes/sidebar.php");


    if(isset($_POST["update_user_psd"])){
        $obj_admin->update_user_psd($_POST, $user_id);
    }

?>

<div class="fixed top-0 left-0 w-full h-full bg-black opacity-50"></div>

   <div class="fixed top-1/2 left-1/2 transform w-1/4 -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-md shadow-md">
    <div class="flex justify-between">
        <h2 class="text-lg font-semibold mb-4">Change Password</h2>
            <button id="closeTaskModal"  class="text-gray-500 hover:text-gray-700">
                <a href="dashboard.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </button>
    </div>
    <form role="form" action="" method="post" autocomplete="off">
    <!-- Task assignment form with fieldset and legend -->
        <div class="mb-4">
            <label for="newPsd" class="block text-sm font-medium text-gray-700">Enter New Password</label>
            <input type="text" id="taskTitle" name="employee_password" class="mt-1 p-2 w-full border rounded-md" required>
        </div>
    
        <div class="flex justify-end mt-4">
            <button type="submit" name="update_user_psd" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Password</button>
        </div>
    </form>
   </div>