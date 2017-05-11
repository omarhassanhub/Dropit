<!DOCTYPE html>
<html>
   <head>
      <title>DropIt</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/style.css" />
      <script type="text/javascript" src="JScripts/login.js"></script>
   </head>
   <body>
      <div class="container">
         <div >
            <div align="right">
               <br/>
            </div>
            <br/>
            <div class="logo"><a href="dropbox.php"><img src="css/Images/drop.png"></img></a></div>
            <h2>DropIt</h2>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-md-2" >
               <div id="leftcolumn">
               </div>
            </div>
            <div class="col-md-6">
            </div>
            <div class="col-md-6" >
            </div>
            <div class="col-md-6 col-md-offset-5">
               <br/>
               <div class="textAlign">
                  <p><a href="registration.php">Register</a> | <a href="index.php">Login</a></p>
                  <h3>Login Form</h3>
               </div>
               <form name="loginform" id = "login" method="post" action="Include_Functions/login.php" onsubmit="return validateform()" >
                  <div class="labelInputArea">
                     <label for="Username" class="lable">Username:</label>
                     <input name="logUsername" type="text" value="" />
                  </div>
                  <div class="labelInputArea">
                     <label for="Password" class="lable">Password:</label>
                     <input name="logPassword" type="password" value="" />
                  </div>
                  <br />
                  <input type="submit" value="Login" name="submit" />
               </form>
            </div>
            <br/>
         </div>
      </div>
      <div class="container">
         <div >
            <hr/>
            <ul id="navfooter" align="center">
               <li><a href="index.php">Home</a>
               </li>
               <li>|
               </li>
               <li><a href="about.php">About</a>
               </li>
               <br/><br/>
               <li>&copy; 2014 DropIt
               </li>
            </ul>
         </div>
      </div>
   </body>
</html>