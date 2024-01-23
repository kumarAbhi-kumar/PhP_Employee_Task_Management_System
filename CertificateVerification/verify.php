<?php
// verify.php

require_once 'db.php';

$certificateNumber = $_POST['certificate_number'];

$query = "SELECT * FROM certificates WHERE certificate_number = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $certificateNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
//   $certificateData = json_decode($row['certificate_data'], true); 
  echo "verified";

} else {
  echo "not verified";
}

$stmt->close();
$conn->close();
?>