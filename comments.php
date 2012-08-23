<?php

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
    $file_content = file_get_contents( $page_name );
    if($file_content == false)
        $file_content = '';
    $file_content = $file_content . "From $author ($email) ".date(DATE_RFC822).":\n".
                     $content."\n";
/*    $fh = fopen($page_name,"wb");
    fwrite($fh, $file_content);
    fclose($fh);*/
    echo file_put_contents($page_name, $file_content);
    echo "Add comment successful.";
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
