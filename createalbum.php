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

include 'dbquery.php';
$dbObj = new dbQuery() ;
$albumData = $dbObj->showAlbum('');
$coverPhoto = $dbObj->getCover();


//var_dump($coverPhoto);






?>
<!DOCTYPE html>

<html>
<head>
    <title>Admin Dashboard<?php echo $_SESSION['id'] ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/custome.css" rel="stylesheet" media="screen">
    <script src="jquery/js/jquery.min.js" type="text/javascript"></script>

    <style type="text/css">
        .bs-example{
            margin: 20px;
        }
    </style>
    <!--<link href="bootstrap/css/bootswatch.css" rel="stylesheet" media="screen">-->

    <script type="text/javascript">
        $(document).ready(function(){
            function triggerChange(){
                $("#publish").trigger("live");
            }

            $("#publish").live('click', function() {
                alert("triggered!");
                if($(this).is(':checked')){
                    //alert('checked');
                    var AlbumId = $(this).val() ;
                    alert(AlbumId);
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
        function createAlbum()
        {
            var newAlbum;

            var album=prompt("Album name","");

            if (album!=null)
            {
                newAlbum= album;
                insertAlbum(newAlbum);


            }
        }



        function insertAlbum(str){

            $.ajax({
                type: "POST",
                url:"newalbum.php?album="+str, // file where you process the list.
                success:function(data){
                    console.log(data);
                    $("#albumgallery").append(data) ;

                }

            });

        }
        function deleteAlbum(id){
            alert(id);
            alert($("#albumgallery").children('li').attr('id'));
            $.ajax({
                type: "POST",
                url:"deletealbum.php?album="+id, // file where you process the list.
                success:function(data){
                    // alert(data)
                    if(data==1){
                        location.reload();
                    }


                }

            });

        }



    </script>
</head>

<body style="padding-top: 60px;">
<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="#">Image Gallery</a>
        <ul class="nav">
            <li class="active"><a href="admindashboard.php">upload Image</a></li>
            <li><a href="#">create Album</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class ="span10">
            <h3>Album</h3>
        </div>
        <div class="span2">
            <button class=" "onclick="createAlbum()" >create Album</button>
            <input type="hidden" id="album">
        </div>
    </div>
    <div class="row">
        <div class = "span12">

                <ul id="albumgallery">
                       <?php foreach ($albumData as $val){?>
                        <li id ="<?php echo $val['id'];?>">
                            <a href ="albumgallery.php?album=<?php echo $val['name'];?>&&albumID=<?php echo $val['id'];?>">
                                <?php if($val['coverId']!=0) { ?>
         <img src='thumbnail/<?php echo $coverPhoto[$val['id']];?>' alt="<?php echo $val['name'];?>" class='thumb' />
              <?php }else{ ?>
                          <img src='album.jpg' alt="<?php echo $val['name'];?>" class='thumb' />
                           <?php }?>
                            </a><i class='icon-remove-sign' id="<?php echo $val['id'];?>" onclick="deleteAlbum(<?php echo $val['id'];?>)"></i>
                            <?php if($val['status']==1){ ?>
                            <input type='checkbox' id="publish" value='<?php echo $val['id'];?>' checked="checked">
                           <?php }elseif($val['status']==0){ ?>
                            <input type='checkbox' id="publish" value='<?php echo $val['id'];?>'>
                          <?php } ?>
                        <?php echo $val['name']?>
                        </li>
<?php } ?>
                </ul>

        </div>

    </div>

</div>
</body>



</html>
