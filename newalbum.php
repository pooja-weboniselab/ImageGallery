<?php
include 'dbconnect.php';
$album = $_GET['album'];

$insertAlbum = "insert into albummaster(id,name,status,coverId,created_date,deleted_date,modified_date)
                 values(0,'$album',0,0,'2013-12-5','','')";
//echo $insertAlbum ;
if(mysql_query($insertAlbum)){
    //echo "true " ;
    $lastquery = "select max(id)  from albummaster" ;
    $result = mysql_query($lastquery);
    $albumvalue=mysql_fetch_array( $result,MYSQL_ASSOC);
    $ID = $albumvalue["max(id)"];
    $query = "select * from albummaster where id=$ID" ;
    $testData=  mysql_query($query);

    $data = array();
    $n=0 ;

    while($albumdata=mysql_fetch_array($testData,MYSQL_ASSOC)){
        $data[]=$albumdata;
    }
    $output = '' ;
    foreach($data as $val){
        //echo $val['name'];
        $output .=  "<li id='".$val['id']."'><a href='#' ><img src='album.jpg' alt='".$val['name']."' class='thumb' /><a href='#'><i class='icon-remove-sign'></i></a></i><input type='checkbox' value=''> </a>".$val['name']."
       </li> " ;
    }

}
echo $output ;

?>