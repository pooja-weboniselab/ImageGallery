<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 6/12/13
 * Time: 4:10 PM
 * To change this template use File | Settings | File Templates.
 */

$album = $_GET['album'];
$dbHost = "localhost";
$dbUser = "poojawebonise";
$dbPass = "weboniselab";
$dbName = "imagegallery_db";
//echo $album ;
/* connecting databases */
$mysql = mysql_connect($dbHost, $dbUser, $dbPass);
mysql_select_db($dbName);

$deletequery = "update albummaster set deleted_date='2013-12-06' where id="