<?php
	if (!$session->isregistered('irimhe_lang'))
	{
		$session->set('irimhe_lang',1);
	}
	
	if($session->get('irimhe_lang') == 1){
		include('config/language_mn.php');
	} else if($session->get('irimhe_lang') == 2){
		include('config/language_en.php');
	}
?>