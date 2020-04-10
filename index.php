<?php
require("dbconnect.php");
session_start();
$val = "";
$err = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $myusername = mysqli_real_escape_string($con,$_POST['username']);
  $mypassword = mysqli_real_escape_string($con,$_POST['pass']);
  $sql = "SELECT username FROM user WHERE username = '$myusername' and password = '$mypassword'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  if($row)
  {
    if(!empty($_POST["remember"]))
    {
    setcookie ("member_login",$myusername,time()+ (10 * 365 * 24 * 60 * 60));
    setcookie ("member_password",$mypassword,time()+ (10 * 365 * 24 * 60 * 60));
    }
    else
    {
      if(isset($_COOKIE["member_login"]))
      {
        setcookie ("member_login","");
      }
      if(isset($_COOKIE["member_password"]))
      {
        setcookie ("member_password","");
      }
        header("location:index.php");
    }
  }
  $count = mysqli_num_rows($result);
   if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         header("location: mainpage.php");

      }else {
        $val = 1;
        $err = "Username Password is wrong";
      }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>RYD Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/master.css" type="text/css">
  </head>
  <body>
    <div class="container-fluid bg">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">

        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <!-- Login form Start-->
          <form class="form-container" method="post" action="">
            <div class="imgcontainer">
              <?php
              if($val == 1)
              {
               ?>
               <div class="bg-warning">
                 <?php echo $err; ?>
               </div>
             <?php } else {?>
               <div></div>
             <?php } ?>
              <img src="images/user2.png" alt="Avatar" class="avatar">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Uername" name="username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember" id="remember"  <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>>
                <label style="padding-left:2px;">Remember Me</label>
              </label>
            </div>
            <button type="submit" class="btn btn-success btn-block" id="myBtn">LogIn</button>
            <br><br>
            <div class="form-group">
              <a href="#">Forget Password</a>
            </div>
          </form>
          <!-- Login form End-->
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12"></div>

        </div>
      </div>
    </div>
  </body>
</html>
