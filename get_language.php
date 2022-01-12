<?php
require("modules/session.class.php");

$session = new SecureSession();

$session->set('irimhe_lang', (int) $_GET['irimhe_lang']);

$goback = $_SERVER['HTTP_REFERER'];

header("location: $goback");
?>