
<?php
$albumID = $_GET['albumID'];
$album = $_GET['album'];
session_start();

include 'dbconnect.php';
$query = "select * from imagemaster" ;
$testData=  mysql_query($query);
// $data1=  mysql_fetch_array($tesdata);
$viewdata = array();


while($imagedata=mysql_fetch_array($testData,MYSQL_ASSOC)){
    $viewdata[]=$imagedata;

}

$albumquery = "select * from albummaster where id=$albumID" ;
$testData=  mysql_query($albumquery);
// $data1=  mysql_fetch_array($tesdata);
$albumshow= array();
$n=0 ;

while($albumview=mysql_fetch_array($testData,MYSQL_ASSOC)){
    $albumshow[]=$albumview;
    $n++ ;
}
//var_dump($albumshow[0]['status']);
$listalbumimage = "select img.id , img.title , img.thumbnail , img.filename  , albimg.alias
                    from imagemaster as img ,
                    albumimagerelation as albimg
                    where albimg.imgid = img.id and albimg.albumid=$albumID" ;
$imgdata = mysql_query($listalbumimage);
$albumgrid = array();
while($getimage =mysql_fetch_array($imgdata,MYSQL_ASSOC)){
    $albumgrid[]=$getimage;
    $n++ ;
}

//var_dump($albumgrid);
?>

<!DOCTYPE html>

<html>
<head>
<title>Admin Dashboard<?php echo $_SESSION['id'] ;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


    <link href="bootstrap/css/custome.css" rel="stylesheet" media="screen">

<style type="text/css">
    #drop { float: right; width: 32%; min-height: 18em; padding: 1%; }
    #drop h4 { line-height: 16px; margin: 0 0 0.4em; }
    #drop h4 .ui-icon { float: left; }
    #drop .gallery h5 { display: none; }
</style>
    <script type="text/javascript">
        $(function() {
// there's the gallery and the trash
            var $gallery = $( "#imagegallery" ),
                    $trash = $( "#drop" );
// let the gallery items be draggable
            $( "li", $gallery ).draggable({
                cancel: "a.ui-icon", // clicking an icon won't initiate dragging
                revert: "invalid", // when not dropped, the item will revert back to its initial position
                containment: "document",
                helper: "clone",
                cursor: "move"
            });
// let the trash be droppable, accepting the gallery items
            $trash.droppable({
                accept: "#imagegallery > li",
                activeClass: "ui-state-highlight",
                drop: function( event, ui ) {
                    deleteImage( ui.draggable );
                    insertimageToalbum(ui.draggable);
                }
            });
// let the gallery be droppable as well, accepting items from the trash
            $gallery.droppable({
                accept: "#drop li",
                activeClass: "custom-state-active",
                drop: function( event, ui ) {
                    recycleImage( ui.draggable );
                }
            });
// image deletion function
            var recycle_icon = "<a href='' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
            function deleteImage( $item ) {
                $item.fadeOut(function() {
                    var $list = $( "ul", $trash ).length ?
                            $( "ul", $trash ) :
                            $( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $trash );
                    $item.find( "a.ui-icon-trash" ).remove();
                    $item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
                        $item
                                .animate({ width: "48px" })
                                .find( "img" )
                                .animate({ height: "36px" });
                    });
                });

            }

            function insertimageToalbum($item){
               alert($item.prop('id'));
                var ID = $item.prop('id') ;
                var AlbumId = $("div.span3").attr('id');
                $.ajax({
                    type: "POST",
                    url:"albumImage.php?image="+ID+"&&album="+AlbumId, // file where you process the list.
                    success:function(data){
                        if(data == 'true'){
                            location.reload();
                        }
                    }

                });


            }

// image preview function, demonstrating the ui.dialog used as a modal window
            function viewLargerImage( $link ) {
                var src = $link.attr( "href" ),
                        title = $link.siblings( "img" ).attr( "alt" ),
                        $modal = $( "img[src$='" + src + "']" );
                if ( $modal.length ) {
                    $modal.dialog( "open" );
                } else {
                    var img = $( "<img alt='" + title + "' width='384' height='288' style='display: none; padding: 8px;' />" )
                            .attr( "src", src ).appendTo( "body" );
                    setTimeout(function() {
                        img.dialog({
                            title: title,
                            width: 400,
                            modal: true
                        });
                    }, 1 );
                }
            }
// resolve the icons behavior with event delegation

        });

       </script>

    <script type="text/javascript">
        $(document).ready(function(){
        function triggerChange(){
            $("#publish").trigger("on");
        }

        $("#publish").on('click', function() {
            alert("triggered!");
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
            <li class="active"><a href="#">upload Image</a></li>
            <li><a href="#">create Album</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class ="span3" id="<?php echo $albumID ;?>">
        <h4><?php echo $album ;?></h4>
        </div>
    <div class="span9">
        <?php if($albumshow[0]['status']==1){?>
        <input type="checkbox" id="publish" accept="" checked="checked"> Publish this Album</input>
            <?php }elseif($albumshow[0]['status']==0){ ?>
        <input type="checkbox" id="publish" accept="" > Publish this Album</input>
   <?php  } ?>
    </div>
</div>
<div class="row">
    <div class="span6">
        <div id="drop" class="span4 ui-widget-content ui-state-default">

                <h4 class="ui-widget-header"><span class=" ">Album</span>


        </div>
        <div class="span6">
            <div id="imageview">
            <ul id="imagegalleryshow">
                <?php foreach($albumgrid as $val){ ?>
                <li  id="<?php echo $val['id']; ?>"><a href='#'><img id="<?php echo $val['id']; ?>"src='thumbnail/<?php echo $val['filename'];?>' alt='uploads/<?php echo $val['filename'];?>' class='thumb'  /></a>
                    <a href="" title="remove image from album" class="ui-icon ui-icon-trash">Delete image</a>
                </li>
                <?php  }?>

            </ul>
        </div>
        </div>
    </div>
    <div class="span4" >
       <ul id="imagegallery">

           <?php foreach($viewdata as $image){ ?>
                    <li  id="<?php echo $image['id']; ?>"><a href='#'><img id="<?php echo $image['id']; ?>"src='thumbnail/<?php echo $image['filename'];?>' alt='uploads/<?php echo $image['filename'];?>' class='thumb'  /></a>
                    </li>
             <?php  }?>

       </ul>
    </div>

</div>
</body>


</html>