<?php

$page_name = $_GET['page'] . "_comments.txt";
function show_comment()
{
    $result = file_get_contents('comments/'+$page_name);
    if($result == false)
        echo "No comments yet.";
    else echo $result;
}

function add_comment($author,$email,$content)
{
    $file_content = file_get_contents( 'comments/'+$page_name );
    if($file_content == false)
        $file_content = '';
    $file_content += "From $author ($email) ".date(DATE_RFC822).":\n".
                     $content."\n";
    file_put_contents('comments/'+$page_name, $file_content);
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
        show_comment();
        break;
    case 'add':
        add_comment($_GET['author'],$_GET['email'],$_GET['content']);
        break;
    }
}
?>
