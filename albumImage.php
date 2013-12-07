<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 6/12/13
 * Time: 6:47 PM
 * To change this template use File | Settings | File Templates.
 */
include 'dbconnect.php';
session_start();
$imageId = $_GET['image'];
$albumId = $_GET['album'];
$createdDate = date("Y-m-d",time());
$albumimage = "insert into albumimagerelation (id,albumid,imgid,alias,created_date,modified_date) values
              (0,$albumId,$imageId,'','$createdDate','')";
if(mysql_query($albumimage)){
    echo "true" ;
}