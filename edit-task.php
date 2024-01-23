<?php 
    require_once('./authentication.php');
    require_once('./includes/header.php');
    require_once('./includes/sidebar.php');

    // check admin
    $user_role = $_SESSION['user_role'];

    $task_id = $_GET['task_id'];

    if(isset($_POST['update_task_info'])){
        $obj_admin->update_task_info($_POST,$task_id, $user_role);
    }

    $page_name="Edit Task";

    $sql = "SELECT * FROM task_info WHERE task_id='$task_id' ";
    $info = $obj_admin->manage_all_info($sql);
    $row = $info->fetch(PDO::FETCH_ASSOC);
?>

<div class="fixed top-0 left-0 w-full h-full bg-black opacity-50"></div>

   <div class="fixed top-1/2 left-1/2 transform w-1/4 -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-md shadow-md">
    <div class="flex justify-between">
        <h2 class="text-lg font-semibold mb-4">Edit Task</h2>
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
        <label for="task_title" class="block text-sm font-medium text-gray-700">Task Title</label>
        <input type="text" id="taskTitle" name="task_title" class="mt-1 p-2 <?php if($user_role != 1){ ?> bg-gray-200 <?php } ?> w-full border rounded-md" value="<?php echo $row['t_title']; ?>" <?php if($user_role != 1){ ?> readonly <?php } ?> val required>
    </div>
    <div class="mb-4">
        <label for="task_description" class="block text-sm font-medium text-gray-700">Task Description</label>
        <textarea <?php if($user_role != 1){ ?> readonly <?php } ?> required name="task_description" rows="3" class="mt-1 p-2 w-full border <?php if($user_role != 1){ ?> bg-gray-200 <?php } ?> rounded-md" ><?php echo $row['t_description']; ?></textarea>
    </div>
    <div class="mb-4">
        <label for="aasign_to" class="block text-sm font-medium text-gray-700">Assign To</label>
        <?php 
			$sql = "SELECT user_id, fullname FROM tbl_admin WHERE user_role = 2";
			$info = $obj_admin->manage_all_info($sql);   
		?>
        <select name="assign_to" id="" class="mt-1 p-2 w-full <?php if($user_role != 1){ ?> bg-gray-200 <?php } ?> border rounded-md" <?php if($user_role != 1){ ?> disabled="true" <?php } ?>>
            <option value="">Select Employee</option>
            <?php while($rows = $info->fetch(PDO::FETCH_ASSOC)){ ?>
			    <option value="<?php echo $rows['user_id']; ?>"
                    <?php
			            if($rows['user_id'] == $row['t_user_id']){
			        ?>
                    selected
                    <?php } ?>>
                    <?php 
                        echo $rows['fullname']; ?>
                </option>
			<?php } ?>
        </select>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-4">
        <!-- Assign Time (Start Time) -->
        <div>
            <label for="startTime" class="block text-sm font-medium text-gray-700">Start Time</label>
            <input type="text" id="t_start_time" name="t_start_time" class="mt-1 p-2 w-full <?php if($user_role != 1){ ?> bg-gray-200 <?php } ?> text-gray-700 border rounded-md" value="<?php echo $row['t_start_time']; ?>"  required  />
        </div>
        <!-- Deadline -->
        <div>
            <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
            <input type="text" id="t_end_time" name="t_end_time" class="mt-1 p-2 <?php if($user_role != 1){ ?> bg-gray-200 <?php } ?> w-full border rounded-md" value="<?php echo $row['t_end_time']; ?>" required  />
        </div>
   </div>
   <div class="mb-4">
    <label for="status" class="block text-sm font-medium text-gray-700">Status
        <select name="status" class="mt-1 p-2 w-full border rounded-md" id="">
            <option value="0" <?php if($row['status'] == 0){ ?>selected <?php } ?>>In-Complete</option>
            <option value="1" <?php if($row['status'] == 1){ ?>selected <?php } ?>>In-Progress</option>
            <option value="2" <?php if($row['status'] == 2){ ?>selected <?php } ?>>Completed</option>
        </select>
    </label>
   </div>
   <div class="flex justify-end mt-4">
    <!-- Submit button for the form (replace with actual form submission logic) -->
        <button type="submit" name="update_task_info" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Task</button>
    </div>
    </form>
   </div>

   
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

	<script type="text/javascript">
	  flatpickr('#t_start_time', {
	    enableTime: true,
        dateFormat: "Y-m-d H:i:s",
        <?php if($user_role == 1) {?>
            minDate: "<?php echo $row['t_start_time'];?>",
        <?php } else {?>
            minDate: "<?php echo "today";?>",
            maxDate: "<?php echo "today";?>"
        <?php }?>
	  });

	  flatpickr('#t_end_time', {
	    enableTime: true,
        dateFormat: "Y-m-d H:i:s",
        <?php if($user_role == 1) { ?>
            minDate: "<?php echo $row['t_start_time'];?>",
        <?php } else { ?>
            minDate: "<?php echo $row['t_end_time'];?>",
            maxDate: "<?php echo $row['t_end_time'];?>"
        <?php }?>
	  });

	</script>


<?php 
    require_once('./includes/footer.php');
?>