<?php 
    require('./authentication.php');

    //auth check
    if(isset($_SESSION['admin_id'])){
        $user_id = $_SESSION['admin_id'];
        $user_name = $_SESSION['admin_name'];
        $security_key = $_SESSION['security_key'];
        if ($user_id != NULL && $security_key != NULL) {
          header('Location: dashboard.php');
        }
    }

    if(isset($_POST['login_btn'])){
        $info = $obj_admin->admin_login_check($_POST);
    }

    $page_name="Login";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(120deg, #201a37, black);
        }
        .img-bg{
            background:linear-gradient(#201a37c9, rgba(0, 0, 0, 0.6)), url(./images/office.svg) no-repeat;
            background-position: center;   
        }
        .content{
           /* background-color: black; */
        }
    </style>
    <title>Admin Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  

</head>

<body>
<?php if(isset($info)) {?>
        <script>
            Swal.fire({
                title: 'Invalid Credentials',
                text: '<?php echo $info ?>',
                icon: 'error'
            });
        </script>
    <?php }?>

<div class="img-bg ">

<section class="content flex flex-col md:flex-row items-center justify-center h-screen">
    
    <!-- Left side (Introductory text) -->
    <div class="w-full md:w-1/2 p-4 mb-4 md:mb-0">
        <h1 class="text-6xl font-extrabold mb-4 leading-tight text-white">Welcome to Employee Task Management System Admin Portal!</h1>
        <p class="text-gray-200 mr-6">
            This portal is for authorized administrators only. Please log in to manage employee tasks, projects, and permissions.
        </p>

        <p class="text-gray-200 mt-4">
            <strong>Key features of the Employee Task Management System Admin Portal:</strong>
        </p>

        <ul class="list-disc list-inside text-gray-200">
            <li>Create, edit, and delete employee tasks and projects</li>
            <li>Assign tasks to employees and track their progress</li>
            <li>Set deadlines and priorities for tasks</li>
            <li>View employee task performance and productivity</li>
            <li>Manage employee permissions and access</li>
        </ul>

        <p class="text-gray-200 mt-4">
            Log in now to start managing your employee tasks and projects!
        </p>

        <p class="text-gray-200 mt-4">
            You can also experience benefits such as:
        </p>

        <ul class="list-disc list-inside text-gray-200">
            <li>Increased employee productivity and efficiency</li>
            <li>Improved teamwork and collaboration</li>
            <li>Reduced risk of missed deadlines and project delays</li>
            <li>Better visibility into employee performance and workload</li>
            <li>Improved decision-making and planning</li>
        </ul>
    </div>

    <!-- Right side (Login section) -->
    <div class="w-full md:w-1/4 bg-indigo-950 p-8 shadow-md rounded-md">
        <h2 class="text-3xl font-bold text-center mb-6 p-3 text-blue-300">Login</h2>
        
        <!-- Login form -->
        <form method="post" action="">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium pb-4 text-white">Username</label>
                <input type="text" required id="username" name="username" class="w-full px-3 py-2  rounded-md bg-gray-400 focus:bg-white" autocomplete="off">
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-white pb-4">Password</label>
                <input type="password" required id="password" name="admin_password" class="w-full px-3 py-2  rounded-md bg-gray-400 focus:bg-white" autocomplete="off">
            </div>
            
            <button type="submit" name="login_btn" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Login</button>
        </form>
    </div>
    </section> 
</div>
</body>
</html>