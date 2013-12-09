<?php
include 'dbquery.php';
$album = $_GET['album'];
$createdDate = date("Y-m-d",time());

$albumData = $dbObj->setAlbum($album,$createdDate);
    $output = '' ;
    foreach($albumData as $val){
        //echo $val['name'];
        $output .=  "<li id='".$val['id']."'><a href='albumgallery.php?album=".$val['name']."&&albumID=".$val['id']."' ><img src='album.jpg' alt='".$val['name']."' class='thumb' /><a href='#'><i class='icon-remove-sign'></i></a></i><input type='checkbox' value=''> </a>".$val['name']."
       </li> " ;
    }


echo $output ;

?>

