<?php 
if(isset($_GET['q']))
{
    require_once('db.php');
    $searched = search_article($_GET['q']);
   header('Content-Type: application/json; charset=utf-8');
   echo $searched;
   
}
else
header("Location: index.php")
    

?>