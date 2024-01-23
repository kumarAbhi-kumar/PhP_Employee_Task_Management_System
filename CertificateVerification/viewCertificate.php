<?php 
    require_once('./db.php'); 

    $certificateNumber = $_GET['cert_number'];

    $query = "SELECT * FROM certificates WHERE certificate_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $certificateNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 
    if ($result->num_rows > 0) { ?>
        <script>
            Swal.fire({
                title: 'NO Records Found',
                icon: 'error'
            });
        </script>
    <?php header("Location: verify.php"); }  
?>

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
   header('Location: certificateVerify.php');
?>