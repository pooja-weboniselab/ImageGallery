<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 7/12/13
 * Time: 2:15 PM
 * To change this template use File | Settings | File Templates.
 */

include 'dbconnect.php';
$image = $_GET['imageID'];
$album = $_GET['albumID'];
$modifeddate = date("Y-m-d",time());
//echo $album;
/* connecting databases */
$mysql = mysql_connect($dbHost, $dbUser, $dbPass);
mysql_select_db($dbName);

$coverquery = "update albummaster set coverId=$image ,modified_date='$modifeddate' where id=$album " ;
//echo $publishquery ;
if(mysql_query($coverquery)) {
    echo mysql_affected_rows();
}