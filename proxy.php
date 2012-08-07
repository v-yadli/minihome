<?php
if($_POST['url'] != "")
	echo file_get_contents( $_POST['url'] );
else if ( $_GET['nextDiaryOf'] != "" )
{
	$target = trim($_GET['nextDiaryOf']);
	require('simple_html_dom.php');
	$next = "";
	$html = file_get_html('http://v-yadli.github.com/diary/diary.html');
	$found = FALSE;
	$acquired = FALSE;
	echo $target;
	foreach($html->find('tr') as $row) {
		foreach($row->find('td') as $element)
		{
			$next = trim($element->plaintext);
			echo $next;
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