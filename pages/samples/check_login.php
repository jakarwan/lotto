<?php
	session_start();
	include '../../config/config.php';
	$SQL = "SELECT * FROM member WHERE Username = '".mysqli_real_escape_string($conn,$_POST['txtUsername'])."' 
	and Password = '".mysqli_real_escape_string($conn,$_POST['txtPassword'])."'";
	$objQuery = mysqli_query($conn,$SQL);
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{
			//echo "Username and Password Incorrect!";
	}
	else
	{
			$_SESSION["m_id"] = $objResult["m_id"];
			$_SESSION["status"] = $objResult["status"];

			session_write_close();
			
			if($objResult["status"] == "USER")
			{
				header("location:../../index.php");
			}
			else
			{
				echo  '<div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">Close X</a>
                <p><strong>Alerta!</strong></p>
                Email or password wrong! Please try again!.
            </div>';
			}
	}
	mysqli_close($conn);
?>