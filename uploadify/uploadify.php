<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
//echo $_POST['token'];
// Define a destination
$targetFolder = '/uploads'; // Relative to the root
$pathToThumbs = '/thumbnail' ;
//$time = $_POST['timestamp']
$verifyToken = md5('unique_salt' . $_POST['timestamp']);
echo $targetFolder ;
if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];

	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);

	if (in_array($fileParts['extension'],$fileTypes)) {
        createthumbs ($tempFile, $pathToThumbs,50);
		move_uploaded_file($tempFile,$targetFile);

		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}


function createThumbs( $targetFolder, $pathToThumbs, $thumbWidth )
{
    // open the directory
    $dir = opendir( $targetFolder );

    // loop through it, looking for any/all JPG files:
    while (false !== ($fname = readdir( $dir ))) {
        // parse path for the extension
        $info = pathinfo($targetFolder . $fname);
        // continue only if this is a JPEG image
        if ( strtolower($info['extension']) == 'jpg' )
        {
            echo "Creating thumbnail for {$fname} <br />";

            // load image and get image size
            $img = imagecreatefromjpeg( "{$targetFolder}{$fname}" );
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
    // close the directory
    closedir( $dir );
}

?>