<?php 
    require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Certificate</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Verify Certificate</h2>
        <form action="" method="post" id="verify-form">
            <div class="form-group">
                <label for="cert_number">Certificate Number:</label>
                <input type="text" class="form-control" id="cert_number" name="cert_number" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="verifyCertificate()">Verify</button>
        </form>
    </div>

    <script>
        function verifyCertificate() {
            var cert_number = $("#cert_number").val();
            $.ajax({
                url: 'verify.php',
                type: 'POST',
                data: { certificate_number: cert_number },
                success: function(response) {
                    if (response === 'verified') {
                        swal.fire({
                            title: 'Verified!',
                            text: 'The certificate number ' + cert_number + ' has been verified.',
                            icon: 'success',
                            confirmButtonText: 'Download'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'viewCertificate.php?cert_number=' + cert_number;
                            }
                        });
                    } else {
                        swal.fire({
                            title: 'Error!',
                            text: 'No data found for the certificate number ' + cert_number + '.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    }
                }
            });
        }
    </script>
</body>
</html>