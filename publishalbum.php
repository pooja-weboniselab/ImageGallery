<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 7/12/13
 * Time: 11:56 AM
 * To change this template use File | Settings | File Templates.
 */

include 'dbquery.php';
$album = $_GET['albumID'];
$modifeddate = date("Y-m-d",time());
//echo $album;
/* connecting databases */

$dbObj->publishAlbum($album,$modifiedDate);