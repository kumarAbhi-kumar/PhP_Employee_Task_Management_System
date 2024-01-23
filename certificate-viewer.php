<?php 
    include ("./includes/header.php");
    include ("./includes/sidebar.php");
?>

<main class="flex-1 p-10">

<?php if ($user_role == 1){ ?>
   
    <section class="container mx-auto p-6 pt-0 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Certificate Number</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Description</th>
                                <th class="px-4 py-3">Start Date</th>
                                <th class="px-4 py-3">End Date</th>
                                <th class="px-4 py-3">View</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php 
                                $sql = "SELECT * FROM certificates";
                                $info = $obj_admin->manage_all_info($sql);
                                $num_row = $info->rowCount();
                                $serial = 1;
                                $num_row = $info->rowCount();
                                if ($num_row == 0) {
                                    echo '<tr><td colspan="7" class="px-4 py-3 text-sm border">No Data found</td></tr>';
                                }

                                while( $row = $info->fetch(PDO::FETCH_ASSOC) ){
                            ?>
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $serial; $serial++; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['certificate_number']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['fullname']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['description']; ?></td>
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['start_date']; ?></td> 
                                <td class="px-4 py-3 text-md font-semibold border"><?php echo $row['end_date']; ?></td> 
                                <td class="px-4 py-3 text-md font-semibold border">
                                    <form action="post"></form>
                                    <a title="Updae Task" href="viewCertificate.php?user_id=<?php echo $row['user_id'];?>" >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                                <?php } ?>
                        </tbody>
                </div>
            </div>
    </section>
<?php } ?>

</main>
<?php include("./includes/footer.php")?>