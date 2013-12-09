<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 28/11/13
 * Time: 4:02 PM
 * To change this template use File | Settings | File Templates.
 */

?>

    <!DOCTYPE html>
<html>
<head>
    <title>ImageGallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
   <!-- <link href="bootstrap/css/bootswatch.css" rel="stylesheet" media="screen">-->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>


<!-- Forms
================================================== -->
  <div class="row">
      <div class="span10">
          <h1>Admin Login</h1>
      </div>
      <div class="span2">   </div>
  </div>




    <div class="row">



        <div class="span12">
                <form id="loginForm" class="bs-example form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="loginUser">User Name</label>
                            <div class="controls">
                                <input type="text" id="loginUser" name="loginUser" placeholder="UserName">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword">Password</label>
                            <div class="controls">
                                <input type="password" id="inputPassword" name="inputPassword" placeholder="Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">

                                <button type="submit" class="btn">Sign in</button>
                            </div>
                        </div>


                    </fieldset>
                </form>
            </div>

    </div>
<?php
require_once ("dbquery.php") ;
if (isset($_POST)) {
    $loginName = $_POST['loginUser'];
    $loginPass = md5($_POST['inputPassword']);


     $userData = $dbObj->loginPage();
     //echo $userData['login'];

     if(isset($_POST['loginUser'])){
        if($userData['login']== $loginName && $userData['password']== $loginPass){
            session_start();//start session
            $_SESSION['user'] = $userData['login'] ;
            $_SESSION['id'] = $userData['id'];// store session data
            header( 'Location:admindashboard.php' ) ;
        }
        else { ?>
        <div class="row"><div class="span12"><?php echo "wrong username and password" ; ?></div></div>
            <?php }
    }

} ?>
</div>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
<html>


