<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 9/12/13
 * Time: 11:09 AM
 * To change this template use File | Settings | File Templates.
 */
require_once ('dbconnect.php');
class dbQuery{
    public function loginPage(){

        $query = "select id,login, password from usermaster where roleId=1" ;
        $testData=  mysql_query($query);
        // $data1=  mysql_fetch_array($tesdata);


        $userData=mysql_fetch_array($testData,MYSQL_ASSOC);
        return $userData ;
    }
    public function listImageMaster(){

        $queryImage = "select * from imagemaster" ;
        $viewImage=  mysql_query($queryImage);

        $viewData = array();


        while($imagedata=mysql_fetch_array($viewImage,MYSQL_ASSOC)){
            $viewData[]=$imagedata;

        }
        return $viewData ;
    }
    public function setImageMaster($title,$targetFile,$filename,$thumbnail_path,$thumbnail,$uploaded_by,$createdDate){

        $imageQuery = "insert into imagemaster(id,title,path,filename,thumbnail_path,thumbnail,uploaded_by,created_date,deleted_date,modified_date)
                   values(0,'$title','$targetFile','$filename','$thumbnail_path','$thumbnail','$uploaded_by','$createdDate','','')" ;

        if(mysql_query( $imageQuery)) {
            $lastQuery = "select max(id) from imagemaster" ;
            $result = mysql_query($lastQuery);
            $imageValue=mysql_fetch_array( $result,MYSQL_ASSOC);

            $query = "select * from imagemaster where id=$imageValue" ;
            $testData=  mysql_query($query);

            $data = array();
            $count=0 ;

            while($imageList=mysql_fetch_array($testData,MYSQL_ASSOC)){
                $data[]=$imageList;
            }
    }
    }

    public function setAlbum($album,$createdDate){
        $insertAlbum = "insert into albummaster(id,name,status,coverId,created_date,deleted_date,modified_date)
                 values(0,'$album',0,0,'$createdDate','','')";
//echo $insertAlbum ;
        if(mysql_query($insertAlbum)){
            //echo "true " ;
            $lastQuery = "select max(id)  from albummaster where deleted_date='0000-00-00'" ;
            $result = mysql_query($lastQuery);
            $albumValue=mysql_fetch_array( $result,MYSQL_ASSOC);
            $ID = $albumValue["max(id)"];
            $query = "select * from albummaster where id=$ID" ;
            $getData=  mysql_query($query);

            $data = array();


            while($albumData=mysql_fetch_array($getData,MYSQL_ASSOC)){
                $data[]=$albumData;
            }
    }
        return $data ;
    }

    public function  showAlbum($albumID) {
        if(!empty($albumID)){
          $albumQuery = "select * from albummaster where id=$albumID and deleted_date='0000-00-00'" ;
        } else{
          $albumQuery = "select * from albummaster where  deleted_date='0000-00-00'" ;
        }

        $testData=  mysql_query($albumQuery);
// $data1=  mysql_fetch_array($tesdata);
        $albumShow= array();
        $count=0 ;

        while($albumView=mysql_fetch_array($testData,MYSQL_ASSOC)){
            $albumShow[]=$albumView;
            $count++ ;
        }
        return $albumShow ;
    }

    public function filterAlbumImage($albumID) {
        $imageQuery = "select * from imagemaster where id NOT IN (select imgid from albumimagerelation where albumid=$albumID) " ;
        $testData=  mysql_query($imageQuery);

        $viewData = array();


        while($imageData=mysql_fetch_array($testData,MYSQL_ASSOC)){
            $viewData[]=$imageData;

        }
         return $viewData ;
         }

    public function getAlbumImageRelation($albumID){
        $listAlbumImage = "select img.id , img.title , img.thumbnail , img.filename  , albimg.alias
                    from imagemaster as img ,
                    albumimagerelation as albimg
                    where albimg.imgid = img.id and albimg.albumid=$albumID" ;
        $imgData = mysql_query($listAlbumImage);
        $albumGrid = array();
        while($getImage =mysql_fetch_array($imgData,MYSQL_ASSOC)){
            $albumGrid[]=$getImage;

        }
        return $albumGrid ;
    }

    public function getCover() {
         $listCover ="select album.id ,img.filename from imagemaster as img , albummaster as album where img.id=album.coverid" ;
        $getCover = mysql_query($listCover);
        $showCover = array();
        while($Cover =mysql_fetch_array($getCover,MYSQL_ASSOC)){
            $showCover[]=$Cover;

        }
        $coverData = array();
        foreach($showCover as $val){
            $coverData[$val['id']] = $val['filename'];
        }
        return $coverData ;
    }

    public function setCover($album,$imageId ,$modifiedDate) {

            $coverQuery = "update albummaster set coverId=$imageId ,modified_date='$modifiedDate' where id=$album " ;
//echo $publishquery ;
            if(mysql_query($coverQuery)) {
                return mysql_affected_rows();
            }
        }


    public function publishAlbum($album,$modifiedDate) {

        $publishQuery = "update albummaster set status=1 ,modified_date='$modifiedDate' where id=$album " ;
//echo $publishquery ;
        if(mysql_query($publishQuery)) {
            return mysql_affected_rows();
        }
    }

    public function deleteAlbum($album,$deletedDate){
        $deleteQuery = "update albummaster set deleted_date='$deletedDate' where id=$album" ;
        if(mysql_query($deleteQuery)) {
            return mysql_affected_rows();

        }
    }

    public function albumImageRelation($album,$imageId,$createdDate){
        $albumImageRelation = "insert into albumimagerelation (albumid,imgid,alias,created_date,modified_date) values
              ($album,$imageId,'','$createdDate','')";
        if(mysql_query($albumImageRelation)){
            return "true" ;
        }
    }
}

