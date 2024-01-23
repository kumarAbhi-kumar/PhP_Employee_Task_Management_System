<?php 
    require_once("./authentication.php");

    // auth check
    $user_id = $_SESSION['admin_id'];
    $user_name = $_SESSION['name'];
    $security_key = $_SESSION['security_key'];
    $user_role = $_SESSION['user_role'];
    
    if( $user_id == NULL || $security_key == NULL ){
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETMS | by Kumar Abhishek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
     
    <style>
        /* Main Background */
        body {
            /* background:  #ec6ead; */
            background:  #ebc6e6;
        }
        
        /* Sidebar Styles */
        aside {
            /* background: linear-gradient(135deg, #3494e6, #ec6ead);  */
            background: linear-gradient(120deg, #211b39, #ff00f1);

        }
    
        aside nav ul li {
            padding: 10px; /* Adjust spacing between list items */
            transition: background 0.3s ease; /* Add a smooth transition effect */
        }
    
        aside nav ul li:hover {
            background: rgba(255, 255, 255, 0.2); /* Light background on hover */
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>