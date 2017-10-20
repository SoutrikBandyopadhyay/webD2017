<!DOCTYPE html>
<html>
<head>
  <title>Attendance|Dashboard</title>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <style>
  html,body,h1,h2,h3,h4,h5 {font-family: 'Raleway', sans-serif}
  </style>
  <?php
    require_once("connect.php");
    require_once("Security/security.php");
    function redirect($url, $statusCode = 303)
    {
       header('Location: ' . $url, true, $statusCode);
       die();
    }


    session_start();




  ?>



</head>
<body class='w3-light-grey'>

<!-- Top container -->
<div class='w3-bar w3-top w3-black w3-large' style='z-index:4'>

  <span class='w3-bar-item w3-right'><?php echo($_SESSION['name'])?> <small>(Student)</small> |<a href="logout.php" style="text-decoration: none;"><small>  Logout </small></a></span>
</div>

<?php
  $stmt = $db->prepare("SELECT * FROM users WHERE  id = ? ");
  $stmt->bind_param('s', $_SESSION['id']);
//
// $query = "SELECT name FROM users WHERE name = '$userName' AND password = '$userPass'";// AND password = $userPass";
// $result = mysqli_query( $db, $query);

  $stmt->execute();
// *** Error checking, what if !$result? eg query is broken
  $result = $stmt->get_result();

  $row = mysqli_fetch_array($result);

  $attend1 = (int)$row['subj1'];
  $attend2 = (int)$row['subj2'];
  $attend3 = (int)$row['subj3'];








?>

<!-- !PAGE CONTENT! -->
<div class='w3-main' style='margin-left:150px;margin-right:150px ;margin-top:43px;'>

    <hr>
  <div class='w3-container'>
    <h5>Classes Attended</h5>    <!-- Classes attended % -->
    <p>Class 1</p>
    <div class='w3-grey'>
      <div class='w3-container w3-center w3-padding w3-green ' style=<?php echo "width:".$attend1."%"?>><?php echo $attend1."%"?></div>

    </div>

    <p>Class 2</p>
    <div class='w3-grey'>
      <div class='w3-container w3-center w3-padding w3-orange' style=<?php echo "width:".$attend2."%"?>><?php echo $attend2."%"?></div>
    </div>

    <p>Class 3</p>
    <div class='w3-grey'>
      <div class='w3-container w3-center w3-padding w3-red' style=<?php echo "width:".$attend3."%"?>><?php echo $attend3."%"?></div>
    </div>
  </div>
  <hr>

  <div class='w3-container'>
    <h5>CLASSES</h5> <!-- Number of classes out of total classes-->
    <table class='w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white'>
      <tr>
        <td>Class 1</td>
        <td><?php echo $attend1?>/100</td>
      </tr>
      <tr>
        <td>Class 2</td>
        <td><?php echo $attend2?>/100</td>
      </tr>
      <tr>
        <td>Class 3</td>
        <td><?php echo $attend3?>/100</td>
      </tr>

    </table><br>
    <button class='w3-button w3-dark-grey'>More Classes  <i class='fa fa-arrow-right'></i></button> <!-- Click for more classes-->
  </div>
  <hr>
    <div class='w3-container'>
    <h5>Notice</h5> <!--Notice Section -->
    <div class='w3-row'>
      <div class='w3-col m2 text-center'>
        <img class='w3-circle' src='/w3images/avatar3.png' style='width:96px;height:96px'>
      </div>
      <div class='w3-col m10 w3-container'>
        <h4>Vibhash <span class='w3-opacity w3-medium'>Oct 15, 2017, 4:03 AM</span></h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p><br>
      </div>
    </div>

    <div class='w3-row'>
      <div class='w3-col m2 text-center'>
        <img class='w3-circle' src='/w3images/avatar1.png' style='width:96px;height:96px'>
      </div>
      <div class='w3-col m10 w3-container'>
        <h4>Kanav <span class='w3-opacity w3-medium'>Oct 15, 2017, 4:03 AM</span></h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p><br>
      </div>
    </div>
  </div>
  <br>


  <!-- Footer -->
  <footer class='w3-container w3-padding-16 w3-light-grey'>
    <h4>Footer</h4>
    <p>Powered by <a href='#' target='_blank'>wubba luba dub dub</a></p>
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the DIV with overlay effect
var overlayBg = document.getElementById('myOverlay');


</script>

</body>
</html>
