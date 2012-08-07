<?php
if($_POST['url'] != "")
	echo file_get_contents( $_POST['url'] );
else if ( $_POST['nextDiaryOf'] != "" )
{
	echo "2012-02-14";
}
?>