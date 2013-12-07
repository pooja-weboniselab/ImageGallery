<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 6/12/13
 * Time: 4:10 PM
 * To change this template use File | Settings | File Templates.
 */
include 'dbconnect.php';
$album = $_GET['album'];
$deleteddate = date("Y-m-d",time());
//echo $album ;
/* connecting databases */
$mysql = mysql_connect($dbHost, $dbUser, $dbPass);
mysql_select_db($dbName);

$deletequery = "update albummaster set deleted_date='$deleteddate' where id=$album" ;
if(mysql_query($deletequery)) {
    echo mysql_affected_rows();
}