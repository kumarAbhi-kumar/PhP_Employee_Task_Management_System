<div class="flex h-screen ">
    <!-- Sidebar -->
    <aside class="w-64 p-6 text-white">
        <div class="mb-8">
            <h2 class="text-2xl font-bold">Employee Task System</h2>
        </div>
        <nav>
            <ul>
                <?php
                    $user_role = $_SESSION['user_role'];
                    $user_id = $_SESSION['admin_id'];
                    if($user_role == 1){
                ?>
                <li class="mb-2">
                    <a href="dashboard.php" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="attendance-logs.php" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c5.51 0 10 4.49 10 10s-4.49 10-10 10-10-4.49-10-10 4.49-10 10-10zM12 6v8l3 3v2H9v-2l3-3V6z"></path>
                        </svg>
                        Attendance
                    </a>
                </li>
                <li class="mb-2">
                    <a href="attendance-report.php" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c5.51 0 10 4.49 10 10s-4.49 10-10 10-10-4.49-10-10 4.49-10 10-10zM12 6v8l3 3v2H9v-2l3-3V6z"></path>
                        </svg>
                        Attendance Report
                    </a>
                </li>
                <li class="mb-2">
                    <a href="manage-admin.php" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c5.51 0 10 4.49 10 10s-4.49 10-10 10-10-4.49-10-10 4.49-10 10-10zM12 6v8l3 3v2H9v-2l3-3V6z"></path>
                        </svg>
                        Mangae Admins
                    </a>
                </li>
                <li class="mb-2">
                    <a href="manage-employee.php" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c5.51 0 10 4.49 10 10s-4.49 10-10 10-10-4.49-10-10 4.49-10 10-10zM12 6v8l3 3v2H9v-2l3-3V6z"></path>
                        </svg>
                        Manage Employee
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c5.51 0 10 4.49 10 10s-4.49 10-10 10-10-4.49-10-10 4.49-10 10-10zM12 6v8l3 3v2H9v-2l3-3V6z"></path>
                        </svg>
                        Task Report
                    </a>
                </li>
                <li class="mb-2">
                    <a href="certificate-generator.php" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c5.51 0 10 4.49 10 10s-4.49 10-10 10-10-4.49-10-10 4.49-10 10-10zM12 6v8l3 3v2H9v-2l3-3V6z"></path>
                        </svg>
                        Certificate Generator
                    </a>
                </li>
                <li class="mb-2">
                    <a href="certificate-viewer.php" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c5.51 0 10 4.49 10 10s-4.49 10-10 10-10-4.49-10-10 4.49-10 10-10zM12 6v8l3 3v2H9v-2l3-3V6z"></path>
                        </svg>
                        Certificate Viewer
                    </a>
                </li>
                <li>
                    <a href="?logout=logout" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        Logout
                    </a>
                </li>
                <?php } else { ?>
                <li class="mb-2">
                    <a href="dashboard.php" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="attendance-logs.php" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c5.51 0 10 4.49 10 10s-4.49 10-10 10-10-4.49-10-10 4.49-10 10-10zM12 6v8l3 3v2H9v-2l3-3V6z"></path>
                        </svg>
                        Attendance
                    </a>
                </li>
                <li class="mb-2">
                    <a href="viewCertificate.php?user_id=<?php echo $user_id;?>" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2c5.51 0 10 4.49 10 10s-4.49 10-10 10-10-4.49-10-10 4.49-10 10-10zM12 6v8l3 3v2H9v-2l3-3V6z"></path>
                        </svg>
                        View Certificate
                    </a>
                </li>
                <li>
                    <a href="?logout=logout" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        Logout
                    </a>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </aside>
