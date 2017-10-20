<!DOCTYPE html>
<html>
<head>
  <title>Attendance|Teacher</title>
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


    $totalClasses = 100;
    $tentativeClasses = 200;


  ?>

</head>

<body class='w3-light-grey'>

<!-- Top container -->
<div class='w3-bar w3-top w3-black w3-large' style='z-index:4'>
  <button class='w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey' onclick='w3_open();'><i class='fa fa-bars'></i>  Menu</button>
  <span class='w3-bar-item w3-right'><?php echo($_SESSION['name'])?> <small>(Teacher)</small> |<a href="logout.php" style="text-decoration: none;"><small>  Logout </small></a></span>
</div>

<!-- Sidebar/menu -->
<nav class='w3-sidebar w3-collapse w3-white w3-animate-left' style='z-index:3;width:300px;' id='mySidebar'><br>
  <div class='w3-container w3-row'>
    <div class='w3-col s4'>
      <img src='/w3images/avatar2.png' class='w3-circle w3-margin-right' style='width:46px'>
    </div>

  </div>
  <hr>
  <div class='w3-container'>
    <h5>Dashboard</h5>
  </div>
  <div class='w3-bar-block'>
    <a href='#' class='w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black' onclick='w3_close()' title='close menu'><i class='fa fa-remove fa-fw'></i>  Close Menu</a>
    <a href='#' class='w3-bar-item w3-button w3-padding w3-blue'><i class='fa fa-users fa-fw'></i>  Overview</a>


    <a href='#' class='w3-bar-item w3-button w3-padding'><i class='fa fa-bullseye fa-fw'></i>  Today's Class</a>

    <a href='#' class='w3-bar-item w3-button w3-padding'><i class='fa fa-bell fa-fw'></i>  Notice</a>


  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class='w3-overlay w3-hide-large w3-animate-opacity' onclick='w3_close()' style='cursor:pointer' title='close side menu' id='myOverlay'></div>

<!-- !PAGE CONTENT! -->
<div class='w3-main' style='margin-left:300px;margin-top:43px;'>

  <!-- Header -->
  <header class='w3-container' style='padding-top:22px'>
    <h5><b><i class='fa fa-dashboard'></i> My Dashboard</b></h5>
  </header>

  <div class='w3-row-padding w3-margin-bottom'>

    <div class='w3-quarter'>
      <div class='w3-container w3-orange w3-text-white w3-padding-16'>
        <div class='w3-left'><i class='fa fa-users w3-xxxlarge'></i></div>
        <div class='w3-right'>
          <h3>&nbsp</h3>
        </div>
        <div class='w3-clear'></div>
        <h4>Subject 1</h4>
      </div>
    </div>
    <div class='w3-quarter'>
      <div class='w3-container w3-red w3-text-white w3-padding-16'>
        <div class='w3-left'><i class='fa fa-users w3-xxxlarge'></i></div>
        <div class='w3-right'>
          <h3><?php echo($totalClasses)?></h3>
        </div>
        <div class='w3-clear'></div>
        <h4>Classes Conducted</h4>
      </div>
    </div>
    <div class='w3-quarter'>
      <div class='w3-container w3-green w3-text-white w3-padding-16'>
        <div class='w3-left'><i class='fa fa-users w3-xxxlarge'></i></div>
        <div class='w3-right'>
          <h3><?php echo($tentativeClasses)?></h3>
        </div>
        <div class='w3-clear'></div>
        <h4>Tentative Classes</h4> <!--tells number of more classes remaining-->
      </div>
    </div>
  </div>

  <!-- Add the table here-->
  <div class='w3-container'>
    <h5>Attendance List</h5> <!-- Number of classes out of total classes-->
    <table class='w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white'>
      <?php
      $result = $db->query("SELECT * FROM users WHERE role = 's' ");
      // $stmt->bind_param('s', "s");
      //
      // $stmt->execute();
      //
      // $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
        // do something with $row
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['subj1']."/100</td>";
      }



      ?>

<!--
      <tr>
        <td>Class 1</td>
        <td>x/100</td>
      </tr> -->

    </table><br>
  </div>
  <!--Table above this-->
  <hr>
  <!--Start and End Button-->
<div class='w3-container'>
<span>
  <button class='w3-btn w3-ripple w3-blue'>Button</button>
  <button class='w3-btn w3-ripple w3-red'>Button</button>
</span>
</div>

  <hr>
  <!--Notice add-->


  <!--Notice above this-->
  <hr>
  <!-- Footer -->
  <!-- <footer class='w3-container w3-padding-16 w3-light-grey'>
    <h4>FOOTER</h4>
    <p>Powered by <a href='#' target='_blank'>bleh!</a></p>
  </footer> -->

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById('mySidebar');

// Get the DIV with overlay effect
var overlayBg = document.getElementById('myOverlay');

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = 'none';
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = 'block';
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = 'none';
    overlayBg.style.display = 'none';
}
</script>

</body>
</html>
