<?php include('config/const.php');

?>
<html>
<head>
<title>
Login System
</title>
<link rel="stylesheet" type="text/css" href="style.css">

<link rel="stylesheet" href="css/admin.css">
</head>
<body>
<!-- <div class="dg" class="img">
    <div class="img"><center><img src="../img/LOGO.png" /></center></div>
</div> -->
<div style="text-align: right"><img src="img/LOGO.png" width="300" /></div>

<div class="form-wrapper">
  <form action="#" method="post">
    <h3>Login here</h3>
	
    <div class="form-item">
		<input type="text" name="user" required="required" placeholder="Username" autofocus required></input>
    </div>
    
    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Password" required></input>
    </div>
    
    <div class="button-panel">
		<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
    </div>
  </form>
  <?php
  if (isset($_POST['login']))
		{
			$username = mysqli_real_escape_string($conn, $_POST['user']);
			// $password = mysqli_real_escape_string($con, $_POST['pass']);
			
			$query = "SELECT * FROM roll WHERE  username='$username'";
			$num_row = mysqli_query($conn, $query);
			// $row		= mysqli_fetch_array($query);
			// $num_row 	= mysqli_num_rows($query);
			
			if (mysqli_num_rows($num_row) > 0) 
				{	
					foreach($num_row as $data){
						$id = $data['id'];
						$username = $data['username'];
						$rolls = $data['rolls'];
			  
					}
					$_SESSION['auth'] = true;
					$_SESSION['auth_role'] = "$rolls"; // 1 = admin , 0 = user
					$_SESSION['auth_user'] = [
						'id'=>$id,
						'username'=>$username,
						
					];
					if($_SESSION['auth_role'] == '1') //1 = admin
         {
			if (isset($_POST['login'])) {
				
			
				$username = mysqli_real_escape_string($conn, $_POST['user']);
				$password =  mysqli_real_escape_string($conn, (md5($_POST['pass'])));
				// //sql to check whether the username and password exits or not
				$sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
			
				// //execute the query
				$res = mysqli_query($conn, $sql);
			
				// //count rows to check wether the user exits or not
				$count = mysqli_num_rows($res);
				// echo $count;
			
				if ($count == 1) {
			
					//user found and login success
					$_SESSION['login'] = " <div class='success'>Login Successfull</div>";
					$_SESSION['user'] = $username; //to check whether the user logged in or not and logout will unset it
					$_SESSION['jjk'] = $username; 
					$_SESSION['login_time'] = time();
			
					//redirect home page dashbord
					header("location:" . SITEURL . 'clc.php');
				}else  {

					echo '<span style="color:#FF0000;text-align:center;">Invalid Username and Password Combination</span>';
					
			
					//no user and login fail
					// $_SESSION['login'] = " <div class='error'>Login UnSuccessfull</div>";
			
					// //redirect to login page
					// header("location:" . SITEURL . 'index.php');
				}
			}
     
         }
         elseif($_SESSION['auth_role'] == '0') //0 = user
         {
			if (isset($_POST['login'])) {
				
			
				$username = mysqli_real_escape_string($conn, $_POST['user']);
				$password =  mysqli_real_escape_string($conn, (md5($_POST['pass'])));
				// //sql to check whether the username and password exits or not
				$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			
				// //execute the query
				$res = mysqli_query($conn, $sql);
			
				// //count rows to check wether the user exits or not
				$count = mysqli_num_rows($res);
				
			
				if ($count == 1) {
			
					//user found and login success
					$_SESSION['login'] = " <div class='success'>Login Successfull</div>";
					// $_SESSION['user'] = $username; 
					$_SESSION['jjk'] = $username; //to check whether the user logged in or not and logout will unset it
					
					$_SESSION['login_time'] = time();
			
					//redirect home page dashbord
					header("location:" . SITEURL . 'qr/index.php');
				} else {
			
					//no user and login fail
					// $_SESSION['login'] = " <div class='error'>Login UnSuccessfull</div>";
					echo '<span style="color:#FF0000;text-align:center;">Invalid Username and Password Combination</span>';
					
			
					//redirect to login page
					// header("location:" . SITEURL . 'index.php');
				}
			}
       
         }		
		//  echo '<span style="color:#FF0000;text-align:center;">Invalid Username and Password Combination</span>';
					// $_SESSION['user_id']=$row['user_id'];
					// header('location:qr/index.php');
					
				}
			else
				{
					echo '<span style="color:#FF0000;text-align:center;">Invalid Username and Password Combination</span>';
					// header('location:qr/index.php');
				
					// echo 'Invalid Username and Password Combination';
				}
		}



	// if (isset($_POST['login']))
	// 	{
	// 		$username = mysqli_real_escape_string($con, $_POST['user']);
	// 		$password = mysqli_real_escape_string($con, $_POST['pass']);
			
	// 		$query 		= mysqli_query($con, "SELECT * FROM users WHERE  password='$password' and username='$username'");
	// 		$row		= mysqli_fetch_array($query);
	// 		$num_row 	= mysqli_num_rows($query);
			
	// 		if ($num_row > 0) 
	// 			{			
	// 				$_SESSION['user_id']=$row['user_id'];
	// 				header('location:qr/index.php');
					
	// 			}
	// 		else
	// 			{
	// 				echo 'Invalid Username and Password Combination';
	// 			}
	// 	}
  ?>





  <div class="reminder">
    <p>Not a member? <a href="#">Sign up now</a></p>
    <p><a href="#">Forgot password?</a></p>
  </div>
  
</div>

</body>
</html>