<?php 
    require_once('./authentication.php'); 

    
    $uid = $_GET['user_id'];

    $sql = "SELECT * FROM certificates WHERE user_id='$uid'";
    $info = $obj_admin->manage_all_info($sql);
    $row = $info->fetch(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 
    $num_row = $info->rowCount();
    if ($num_row == 0) { ?>
        <script>
            Swal.fire({
                title: 'NO Records Found',
                icon: 'error'
            });
        </script>
    <?php header("Location: dashboard.php"); }  ?>

<?php 
    header('Content-type: image/png');
    $image = imagecreatefrompng('Certificate.png');
    $color = imagecolorallocate($image, 134, 91, 52);
    $font = 'GREATVIBES.TTF';
    
    $name = $row['fullname'];
    imagettftext($image, 80, 0, 680, 626, $color, $font, $name);

    $font = "POPPINS.TTF";
    $color = imagecolorallocate($image, 191, 99, 34);

   $course = $row['description'];
   imagettftext($image, 50, 0, 680, 895, $color, $font, $course);

   $date = $row['end_date'];
   $color = imagecolorallocate($image, 0, 0, 0);
   imagettftext($image, 35, 0, 1500, 1100, $color, $font, $date);

   imagepng($image, "certificate_of_".$row['fullname'].".jpg");
   
   imagedestroy($image);
    
   imagedestroy($image);
?>