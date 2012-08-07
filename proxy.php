<?php
if($_POST['url'] != "")
	echo file_get_contents( $_POST['url'] );
else if ( $_GET['nextDiaryOf'] != "" )
{
	$page = file_get_contents("http://v-yadli.github.com/diary/diary.html");
	echo "2012-02-14";
}
?>