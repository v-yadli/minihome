<?php

header('Expires: Sun, 15 Dec 2002 06:00:00 GMT');

header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

header('Cache-Control: no-store, no-cache, must-revalidate');

header('Cache-Control: post-check=0, pre-check=0', false);

header('Pragma: no-cache');

$page_name = 'comments/' . $_GET['page'] . "_comments.txt";
function show_comment($page_name)
{
    $result = file_get_contents($page_name);
    if($result == false)
        echo "No comments yet.";
    else echo $result;
}

function add_comment($page_name,$author,$email,$content)
{
    error_reporting(E_ALL);
    $content = "\n" . $content . "\n========================================";
    $file_content = file_get_contents( $page_name );
    if($file_content == false)
        $file_content = '';
    $file_content = $file_content . "From $author ($email) ".date(DATE_RFC822).":\n".
                     $content."\n";
/*    $fh = fopen($page_name,"wb");
    fwrite($fh, $file_content);
    fclose($fh);*/
    if(FALSE==file_put_contents($page_name, $file_content))
    {
        echo "System internal failure. Sorry for this. A mail will be sent to Yatao for a fix.";
        mail("glocklee@gmail.com","Comment failure",
            "Comment failure detected. Go fix it Yadli!!!");
    }else
    {
        echo "Add comment successful.";
    }
    echo mail("glocklee@gmail.com","New comment",
        "$author have commented to $page_name:\n".
        $content,
    "From: $email");
}
 
if
(
    strpos($page_name,'..') != false ||
    $page_name[0] == '/'
)
{
    echo "No traversal injection dude.";
}else
{
    switch($_GET['action'])
    {
    case 'show':
        show_comment($page_name);
        break;
    case 'add':
        add_comment($page_name,$_GET['author'],$_GET['email'],$_GET['content']);
        break;
    }
}
?>
