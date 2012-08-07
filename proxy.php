<?php
if($_POST['url'] != "")
	echo file_get_contents( $_POST['url'] );
else if ( $_GET['nextDiaryOf'] != "" )
{
	$target = $_GET['nextDiaryOf'];
	require('simple_html_dom.php');
	$table = array();
	$next = "";
	$html = file_get_html('http://v-yadli.github.com/diary/diary.html');
	$found = FALSE;
	$acquired = FALSE;
	foreach($html->find('tr') as $row) {
		foreach($row->find('td') as $element)
		{
			$next = $element->plaintext;
			if($next == $target)
			{
				$found = TRUE;
			}
			
			if($found == TRUE)
			{
				$acquired = TRUE;
				break;
			}
		}
		if($acquired == TRUE)
			break;
	}
	echo $next;
}
?>