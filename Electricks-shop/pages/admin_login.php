<?php
    session_start();
    include('../config/dbconn.php');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
            
        $user_unsafe=$_POST['username'];
        $pass_unsafe=$_POST['password'];
          date_default_timezone_set('Asia/pakistan');
        $date = date("Y-m-d H:i:s"); 
		 $query=mysqli_query($dbconn,"SELECT * FROM `admin` WHERE username='$user_unsafe' AND password='$pass_unsafe'");
        $res=mysqli_fetch_array($query);
		 $id=$res['user_id'];
       if (mysqli_num_rows($query)<1){
            $_SESSION['msg']="Login Failed, Admin not found!";
            header('Location:admin_login_page.php');
        }
		else
		{
			 $res=mysqli_fetch_array($query);
            $_SESSION['id']=$res['user_id'];
            header('Location: admin_index.php');
            
            $_SESSION['id']=$id;
            $remarks="(Administrator) has logged in the system at ";  
            mysqli_query($dbconn,"INSERT INTO logs(user_id,action,date) VALUES('$id','$remarks','$date')")or die(mysqli_error($dbconn));
		}

        }
?>
