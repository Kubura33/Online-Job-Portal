<?php 
require_once 'caching/cache.php';
require_once 'authorization.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    .company-card {
        background-color: #f2f2f2;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
        margin-top: 20px;
       
    }
    p{
      font-size: 22px !important;
    }
    .company-card h3 {
        color: #333;
        font-size: 40px;
        margin-bottom: 10px;
    }

    .company-card p {
        color: #777;
        margin-bottom: 5px;
    }

    .company-card .label {
        font-weight: bold;
    }

    .company-card .recruiter {
        color: #555;
       
    }

    .company-card .address {
        color: #555;
        margin-bottom: 10px;
    }

    .company-card .email,
    .company-card .phone {
        color: #555;
        margin-bottom: 5px;
    }

    .company-card .description {
        color: #777;
        text-align: justify;
        font-size: 20px !important; 
        
    }
</style>


    <title>Companies</title>
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
     
    </ul> <form class="navbar-form navbar-left" action="/action_page.php">
      
    </nav>
    <?php error_reporting(0);
          $data = getCompanies("cacheTxt/company_cache.txt");
          error_reporting(E_ALL);
          foreach($data as $red)
          {
            echo '<div class="company-card">' . 
            '<h3>'. $red['ImeKompanije'] . '</h3>' . 
            '<p class="label">Recruiter: <span class="recruiter">' . $red['recruiter'] . '</span></p>' . 
            '<p class="label">Adresa: <span class="address">' . $red['adresa'] . ', ' . $red['grad'] . '</span></p>' . 
            '<p class="label">Email: <span class="email">' . $red['emailPoslodavac'] . '</span></p>' .
            '<p class="label">Phone: <span class="phone">'. $red['telefonPoslodavac'] . '</span></p>' . 
            '<p class="description">' . $red['opisPoslodavac'] . '</p>' . 
            '</div>';
          }
         
      
      
    ?>
      
</body>
</html>