<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 28/11/13
 * Time: 5:19 PM
 * To change this template use File | Settings | File Templates.
 *
 */
session_start();

include 'dbconnect.php';
$query = "select * from albummaster where deleted_date='0000-00-00' and status = 1 " ;
$testData=  mysql_query($query);
// $data1=  mysql_fetch_array($tesdata);
$data = array();
$n=0 ;

while($albumdata=mysql_fetch_array($testData,MYSQL_ASSOC)){
    $data[]=$albumdata;
    $n++ ;
}
$albumcover = array();
foreach ($data as $value){
    if(isset($value['coverId'])!=0){
        $id = $value['coverId'] ;
        $query = "select * from imagemaster where id=$id ";
        $imageData=  mysql_query($query);
    }
    $albumcover = mysql_fetch_array($imageData,MYSQL_ASSOC);
    //var_dump($albumcover) ;
    $coverphoto[$value['id']]['cover'] = $albumcover['filename'] ;
}







?>
<!DOCTYPE html>

<html>
<head>
    <title>Admin Dashboard<?php echo $_SESSION['id'] ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/custome.css" rel="stylesheet" media="screen">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <style type="text/css">
        .bs-example{
            margin: 20px;
        }
    </style>
    <!--<link href="bootstrap/css/bootswatch.css" rel="stylesheet" media="screen">-->
</head>

<body style="padding-top: 60px;">
<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="#">Image Gallery</a>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class ="span12">
            <h3>Album</h3>
        </div>

    </div>
    <div class="row">
        <div class = "span12">

            <ul id="albumgallery">
                <?php foreach ($data as $val){?>
                <li id ="<?php echo $val['id'];?>">
                    <a href ="albumgallery.php?album=<?php echo $val['name'];?>&&albumID=<?php echo $val['id'];?>">
                        <?php if($val['coverId']!=0) { ?>
         <img src='thumbnail/<?php echo $coverphoto[$val['id']]['cover'];?>' alt="<?php echo $val['name'];?>"
              <?php }else{ ?>
                            <img src='album.jpg' alt="<?php echo $val['name'];?>"
                        <?php }?>
                                 class='thumb' /><i class='icon-remove-sign' id="<?php echo $val['id'];?>" onclick="deleteAlbum(<?php echo $val['id'];?>)"></i>

                        <?php echo $val['name']?></a>
                </li>
                <?php } ?>
            </ul>

        </div>

    </div>


</div>
</body>

<script type="text/javascript">
    $(document).ready(function(){
        function deleteAlbum(id){
            alert(id);
            alert($("#albumgallery").children('li').attr('id'));
            $.ajax({
                type: "POST",
                url:"deletealbum.php?album="+id, // file where you process the list.
                success:function(data){
                    if(data==1){
                        location.reload();
                    }


                }

            });

        }
    });





</script>

</html>
