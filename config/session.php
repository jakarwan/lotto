<?php	
function LogOut() {
		global $config;
		session_destroy();
		//header("Location: {$config['siteVRoot']}index.php");
		printf('<meta Http-equiv="refresh" Content="0;Url = Login.php">');
		
}
function CheckLogIn(){
	global $config;
	if(!isset($_SESSION['SS_uID'])){
	printf('<meta Http-equiv="refresh" Content="0;Url = Login.php">');
	}
}

function dashBoard(){
	include 'config.php';
	// global $config;
	$sql = "SELECT * FROM users";
	$result = $conn->query($sql);
	$userCount = mysqli_num_rows($result);
}
?>