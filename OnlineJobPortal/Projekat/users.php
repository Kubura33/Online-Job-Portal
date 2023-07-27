<?php
require_once 'caching/cache.php';
require_once "authorization.php"; 
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
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <style>
        table{
            font-size: 20px;
        }
        #userRemove:hover {
          cursor: pointer;
          color: purple;
        }
    </style>
    <title>Users</title>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Online portal poslova</a>
          </div>
          <ul class="nav navbar-nav">
            <li class=""><a href="companies.php">Companies</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="ads.php">Ads</a></li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            
          <ul class="nav navbar-nav navbar-right">
      <?php 
          check();
      ?>
     
    </ul>
          </ul> 
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search" oninput="test()" id="searchInput">
      </div>
      
      
    
        </div>
        
      </nav>


      <table class="table table-striped">
        <thead>
          <tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Iskustvo</th>
            <th>Diploma</th>
            <th>Kontakt</th>
            <th>Email</th>

          </tr>
        </thead>
        <tbody id='teloTabele'>
            <?php 
                error_reporting(0);
                $data = getUsers("cacheTxt/users_cache.txt");
                error_reporting(E_ALL);
                foreach($data as $row)
                {
                        echo '<tr>'.
                        '<td>' . $row['ime'] . '</td>' .
                        '<td>' . $row['prezime'] . '</td>' .
                        '<td>' . $row['iskustvo'] . '</td>' .
                        '<td>' . $row['diploma'] . '</td>' .
                        '<td>' . $row['kontaktTelefon'] . '</td>' .
                        '<td>' . $row['emailKorisnik'] . '</td>' .
                        '<td id="userRemove"><span id="'. $row['idKorisnik'] .'" onclick=klikni()>Remove</span></td></tr>';
                      }

                         
            
            ?>
          <tr></tr>
        </tbody>
      </table>
    </div>
   
</body>
<script>
  function test(){
    let slova = ($('#searchInput').val());
   
   
      $.post("ajax/ajaxPretraga.php", {slova:slova}, function(response){
          $("#teloTabele").html(response);
      })
    
  }
  function klikni(){
    let response =confirm("Jeste li sigurni da zelite da uklonite korisnika?");
    if(response){
      let korId = $(event.target).attr("id");
      console.log(korId);
      $.post("ajax/ajaxUkloniKor.php", {korId:korId}, function(response){
        alert("Korisnik uspesno uklonjen");
        location.reload();
      })
    }
  }
</script>
</html>
