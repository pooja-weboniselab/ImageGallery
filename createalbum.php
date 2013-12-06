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

$dbHost = "localhost";
$dbUser = "poojawebonise";
$dbPass = "weboniselab";
$dbName = "imagegallery_db";

/* connecting databases */
$mysql = mysql_connect($dbHost, $dbUser, $dbPass);
mysql_select_db($dbName);
$query = "select * from albummaster" ;
$testData=  mysql_query($query);
// $data1=  mysql_fetch_array($tesdata);
$data = array();
$n=0 ;

while($albumdata=mysql_fetch_array($testData,MYSQL_ASSOC)){
    $data[]=$albumdata;
    $n++ ;
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
        <ul class="nav">
            <li class="active"><a href="#">upload Image</a></li>
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
                       <?php foreach ($data as $val){?>
                        <li id ="<?php echo $val['id'];?>"><img src='album.jpg' alt="<?php echo $val['name'];?>"
                            class='thumb' /><i class='icon-remove-sign' id="<?php echo $val['id'];?>" onclick="deletealbum(<?php echo $val['id'];?>)"></i></a></i><input type='checkbox' value=''> </a><?php echo $val['name']?>
                        </li>
<?php } ?>
                </ul>

        </div>

    </div>

</div>
</body>

    <script type="text/javascript">
        function createAlbum()
        {
            var x;

            var person=prompt("Album name","");

            if (person!=null)
            {
                x= person ;
                insertAlbum(x);


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
             $.ajax({
                 type: "POST",
                 url:"deletealbum.php?album="+id, // file where you process the list.
                 success:function(data){
                     console.log(data);
                     $("#albumgallery").append(data) ;
                 }

             });

         }



</script>

</html>
