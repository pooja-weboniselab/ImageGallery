
<?php

session_start();

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
$viewdata = array();


while($imagedata=mysql_fetch_array($testData,MYSQL_ASSOC)){
    $viewdata[]=$imagedata;

}

$albumquery = "select * from albummaster" ;
$testData=  mysql_query($albumquery);
// $data1=  mysql_fetch_array($tesdata);
$albumview = array();
$n=0 ;

while($albumview=mysql_fetch_array($testData,MYSQL_ASSOC)){
    $albumshow[]=$albumview;
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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <link href="bootstrap/css/custome.css" rel="stylesheet" media="screen">

<style type="text/css">
    .bs-example{
        margin: 20px;
    }
</style>
    <script type="text/javascript">
        function allowDrop(ev)
        {
            ev.preventDefault();
        }

        function drag(ev)
        {
            ev.dataTransfer.setData("Text",ev.target.id);
        }

        function drop(ev)
        {
            ev.preventDefault();
            var data=ev.dataTransfer.getData("Text");
            ev.target.appendChild(document.getElementById(data));
        }

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
    <div class ="span3">
        <h4>Album Name</h4>
        </div>
    <div class="span9">
        <input type="checkbox" id="" accept=""> Publish this Album</input>
    </div>
</div>
<div class="row">
    <div class="span8">
        <div class="span4">
            <div id="drop" ondrop="drop(event)" ondragover="allowDrop(event)">

                </div>

        </div>
        <div class="span4">

        </div>
    </div>
    <div class="span4" >
       <ul id="imagegallery">

           <?php foreach($viewdata as $image){ ?>
                    <li  id="<?php echo $image['id']; ?>"><a href='#'><img id="<?php echo $image['id']; ?>"src='thumbnail/<?php echo $image['filename'];?>' alt='uploads/<?php echo $image['filename'];?>' class='thumb' draggable="true" ondragstart="drag(event)"  /></a>
                    </li>
             <?php  }?>

       </ul>
    </div>

</div>
</body>


</html>