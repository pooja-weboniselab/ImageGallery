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
?>
<!DOCTYPE html>

<html>
<head>
    <title>Admin Dashboard<?php echo $_SESSION['id'] ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
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
            <div class="pull-right">
                <div class="container" id="imagegallery">

                </div></div>
        </div>
        <div class="span2" >
            <form>
                <div id="queue"></div>
                <input id="file_upload" name="file_upload" type="file" multiple="true">
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
                'uploader' : 'uploadstatus.php'
            });
        });


    </script>
</div>

<!-- Containers
================================================== -->





</div>

</body>
<script type= "text/javascript" >
    $( document ).ready(function() {

        $.ajax({
            type: "GET",
            url: "listimage.php", // file where you process the list.
            success:function(data){
                $('#imagegallery').html(data);
            }

        });


    });
</script>



<html>
