<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Attendance|Login</title>
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
    // turn error reporting on, it makes life easier if you make typo in a variable name etc
    error_reporting(E_ALL);
    session_start();

    // Check connection
    if (!$db) {
        echo "<div>";
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        echo "</div>";

    }

    // Pretty much kicks out a user once they revisit this age and is logged in

    // *** It is best to test isset($_SESSION["name"]), otherwise php will generate a warning if 'name' index is not set.
    // you can also test for !empty($_SESSION["name"]), as empty detects if a value is not set, but it will also detect 0 as empty, so use with caution
    // if( $_SESSION["name"] )
    if( isset($_SESSION["name"]) && $_SESSION["name"] )
    {
        // echo "<div class = 'flash'>You are already logged in, ".$_SESSION['name']."! <br> I'm Loggin you out M.R ..</div>";
        // unset( $_SESSION );
        // session_destroy();
        // exit;
				if($_SESSION['role']=="s"){
					redirect("student.php");
				}else{
					redirect('teacher.php');
				}
    }
    $loggedIn = false;

    $userName = isset($_POST["name"]) ? sanitize($db,$_POST["name"]) : null;
    $userPass = isset($_POST["pass"]) ? sanitize($db,$_POST["pass"]) : null;

    // php casts strings and numeric values to boolean, so something that you don't think is false could be cast as false, eg a string containing "0"
    if ($userName && $userPass )
    {

      $stmt = $db->prepare("SELECT id,name,role FROM users WHERE  username = ? AND password = ?");
      $stmt->bind_param('ss', $userName,$userPass);
      //
      // $query = "SELECT name FROM users WHERE name = '$userName' AND password = '$userPass'";// AND password = $userPass";
      // $result = mysqli_query( $db, $query);

      $stmt->execute();
      // *** Error checking, what if !$result? eg query is broken
      $result = $stmt->get_result();
      $row = mysqli_fetch_array($result);

      if(!$row){
          echo "<div class='flash'>";
          echo "No existing user or wrong password.";
          echo "</div>";
      }
      else {
          // *** My PERSONAL preference is to use {} every where, it just makes it easier if you add
          // code into the condition later
          $loggedIn = true;
					$_SESSION['role'] = $row['role'];
					$_SESSION["id"] = $row['id'];

      }
    }

    if ( !$loggedIn )
    {
        echo "
        <div id='login'>
          <form name='form-login' action='index.php' method='post'>
            <span class='fontawesome-user'></span>
            <input type='text' id='user' name = 'name' placeholder='Username'>

            <span class='fontawesome-lock'></span>
            <input type='password' id = 'pass' name = 'pass' placeholder='Password'>

            <input type='submit' value='Login'>

          </form>
        </div>
            ";
    }
    else{
        // echo "<div>";
        // echo "You have been logged in as $userName!";
        // echo "</div>";
        $_SESSION["name"] = $userName;

				if($_SESSION['role']=="s"){
					redirect("student.php");
				}else{
					redirect("teacher.php");
				}
    }
  ?>


</body>
</html>
