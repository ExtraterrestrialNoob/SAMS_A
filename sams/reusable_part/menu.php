<?php

include('config/const.php');
include('login-check.php');
include('session-timeout.php');

?>

<html>
<title>SAMS</title>
<link rel="stylesheet" href="css/admin.css">

<body>
    <div class="menu text-center">
    
    <div  class="logo"><img src="img/LOGO.png" width="200" /></div>
    
        <div class="wrapper">
            <ul>
                <li><a href="clc.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-student.php">Student</a></li>
                <li><a href="manage-user.php">User</a></li>
                <li><a href="qr">QR</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>