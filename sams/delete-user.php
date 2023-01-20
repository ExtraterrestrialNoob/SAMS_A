<?php

//include constants
include('config/const.php');
//include('../dbcon.php'); 
//get the id of admin to be deleted
$id = $_GET['id'];

//create sql query to delete admin
$sql = "DELETE FROM users WHERE user_id=$id";

//execute query
$res = mysqli_query($conn, $sql);

//check whether the query executed or not
if ($res == true) {


  //query executed
  // echo "admin deleted";
  //create session variable to diplay message
  $_SESSION['delete'] = "<div class='success'>Admin delete successfully.</div>";

  //redirect to manage admin page
  header('location:' . SITEURL . 'admin/manage-user.php');
} else {

  //not exequted
  //echo "admin not deleted";
  $_SESSION['delete'] = "<div class='error'>Admin delete un successfully</div>";
  //redirect to manage admin page
  header('location:' . SITEURL . 'admin/manage-user.php');
}

  //redirect to manage admin page with message(seccess/error) 


  $id = $_GET['id'];

  //create sql query to delete admin
  $sql = "DELETE FROM roll WHERE user_id=$id";
  
  //execute query
  $res = mysqli_query($conn, $sql);
  
  //check whether the query executed or not
  if ($res == true) {
  
  
    //query executed
    // echo "admin deleted";
    //create session variable to diplay message
    $_SESSION['delete'] = "<div class='success'>Admin delete successfully.</div>";
  
    //redirect to manage admin page
    header('location:' . SITEURL . 'admin/manage-user.php');
  } else {
  
    //not exequted
    //echo "admin not deleted";
    $_SESSION['delete'] = "<div class='error'>Admin delete un successfully</div>";
    //redirect to manage admin page
    header('location:' . SITEURL . 'admin/manage-user.php');
  }
  
    //redirect to manage admin page with message(seccess/error) 
  