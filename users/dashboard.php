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
    <title>CMS | Dashboard</title>
    
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- External CSS -->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">
    
    <!-- Custom styles -->
    <link href="assets/css/style.css" rel="stylesheet">
    
    <!-- Include chart.js for charts if needed -->
    <script src="assets/js/chart-master/Chart.js"></script>

    <style>
      /* Improved row layout design */
      .box-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 20px;
      }
      .box0 {
        flex: 1;
        min-width: 200px;
        max-width: 300px;
      }
      .box1 {
        background: linear-gradient(135deg, #e0e0e0, #e0e0e0);
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }
      .box1:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      }
      .box1 h3 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin: 10px 0;
      }
      .box1 p {
        font-size: 14px;
        color: #777;
        margin: 0;
      }
      .li_news, .li_tools {
        font-size: 36px;
        color: #4285F4;
        margin-bottom: 10px;
      }
      body {
        background-color: #f4f7f9;
        font-family: 'Arial', sans-serif;
      }
    </style>
  </head>

  <body>
    <section id="container">
      <?php include("../include/header.php"); ?>
      <?php include("../include/sidebar.php"); ?>

      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12 main-chart">
              <!-- Row layout for boxes -->
              <div class="box-row">
                
                <!-- Box for Complaints not Processed -->
                <div class="box0">
                  <div class="box1">
                    <span class="li_news"></span>
                    <?php 
                      $rt = mysqli_query($bd, "SELECT * FROM tblcomplaints WHERE user_ID='".$_SESSION['id']."' AND status IS NULL");
                      $num1 = mysqli_num_rows($rt);
                    ?>
                    <h3><?php echo htmlentities($num1); ?></h3>
                    <p><?php echo htmlentities($num1); ?> Complaints Not Processed Yet</p>
                  </div>
                </div>

                <!-- Box for Complaints In Process -->
                <div class="box0">
                  <div class="box1">
                    <span class="li_news"></span>
                    <?php 
                      $status = "in Process";                   
                      $rt = mysqli_query($bd, "SELECT * FROM tblcomplaints WHERE user_ID='".$_SESSION['id']."' AND status='$status'");
                      $num1 = mysqli_num_rows($rt);
                    ?>
                    <h3><?php echo htmlentities($num1); ?></h3>
                    <p><?php echo htmlentities($num1); ?> Complaints In Process</p>
                  </div>
                </div>

                <!-- Box for Closed Complaints -->
                <div class="box0">
                  <div class="box1">
                    <span class="li_news"></span>
                    <?php 
                      $status = "closed";                   
                      $rt = mysqli_query($bd, "SELECT * FROM tblcomplaints WHERE user_ID='".$_SESSION['id']."' AND status='$status'");
                      $num1 = mysqli_num_rows($rt);
                    ?>
                    <h3><?php echo htmlentities($num1); ?></h3>
                    <p><?php echo htmlentities($num1); ?> Complaints Closed</p>
                  </div>
                </div>

                <!-- Box for Total Tools & Equipment -->
                <div class="box0">
                  <div class="box1">
                    <span class="li_news"></i></span>
                    <?php 
                      $rt = mysqli_query($bd, "SELECT COUNT(*) AS totalTools FROM tools_equipment");
                      $row = mysqli_fetch_assoc($rt);
                      $numTotalTools = $row['totalTools'];
                    ?>
                    <h3><?php echo htmlentities($numTotalTools); ?></h3>
                    <p>Total Tools & Equipment</p>
                  </div>
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
