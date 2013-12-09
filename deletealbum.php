<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 6/12/13
 * Time: 4:10 PM
 * To change this template use File | Settings | File Templates.
 */
include 'dbquery.php';
$album = $_GET['album'];
$deletedDate = date("Y-m-d",time());
//echo $album ;
/* connecting databases */
$dbObj = new dbQuery() ;
$output = $dbObj->deleteAlbum($album,$deletedDate);
echo $output ;