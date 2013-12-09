<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 6/12/13
 * Time: 6:47 PM
 * To change this template use File | Settings | File Templates.
 */
include 'dbquery.php';
session_start();
$imageId = $_GET['image'];
$albumId = $_GET['album'];
$createdDate = date("Y-m-d",time());
$dbObj = new dbQuery() ;
$output=$dbObj->albumImageRelation($albumId,$imageId,$createdDate);
echo $output ;