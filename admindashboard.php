<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 28/11/13
 * Time: 5:19 PM
 * To change this template use File | Settings | File Templates.
 *
 */
include 'dbconnect.php';
session_start();


$query = "select * from imagemaster" ;
$testData=  mysql_query($query);
// $data1=  mysql_fetch_array($tesdata);
$viewdata = array();


while($imagedata=mysql_fetch_array($testData,MYSQL_ASSOC)){
    $viewdata[]=$imagedata;

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
    <script src="uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="uploadify/uploadify.css">
    <style type="text/css">
        body {
            font: 13px Arial, Helvetica, Sans-serif;
        }
    </style>

    <!--<link href="bootstrap/css/bootswatch.css" rel="stylesheet" media="screen">-->
</head>
<body style="padding-top: 60px;">
<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="#">Image Gallery</a>
        <ul class="nav">
            <li class="active"><a href="#">upload Image</a></li>
            <li><a href="#">create Album</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>
    </div>
</div>

<div class="container">

    <div class = "row" >
        <div class="span10">

                <ul id="imagegallery">
                    <?php foreach($viewdata as $image){ ?>
                    <li  id="<?php echo $image['id']; ?>"><a href='#'><img id="<?php echo $image['id']; ?>"src='thumbnail/<?php echo $image['filename'];?>' alt='uploads/<?php echo $image['filename'];?>' class='thumb' draggable="true" ondragstart="drag(event)"  /></a>
                    </li>
                    <?php  }?>
                </ul>
        </div>
        <div class="span2" >
            <form>
                <div id="queue"></div>
                <input id="file_upload" name="file_upload" type="file" multiple="true" onclick="reload();">
            </form>
        </div>
    </div>

    <script type="text/javascript">
        <?php $timestamp = time();?>
        $(function() {
            $('#file_upload').uploadify({
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
                    'id'        : '<?php echo $_SESSION['id'] ; ?>'

                },
                'swf'      : 'uploadify/uploadify.swf',
                'uploader' : 'uploadstatus.php',
                'onComplete': function(event, queueID, fileObj, response, data) {
                    console.log(fileObj.filename);
                   // $("#imagegallery").append(data);
                }



            });

        });


    </script>
</div>

<!-- Containers
================================================== -->





</div>

</body>
<!--<script type= "text/javascript" >
    $( document ).ready(function() {

        $.ajax({
            type: "GET",
            url: "listimage.php", // file where you process the list.
            success:function(data){
                $('#imagegallery').html(data);
            }

        });

        $( "#imagegallery" ).load( "listimage.php", function(response,status,xhr) {
        console.log(response);
        if(status=="success"){

            document.getElementById("imagegallery").innerHTML=xhr.responseText;
        }


    });


    $( document ).ready(function() {
        //window.location.reload()

        $.ajax({
            type: "POST",
            url: "listimage.php", // file where you process the list.
            success:function(data){
                console.log(data);
                $('#imagegallery').html(data);
            }

        });


    });

   $( document ).ready(function() {
        //window.location.reload()

        $.ajax({
            type: "POST",
            url: "listimage.php", // file where you process the list.
            success:function(data){
                console.log(data);
                $('#imagegallery').html(data);
            }

        });


    });
    <div class = "span4">
            <ul id="imagegallery">
                <?php //foreach( $data as $val) { ?>
                 <li  id='<?php //echo $val['id'];?>'><a href='#'><img src='thumbnail/<?php //echo $val['filename'];?>' alt='uploads/<?php //echo $val['filename'];?>' class='thumb' /></a>
                </li>
           <?php  //}?>
            </ul>
        </div>
</script>-->



<html>
