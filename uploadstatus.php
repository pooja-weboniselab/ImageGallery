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
    $fname = $_FILES['Filedata']['name'] ;
    if (in_array($fileParts['extension'],$fileTypes)) {
        move_uploaded_file($tempFile,$targetFile);
        createThumbs($targetFile,"thumbnail/",$fileParts,$fname,50);
        $imageview = insertRecord($fname,$targetFile,$fname,'thumbnail/'.$fname,$fname,$_POST['id']);
        echo $imageview ;
        console.log($imageview);
    } else {
        echo 'Invalid file type.';
    }
}

function createThumbs( $pathToImages, $pathToThumbs, $fileParts, $fname ,$thumbWidth )
{

        $fileTypes = array('jpg','jpeg','gif','png');
        if (  in_array($fileParts['extension'],$fileTypes))
        {
            echo "Creating thumbnail for {$fname} <br />";

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
            imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
        }
}

function insertRecord($title,$targetFile,$filename,$thumbnail_path,$thumbnail,$uploaded_by){

    $dbHost = "localhost";
    $dbUser = "poojawebonise";
    $dbPass = "weboniselab";
    $dbName = "imagegallery_db";

    /* connecting databases */
    $mysql = mysql_connect($dbHost, $dbUser, $dbPass);
    mysql_select_db($dbName);
    $createdDate = date('YYYY-mm-dd',time());

    $imagequery = "insert into imagemaster(id,title,path,filename,thumbnail_path,thumbnail,uploaded_by,created_date,deleted_date,modified_date)
                   values(0,'$title','$targetFile','$filename','$thumbnail_path','$thumbnail','$uploaded_by','$createdDate','','')" ;

     if(mysql_query($imagequery)) {
         $lastquery = "select max(id) from imagemaster" ;
         $result = mysql_query($lastquery);
         $imagevalue=mysql_fetch_array( $result,MYSQL_ASSOC);

         $query = "select * from imagemaster where id=$imagevalue" ;
         $testData=  mysql_query($query);

         $data = array();
         $n=0 ;

         while($imagelist=mysql_fetch_array($testData,MYSQL_ASSOC)){
             $data[]=$imagelist;
         }
         $output = '' ;
         foreach($data as $val){
             $output .=  "<li  id='".$val['id']."'><a href='#'><img src='thumbnail/".$val['filename']."' alt='uploads/".$val['filename']."' class='thumb' /></a>
                </li> " ;
         }

         return $output ;
     }

}



?>
