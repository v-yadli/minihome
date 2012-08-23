<?php
if($_POST['url'] != "")
{
    $password_md5 = $_POST['password'];
    if($password_md5 == md5("123"))
        echo file_get_contents( $_POST['url'] );
    else echo "Access Denied. Wrong password.";
}
else if ( $_GET['nextDiaryOf'] != "" )
{
	$target = trim($_GET['nextDiaryOf']);
	require('simple_html_dom.php');
	$next = "";
	$html = file_get_html('http://v-yadli.github.com/diary/diary.html');
	$found = FALSE;
	$acquired = FALSE;
	foreach($html->find('tr') as $row) {
		foreach($row->find('td') as $element)
		{
			$next = trim($element->plaintext);
			if($found == TRUE)
			{
				$acquired = TRUE;
				echo $next;
				break;
			}
			
			if($next == $target)
			{
				$found = TRUE;
			}
		}
		if($acquired == TRUE)
			break;
	}
}
?>
