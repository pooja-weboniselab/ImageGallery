<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 4/12/13
 * Time: 4:40 PM
 * To change this template use File | Settings | File Templates.
 */


    $dbHost = "localhost";
    $dbUser = "poojawebonise";
    $dbPass = "weboniselab";
    $dbName = "imagegallery_db";

    /* connecting databases */
    $mysql = mysql_connect($dbHost, $dbUser, $dbPass);
    mysql_select_db($dbName);
    $query = "select * from imagemaster" ;
    $testData=  mysql_query($query);
// $data1=  mysql_fetch_array($tesdata);
                    $data = array();
                    $n=0 ;

                    while($imagedata=mysql_fetch_array($testData,MYSQL_ASSOC)){
                        $data[]=$imagedata;
                        $n++ ;
                    }
                    $output = '' ;
                foreach($data as $val){
             $output .=  "<li  id='".$val['id']."'><a href='#'><img src='thumbnail/".$val['filename']."' alt='uploads/".$val['filename']."' class='thumb' /></a>
                </li> " ;
                }

            echo $output ;

?>