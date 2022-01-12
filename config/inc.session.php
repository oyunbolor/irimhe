<?php
require("modules/session.class.php");

$session = new SecureSession();

if (!$session->isregistered('irimhe_session_id'))
{
	$session->deleteset('irimhe_session_id');
}

if (!$session->isregistered('irimhe_login_name'))
{
	$session->deleteset('irimhe_login_name');
}

if (!$session->isregistered('irimhe_profile'))
{
	$session->deleteset('irimhe_profile');
}

?>
