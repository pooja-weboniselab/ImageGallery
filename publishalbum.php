<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 7/12/13
 * Time: 11:56 AM
 * To change this template use File | Settings | File Templates.
 */

include 'dbconnect.php';
$album = $_GET['albumID'];
$modifeddate = date("Y-m-d",time());
//echo $album;
/* connecting databases */
$mysql = mysql_connect($dbHost, $dbUser, $dbPass);
mysql_select_db($dbName);

$publishquery = "update albummaster set status=1 ,modified_date='$modifeddate' where id=$album " ;
//echo $publishquery ;
if(mysql_query($publishquery)) {
   echo mysql_affected_rows();
}