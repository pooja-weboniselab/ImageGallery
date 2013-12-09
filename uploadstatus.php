<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 29/11/13
 * Time: 12:26 PM
 * To change this template use File | Settings | File Templates.
 */

//session_start();
// Define a destination
$targetFolder = '/uploads'; // Relative to the root
//$time = $_POST['timestamp']
$verifyToken = md5('unique_salt' . $_POST['timestamp']);
echo $targetFolder ;
if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
    $targetFile = rtrim($targetPath,'/') . '/' .$_FILES['Filedata']['name'];

    // Validate the file type
    $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
    $fileParts = pathinfo($_FILES['Filedata']['name']);
    $fName = $_FILES['Filedata']['name'] ;
    if (in_array($fileParts['extension'],$fileTypes)) {
        move_uploaded_file($tempFile,$targetFile);
        createThumbs($targetFile,"thumbnail/",$fileParts,$fName,50);
        $imageView = insertRecord($fName,$targetFile,$fName,'thumbnail/'.$fName,$fName,$_POST['id']);
        echo $imageView ;
        console.log($imageView);
    } else {
        echo 'Invalid file type.';
    }
}

function createThumbs( $pathToImages, $pathToThumbs, $fileParts, $fName ,$thumbWidth )
{

        $fileTypes = array('jpg','jpeg','gif','png');
        if (  in_array($fileParts['extension'],$fileTypes))
        {
            echo "Creating thumbnail for {$fName} <br />";

            // load image and get image size
            $img = imagecreatefromjpeg( $pathToImages );
            $width = imagesx( $img );
            $height = imagesy( $img );

            // calculate thumbnail size
            $new_width = $thumbWidth;
            $new_height = floor( $height * ( $thumbWidth / $width ) );

            // create a new tempopary image
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );

            // copy and resize old image into new image
            imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

            // save thumbnail into a file
            imagejpeg( $tmp_img, "{$pathToThumbs}{$fName}" );
        }
}

function insertRecord($title,$targetFile,$filename,$thumbnail_path,$thumbnail,$uploaded_by){
    require_once ("dbquery.php") ;

    //$set_date = date("Y-m-d", strtotime($date));
    $createdDate = date("Y-m-d",time());

            $listData = $dbObj->setImageMaster($title,$targetFile,$filename,$thumbnail_path,$thumbnail,$uploaded_by,$createdDate);

         $output = '' ;
         foreach($listData as $val){
             $output .=  "<li  id='".$val['id']."'><a href='#'><img src='thumbnail/".$val['filename']."' alt='uploads/".$val['filename']."' class='thumb' /></a>
                </li> " ;
         }

         return $output ;


}



?>
