<?php
$page_name = $_POST['page'];
if
(
    strpos($page_name,'..') != false ||
    $page_name[0] == '/' ||
    strpos($page_name,'~/') != false
)
{
    echo "No traversal injection dude."
}else
{
    switch($_POST['action'])
    {
    case 'show':
        show_comment();
        break;
    case 'add':
        add_comment($_POST['author'],$_POST['email'],$_POST['content']);
        break;
    }
}

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

?>
