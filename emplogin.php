<?php
$username = "";
$password = "";

$error = "";
$my_url = "login.php";

if (isset($_POST["loginbttn"]))
{
	if (isset($_POST["username"]) && isset($_POST["password"]))
	{
		$username = pg_prep($_POST["username"]);
		$password = pg_prep($_POST["password"]);
		
		if (!is_null($username) && !is_null($password))
		{
			$schemas = "iremhena_irimhe";
			
			$selQuery = "SELECT tu.user_id, tu.profile, tu.login_name FROM ".$schemas.".tausers tu WHERE tu.login_name = '".$username."' AND tu.login_passwd = md5('".$password."') AND tu.login_status = true";
			$rows = $db->query($selQuery);
			
			if (!empty($rows)) 
			{
				$today = date("Y-m-d H:i:s");
				$login_session = generateSessionString(16); 
				
				$session->set('irimhe_session_id', $login_session);
				$session->set('irimhe_username', $rows[0]["login_name"]);
				$session->set('irimhe_profile', $rows[0]["profile"]);
				
				$wherevalues = "user_id=".$rows[0]["user_id"]; 
				$fields = array("login_date", "login_session");
				$values = array("'".$today."'", "'".$login_session."'");
				
				$db->update("".$schemas.".tausers", $fields, $values, $wherevalues);
				
				header("Location: emplogin.php");
			}else
			{
				$error = _p("LoginErrorText1");
			}
		}else
		{
			$error = _p("LoginErrorText2");
		}
	}
}
if (isset($_GET["login"]) && ($_GET["login"]=="logout"))
{
	$session->deleteset('irimhe_session_id');
	$session->deleteset('irimhe_username');
	$session->deleteset('irimhe_profile');
}
require("templates/inc.login.php");
require("templates/inc.main_footer.php");
?>
