
<?php

$albumID = $_GET['albumID'];
$album = $_GET['album'];
session_start();

require_once('dbquery.php');



$viewData = $dbObj->filterAlbumImage($albumID);
$albumShow = $dbObj->showAlbum($albumID);
$albumGrid = $dbObj->getAlbumImageRelation($albumID);
$getCover = $dbObj->getCover();
//var_dump($getCover) ;
?>

<!DOCTYPE html>

<html>
<head>
<title>Admin Dashboard<?php echo $_SESSION['id'] ;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="jquery/css/jquery-ui.css">
    <script src="jquery/js/jquery-1.9.1.js"></script>
    <script src="jquery/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="bootstrap/css/stylesheet.css">

    <link href="bootstrap/css/custome.css" rel="stylesheet" media="screen">
    <script src="bootstrap/js/dragDrop.js"></script>
    <script src="bootstrap/js/albumGallery.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            function triggerChange(){
                $("#publish").trigger("on");

            }

            $("#publish").on('click', function() {
               // alert("triggered!");
                if($(this).is(':checked')){
                    //alert('checked');
                    var AlbumId = $("div.span3").attr('id');
                    $.ajax({
                        type: "POST",
                        url:"publishalbum.php?albumID="+AlbumId, // file where you process the list.

                        success:function(data){
                            if(data>0){
                                alert("album is publish");
                            }

                        }

                    });
                }
                else{
                    alert('unchecked');
                }
            });
            triggerChange();

        });
    </script>




<!--<link href="bootstrap/css/bootswatch.css" rel="stylesheet" media="screen">-->
</head>

<body style="padding-top: 60px;">
<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="#">Image Gallery</a>
        <ul class="nav">
            <li class="active"><a href="admindashboard.php">upload Image</a></li>
            <li><a href="createalbum.php">create Album</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class ="span3" id="<?php echo $albumID ;?>">
        <h4><?php echo $album ;?></h4>
        </div>
    <div class="span9">
        <?php if($albumShow[0]['status']==1){?>
        <input type="checkbox" id="publish" accept="" checked="checked"> Publish this Album</input>
            <?php }elseif($albumShow[0]['status']==0){ ?>
        <input type="checkbox" id="publish" accept="" > Publish this Album</input>
   <?php  } ?>
    </div>
</div>
<div class="row">
    <div class="span8">
        <div id="drop" class="span2 ui-widget-content ui-state-default">

                <h4 class="ui-widget-header"><span class=" ">Album</span>


        </div>
        <div class="span6">
            <div id="imageview">
            <ul id="imagegalleryshow">
                <?php foreach($albumGrid as $val){ ?>
                <li  id="<?php echo $val['id']; ?>"><a href='#'><img id="<?php echo $val['id']; ?>"src='thumbnail/<?php echo $val['filename'];?>' alt='uploads/<?php echo $val['filename'];?>' class='thumb'  /></a>
                    <i class='icon-remove-sign' id="<?php echo $val['id'];?>" ></i>
                    <?php if ($val['filename']== $getCover[$albumID]){ ?>
                    <input type='checkbox' id="cover<?php echo $val['id'];?>" value='<?php echo $val['id'];?>' onclick="coverAlbum(<?php echo $val['id'];?>)" checked="checked">
                     <?php }else{ ?>
                    <input type='checkbox' id="cover<?php echo $val['id'];?>" value='<?php echo $val['id'];?>' onclick="coverAlbum(<?php echo $val['id'];?>)" >
                   <?php  }?>

                </li>
                <?php  }?>

            </ul>
        </div>
        </div>
    </div>
    <div class="span4" id ="albumImage" >
       <ul id="imagegallery">

           <?php foreach($viewData as $image){ ?>
                    <li  id="<?php echo $image['id']; ?>"><a href='#'><img id="<?php echo $image['id']; ?>"src='thumbnail/<?php echo $image['filename'];?>' alt='uploads/<?php echo $image['filename'];?>' class='thumb'  /></a>
                    </li>
             <?php  }?>

       </ul>
    </div>

</div>
</body>


</html>