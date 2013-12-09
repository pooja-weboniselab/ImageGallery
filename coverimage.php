<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 7/12/13
 * Time: 2:15 PM
 * To change this template use File | Settings | File Templates.
 */

include 'dbquery.php';
$image = $_GET['imageID'];
$album = $_GET['albumID'];
$modifiedDate = date("Y-m-d",time());
//echo $album;
/* connecting databases */

$output = $dbObj->setCover($album,$image,$modifiedDate);
echo $output ;