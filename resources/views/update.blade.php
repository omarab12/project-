<!DOCTYPE html>

<html lang="en">


<?php
session_start();
$omar=Auth::user()->id;
$_SESSION['varname'] = $omar;
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Dashio - Bootstrap Admin Template</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b>DASH<span>IO</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- settings start -->
          
          <!-- settings end -->
          <!-- inbox dropdown start-->
          
        
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
        <a class="dropdown-item" href="logout" 
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


          
        </ul>
        <form id="logout-form" action="logout" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                      
      </div>


    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="img/ui-sam.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">{{ Auth::user()->name }}</h5>
          <li class="mt">
            <a href="home">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
          
          
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-desktop"></i>
              <span>Website Managment</span>
              </a>
            <ul class="sub">
              <li><a href="website">Add a website</a></li>
              <li><a href="update">Update a website</a></li>
              <li><a href="delete">Delete a website</a></li>
            
            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <?php
// select box open tag
$selectBoxOpen = "<select name='website_id'>";
// select box close tag
$selectBoxClose = "</select>";
// select box option tag
$selectBoxOption = '';

$server = "localhost";
$username = "root";
$password = "";
$database = "laravel";
$pop=Auth::user()->id;

$con = mysqli_connect($server,$username,$password) or die("Cannot connect to server");
if (!$con) {
die('Could not connect: ' . mysql_error());
}

// select database
mysqli_select_db($con,$database);
// fire mysql query
$result = mysqli_query($con,"SELECT website_id FROM website where user_id=$pop");


// play with return result array
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
  $selectBoxOption .="<option value = '".$row['website_id']."'>".$row['website_id']."</option>";
  }

// create select box tag with mysql result
$selectBox = $selectBoxOpen.$selectBoxOption.$selectBoxClose;
?>  
    
    
    
    
    <form action="lolo.php">
    
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Update a website</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
            <label for="cars">Choose the website ID you wish to update:</label>

<select name="emshi">
<option ><?php echo $selectBoxOption;?>
</option>
</select>


<br>
  <label for="fname">New website name:</label><br>
  <input type="text" pattern=".*.com$" id="fname" name="new" value=""><br>
  
  <input type="submit" value="Update">
</form>








<?php

function mysql_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}

$server = "localhost";
$username = "root";
$password = "";
$database = "laravel";

$connId = mysqli_connect($server,$username,$password) or die("Cannot connect to server");
$selectDb = mysqli_select_db($connId,$database) or die("Cannot connect to database");
$query="SELECT * FROM website";
$result=mysqli_query($connId,$query);
$num=mysqli_num_rows($result);

?>

<table class="table table-sm table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Website Name</th>
      
    </tr>
  </thead>


<?php

$i=0;

while ($i < $num ) {

    $f1=mysql_result($result,$i,"website_id");
    $f2=mysql_result($result,$i,"user_id");
    $f3=mysql_result($result,$i,"website_name");
    
if ($f2==$omar){    
?>



  <tbody>
    <tr>
      
      <td><?php echo $f1; ?></td>
      <td><?php echo $f3; ?></td>
      
    </tr>
    
  </tbody>



<?php
}
$i++;
}
?>



</body>

</html>'






                

  

        <!-- page end-->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    
        <a href="google_maps.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <!--Google Map-->
  <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7"></script>
  <script src="lib/google-maps/maplace.js"></script>
  <script src="lib/google-maps/data/points.js"></script>
  <script>
    //ul list example
    new Maplace({
      locations: LocsB,
      map_div: '#gmap-list',
      controls_type: 'list',
      controls_title: 'Choose a location:'
    }).Load();

    new Maplace({
      locations: LocsB,
      map_div: '#gmap-tabs',
      controls_div: '#controls-tabs',
      controls_type: 'list',
      controls_on_map: false,
      show_infowindow: false,
      start: 1,
      afterShow: function(index, location, marker) {
        $('#info').html(location.html);
      }
    }).Load();
  </script>

</body>

</html>
