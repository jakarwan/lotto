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
?>