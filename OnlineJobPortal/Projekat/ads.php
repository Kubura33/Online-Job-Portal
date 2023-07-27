<?php 
    require_once 'caching/cache.php';
    require_once 'authorization.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <title>Ads</title>
    <style>
        .ad-div {
          background-color: #f2f2f2;
          border-radius: 8px;
          padding: 20px;
          margin-bottom: 20px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .company-name {
          color: #333;
          font-size: 24px;
          margin-bottom: 10px;
        }
        
        .ad-text {
          color: #666;
          font-size: 16px;
          line-height: 1.5;
        }
      </style>
      
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Online portal poslova</a>
          </div>
          <ul class="nav navbar-nav">
            <li class=""><a href="companies.php">Companies</a></li>
            <?php
            if(isset($_SESSION['ime']))
            {
              $ime = $_SESSION['ime'];
              if($ime == "ADMIN")
          {
            echo '<li><a href="users.php">Users</a></li>';
          }
      } 
      ?>
            <li><a href="ads.php">Ads</a></li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
          <?php 
            check();
           
           ?>
           
          </ul>
        </div>
        
      </nav>



           <?php 
                  error_reporting(0);
                  $data = getAds("cacheTxt/adsCache.txt");
                  error_reporting(E_ALL);
                  foreach($data as $red)
                  {
                      echo '<div class="ad-div"><h2 class="company-name">'. $red['ImeKompanije'] . '</h2>' .
                            '<p class="ad-text">' . $red['opisReklame'] . '</p>' . '</div>';
                 }
           ?>

    





</body>
</html>