<?php 
session_start();
error_reporting(0);
include('../include/config.php');
if(strlen($_SESSION['login'])==0) { 
  header('location:index.php');
} else { ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS | Dashboard | Admin</title>
    
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="assets/js/chart-master/Chart.js"></script>
    <!-- map -->
    

    
    <style>
  .box-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Create 3 columns */
    gap: 20px; /* Space between boxes */
    margin-top: 40px;
    padding: 20px; /* Padding around the grid */
    max-width: 800px; /* Increased width for better visibility */
    margin-left: 0; /* Align to the left */
  }

  .box0 {
    background: linear-gradient(135deg, #e0e0e0, #e0e0e0); /* Subtle gradient with light gray tones */
    border-radius: 15px; /* Rounded corners */
    padding: 25px; /* Padding inside the box */
    text-align: center;
    border: 2px  gray; /* Light gray border */
    transition: transform 0.3s ease, border-color 0.3s ease;
    color: #333; /* Dark gray text for contrast */
  }

  .box0:hover {
    transform: translateY(-8px); /* Stronger hover effect */
    border-color: #f39c12; /* Change border color on hover to a warm orange */
  }

  .box0 h3 {
    font-size: 22px; /* Font size for visibility */
    font-weight: 700; /* Bold text */
    margin: 10px 0;
    color: #333; /* Dark gray text color */
  }

  .box0 p {
    font-size: 14px; /* Text size */
    color: #555; /* Medium gray text */
  }

  .li_news {
    font-size: 48px; /* Larger icon size */
    color: #4285F4; /* Blue icon */
    margin-bottom: 10px; /* Space below icons */
    transition: color 0.3s ease; /* Smooth color change on hover */
  }

  .box0:hover .li_news {
    color: #f39c12; /* Change icon color on hover to a warm orange */
  }

  body {
    background-color: #f0f0f0; /* Light gray background */
    font-family: 'Poppins', sans-serif; /* Modern font */
    padding: 40px; /* Padding around the body for a spacious feel */
  }
</style>
  </head>

  <body>
    <section id="container">
      <?php include('includes/header.php'); ?> 
       

      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12 main-chart">
              <!-- Grid layout for boxes -->
              <div class="box-row">

                <!-- Box for Total Complaints -->
                <div class="box0">
                  <i class="fa fa-comments li_news"></i>
                  <?php 
                    $rt = mysqli_query($bd, "SELECT COUNT(*) AS totalComplaints FROM tblcomplaints");
                    $row = mysqli_fetch_assoc($rt);
                    $numTotalComplaints = $row['totalComplaints'];
                  ?>
                  <h3><?php echo htmlentities($numTotalComplaints); ?></h3>
                  <p>Total Complaints</p>
                </div>

                <!-- Box for Complaints Not Processed -->
                <div class="box0">
                  <i class="fa fa-exclamation-circle li_news"></i>
                  <?php 
                    $rt = mysqli_query($bd, "SELECT * FROM tblcomplaints WHERE user_ID='".$_SESSION['id']."' AND status IS NULL");
                    $num1 = mysqli_num_rows($rt);
                  ?>
                  <h3><?php echo htmlentities($num1); ?></h3>
                  <p><?php echo htmlentities($num1); ?> Not Processed Yet</p>
                </div>

                <!-- Box for Complaints In Process -->
                <div class="box0">
                  <i class="fa fa-spinner li_news"></i>
                  <?php 
                    $status = "in Process";                   
                    $rt = mysqli_query($bd, "SELECT * FROM tblcomplaints WHERE user_ID='".$_SESSION['id']."' AND status='$status'");
                    $num1 = mysqli_num_rows($rt);
                  ?>
                  <h3><?php echo htmlentities($num1); ?></h3>
                  <p><?php echo htmlentities($num1); ?> Complaints In Process</p>
                </div>

                <!-- Box for Closed Complaints -->
                <div class="box0">
                  <i class="fa fa-check-circle li_news"></i>
                  <?php 
                    $status = "closed";                   
                    $rt = mysqli_query($bd, "SELECT * FROM tblcomplaints WHERE user_ID='".$_SESSION['id']."' AND status='$status'");
                    $num1 = mysqli_num_rows($rt);
                  ?>
                  <h3><?php echo htmlentities($num1); ?></h3>
                  <p><?php echo htmlentities($num1); ?> Closed</p>
                </div>

                <!-- Box for Total Tools & Equipment -->
                <div class="box0">
                  <i class="fa fa-wrench li_news"></i>
                  <?php 
                    $rt = mysqli_query($bd, "SELECT COUNT(*) AS totalTools FROM tools_equipment");
                    $row = mysqli_fetch_assoc($rt);
                    $numTotalTools = $row['totalTools'];
                  ?>
                  <h3><?php echo htmlentities($numTotalTools); ?></h3>
                  <p>Total Tools & Equipment</p>
                </div>

                <!-- Box for Total Staff Members -->
                <div class="box0">
                  <i class="fa fa-users li_news"></i>
                  <?php 
                    $rt = mysqli_query($bd, "SELECT COUNT(*) AS totalStaff FROM staff");
                    $row = mysqli_fetch_assoc($rt);
                    $numTotalStaff = $row['totalStaff'];
                  ?>
                  <h3><?php echo htmlentities($numTotalStaff); ?></h3>
                  <p>Total Staff Members</p>
                </div>

              </div>
            </div>
          </div><!-- /row -->
        </section>
      </section>

      <?php include("../include/footer.php"); ?>
    </section>

    <!-- JS scripts -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/common-scripts.js"></script>
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
  </body>
</html>
<?php } ?>
<?php
// Start the session
session_start();

// Include database connection
include('../include/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agusan Canyon Full Boundary - Manolo Fortich</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha384-R8SptJoBG5tK8LBcvP3dD4jtYrsDo2t3Hkg9NWblGOnQo68m0WZgwr1UOWM3U3G3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="images/icons/css/font-awesome.css">
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'>
    <style>
         body {
            /* overflow: hidden;  */
        }

        /* Container for the map */
        .map-container {
            position: absolute; 
            right: 0; 
            top: 80px; 
            width: 40%; 
            height: 70vh; 
            border: 2px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
            backdrop-filter: blur(10px); 
            z-index: 1; 
        }
       
        #map {
            height: 100%; 
            width: 100%; 
            position: relative; 
            z-index: 0;
        }

        .label-text {
            font-weight: bold; /* Make the text bold */
            color: white; /* Text color */
            background-color: transparent; /* Transparent background */
            font-size: 12px; /* Adjust font size */
            display: flex;
            align-items: center; /* Align icon and text */
        }

        .location-icon {
            margin-right: 5px; /* Space between icon and text */
            color: lightblue; /* Icon color */
        }
    </style>
</head>
<body>



<div class="wrapper">
    <div class="container-fluid"> <!-- Make sure the container takes full width -->
        <div class="row">
            <?php include('includes/sidebar.php'); ?> 

            <div class="span9">
                <div class="content">
                    <!-- Map Container -->
                    <div class="map-container">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 

<script>
var map = L.map('map').setView([8.311960, 124.825321], 13); 
L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.jpg?api_key=c6bea884-4616-4abc-a6b1-499c25c1a0dc', {
}).addTo(map);


// Define the coordinates for the complete boundary of Agusan Canyon, Manolo Fortich
var agusanCanyonBoundary = [ 
    [8.345970, 124.805236],
            [8.344569, 124.804721],
            [8.343210, 124.804892],
            [8.341512, 124.804549],
            [8.338879, 124.803347],
            [8.337011, 124.803176],
            [8.334208, 124.804807],
            [8.333359, 124.804120],
            [8.330302, 124.804807],
            [8.328349, 124.806523],
            [8.326735, 124.806952],
            [8.324272, 124.807124],
            [8.321215, 124.808240],
            [8.319686, 124.809613],
            [8.316968, 124.811930],
            [8.315270, 124.812531],
            [8.312552, 124.812875],
            [8.310344, 124.814591],
            [8.307202, 124.814677],
            [8.305673, 124.815364],
            [8.304484, 124.816909],
            [8.301766, 124.817595],
            [8.299218, 124.816565],
            [8.298624, 124.817767],
            [8.296670, 124.819054],
            [8.292678, 124.821200],
            [8.290470, 124.822058],
            [8.288177, 124.823003],
            [8.285714, 124.824118],
            [8.283505, 124.824719],
            [8.281382, 124.824033],
            [8.280957, 124.824548],
            [8.281127, 124.826264],
            [8.280193, 124.826693],
            [8.274757, 124.825234],
            [8.273653, 124.827723],
            [8.276965, 124.838624],
            [8.280448, 124.838109],
            [8.283505, 124.836392],
            [8.284949, 124.836221],
            [8.288686, 124.835276],
            [8.289621, 124.835963],
            [8.290300, 124.835620],
            [8.294122, 124.835276],
            [8.295481, 124.835791],
            [8.299730, 124.836308],
            [8.300494, 124.837080],
            [8.302702, 124.837767],
            [8.303891, 124.839054],
            [8.306694, 124.832531],
            [8.308478, 124.831501],
            [8.310006, 124.831930],
            [8.311875, 124.831930],
            [8.314168, 124.832445],
            [8.315951, 124.833132],
            [8.317480, 124.833132],
            [8.318754, 124.833647],
            [8.319603, 124.833904],
            [8.320792, 124.833733],
            [8.320792, 124.834763],
            [8.322151, 124.834934],
            [8.323255, 124.835449],
            [8.326567, 124.835793],
            [8.329455, 124.835964],
            [8.333361, 124.837767],
            [8.334296, 124.837080],
            [8.335145, 124.838453],
            [8.338287, 124.838453],
            [8.339900, 124.837681],
            [8.343467, 124.840513],
            [8.346270, 124.840170],
            [8.347968, 124.841372],
            [8.349072, 124.840256],
];

var polygon = L.polygon(agusanCanyonBoundary, {
    color: 'yellow', 
    fillColor: 'transparent', 
    fillOpacity: 0.3 
}).addTo(map);

var places = [
    { name: "Camp 1 elementary school", coords: [8.339922, 124.824978] },
    { name: "Azucena street", coords: [8.340951, 124.825836] },
    { name: "Catleya street", coords: [8.340750, 124.827017] },
    { name: "Sampaguita street", coords: [8.339242, 124.826394] },
    { name: "Crisanthimum street", coords: [8.336514, 124.826544] },
    { name: "Geranuim street", coords: [8.337788, 124.826308] },
    { name: "Rosavilla street", coords: [8.335378, 124.826459] },
    { name: "Waling waling street", coords: [8.336228, 124.824678] },
    { name: "San isidro labrador", coords: [8.337575731577022, 124.82529990774864] },
    { name: "Agusan Canyon Barangay hall", coords: [8.333791, 124.815285] },
    { name: "Balanban", coords: [8.311618, 124.813765] },
    { name: "Kisabong", coords: [8.334718, 124.809130] },
    { name: "Agusan market", coords: [8.322478, 124.809377] },
    { name: "DELMONTE PINEAPPLE icon", coords: [8.330270103901269, 124.81425860244474] },
    { name: "DEARBC", coords: [8.325960, 124.813400] },
    { name: "cougars", coords: [8.325527, 124.813863] },
    { name: "ares", coords: [8.328202, 124.813697] },
];

var labelLayer = L.layerGroup().addTo(map);

function updateLabels() {
    labelLayer.clearLayers(); 

    if (map.getZoom() >= 16) {
        places.forEach(function(place) {
            var label = L.marker(place.coords, {
                icon: L.divIcon({
                    className: 'label-text',
                    html: '<i class="fas fa-map-marker-alt location-icon"></i>' + place.name,
                    iconSize: [50, 30],
                    iconAnchor: [25, 30]
                })
            }).addTo(labelLayer);
        });
    }
}

map.on('zoomend', updateLabels);

updateLabels();

map.on('click', function(e) {
    var zoomLevel = 16; 
    map.setView(e.latlng, zoomLevel); 
});
</script>
</body>
</html>
