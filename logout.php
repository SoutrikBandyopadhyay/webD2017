<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Attendance|Logout</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">
    <link rel="stylesheet" href="public/css/style.css">
    <?php
  		require_once("connect.php");
  		require_once("Security/security.php");
      function redirect($url, $statusCode = 303)
      {
         header('Location: ' . $url, true, $statusCode);
         die();
      }

  	?>


  </head>
  <body>
    <?php
      session_start();
      if( isset($_SESSION["name"]) && $_SESSION["name"] )
      {
          echo "<div class = 'flash'>You are already logged in, ".$_SESSION['name']."! <br> I'm Loggin you out M.R ..</div>";
          unset( $_SESSION );
          session_destroy();
          redirect("index.php");
          exit;

      }else{
        echo "<div class = 'flash'>You must be logged on to log-out !!! (Duh !)</div>";
        redirect("index.php");

      }


    ?>

  </body>
</html>
