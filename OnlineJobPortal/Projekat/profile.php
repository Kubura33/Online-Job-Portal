<?php 
require_once 'caching/cache.php';
require_once 'authorization.php';
require_once 'db_connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
      if(isset($_SESSION['ime']) && isset($_SESSION['prezime']))
      {
        echo '<title>' . $_SESSION['ime'] . " " . $_SESSION['prezime'] . '</title>';
      }
      else{
        echo '<title>Document</title>';
        
      }
    ?>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <style>
 
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
            if(!isset($_SESSION['ime']) || !isset( $_SESSION['prezime'])){
              header("Location: login.php");
              exit;
            }
            check();
          ?>
     
    </ul> 
      
    </nav>
    
            <div id="custom-modal" class="modal">
          <div class="modal-content">
            <h3>Are you sure you want to remove the job post?</h3>
            <div class="modal-buttons">
              <button id="confirm-btn" >Confirm</button>
              <button id="cancel-btn" >Cancel</button>
            </div>
          </div>
        </div>
        <div id="job-custom-modal" class="modal">
            <div class="job-modal-content">
              <h3>Add a Job Post</h3>
              <label for="job-title">Job Title:</label>
              <input type="text" id="job-title" required>

              <label for="location">Location:</label>
              <input type="text" id="location" required>

              <label for="job-description">Job Description:</label>
              <textarea id="job-description" required placeholder="Up to 1000 characters"></textarea>

              <label for="job-requirements">Job Requirements:</label>
              <textarea id="job-requirements" required placeholder="Up to 1000 characters"></textarea>

              <label for="ending-date">Job Post Ending Date:</label>
              <input type="date" id="ending-date" required>

              <div class="job-modal-buttons">
                <button id="job-confirm-btn">Add Job Post</button>
                <button id="job-cancel-btn">Cancel</button>
    </div>
  </div>
</div>

     
        
    <div class="profile">
       <?php 
        if(isset($_GET['idKor']))
        {
            $idKor = $_GET['idKor'];
            $conn = connectToDatabase();
            $sql = "SELECT idKorisnik, ime, prezime, iskustvo, diploma, kontaktTelefon, emailKorisnik FROM KORISNIK WHERE idKorisnik = {$idKor}";
            $result = sqlsrv_query($conn, $sql);
            if($result)
            {
                while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
                {
                    echo ' <div id="profile-info">
                        <div id="profile-name">' . $row['ime'] . " " . $row['prezime'] . '</div>
                        <div id="profile-description">
                        <label for="iskustvo">Iskustvo: </label> <span id=iskustvo>'. $row['iskustvo'] . '</span><br>
                        <label for="kontakt">Telefon: </label> <span id=kontakt>' . $row['kontaktTelefon'] . '</span><br>
                        <label for="email">Email: </label> <span id=email>'. $row['emailKorisnik'] .' </span><br>
                        <label for="diploma">Diploma: </label> <span id=diploma>' . $row['diploma'] .' </span><br>

                        </div>
                        </div>';
                }
            }
            //Finding the jobs user applied for 
            $sql = "SELECT PRIJAVA.IdPosao, ImeKompanije, naslov, lokacija, datumPrijave, datumKraja FROM POSAO, PRIJAVA, EMPLOYER
            WHERE PRIJAVA.idKorisnik = {$idKor} and PRIJAVA.IdPosao = POSAO.IdPosao and POSAO.EmployerID = EMPLOYER.EmployerID";
            $result = sqlsrv_query($conn, $sql);
            if($result)
            {   echo '<div id="applied-jobs">
            <h2>Applied to jobs</h2>';
                while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
                {
                    echo '<div class="applied-job-card"><div class="job-title">'. $row['naslov'] .'</div>
                    <div class="company-name">' . $row['ImeKompanije'] . '</div>
                    <div class="location">' . $row['lokacija'] .'</div>';
                    $date = $row['datumPrijave']->format('F j, Y'); 
                    $date1 = $row['datumKraja']->format('F j, Y');
                    echo '<div class="date">Datum prijave: ' . $date.'</div>
                    <div class="date">Datum zavrestka oglasa: ' . $date1 . '</div></div>';
                }
                echo '</div>';
            }
            else 
            {
                die(print_r(sqlsrv_errors(), true));
            }
        }
        else if(isset($_GET['idKomp']))
        {
          $idKomp = $_GET['idKomp'];
          $conn = connectToDatabase();
          $sql = "SELECT ImeKompanije, recruiter, grad, adresa, emailPoslodavac, telefonPoslodavac FROM EMPLOYER WHERE EmployerID = {$idKomp}";
          $result = sqlsrv_query($conn, $sql);
          if($result)
          {
            while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
            {
              echo '<div class="company-profile">
        <div id="company-profile-info">
            <div class="company-profile-name">' . $row['ImeKompanije'] . '</div>
            <div class="recruiter-info">Recruiter:  ' . $row['recruiter'] . '</div>
            <div class="company-address">City: ' . $row['grad'] .' , Address: ' . $row['adresa'] . '</div>
            <div class="company-contact">Email: ' . $row['emailPoslodavac'] . ' | Phone: ' . $row['telefonPoslodavac']. '</div>
        </div>';
            }
          }
          
          $sql = "SELECT IdPosao, naslov, lokacija, datumPostavljanja, datumKraja FROM POSAO WHERE EmployerID = {$idKomp}";
          $result = sqlsrv_query($conn, $sql);
          if($result)
          { echo '<h2>Job postings<button class="add-job" onclick=addJob()>Add a job post</button></h2>
            <div class="job-posts">';
      
      while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
          $date = $row['datumPostavljanja']->format('F j, Y'); 
          $date1 = $row['datumKraja']->format('F j, Y');
      
          echo '<div class="company-job-post-card"> 
                  <div class="close-button">
                      <span class="close-icon"  class="remove" id="'. $row['IdPosao'] .'" onclick=remove()>&#10005;</span>
                  </div>
                  <div class="job-title">' . $row['naslov'] . '</div>
                  <div class="job-location">' . $row['lokacija'] . '</div>
                  <div class="job-dates">
                      <span class="date-label">Posted on:</span>
                      <span class="start-date">' . $date . '</span><br>
                      <span class="date-label">End Date:</span>
                      <span class="end-date">' . $date1 . ' </span> <br>
                      <span class="editButton" id="'. $row['IdPosao'].'" onclick=edit()>Edit</span>
                      

                  </div>
                </div>';
      }
      
      echo '</div>';
          }
        }
    
    ?>
        
    </div>

            
        
    </div>
    
</body>
<script> 
let posaoId=0;
let editVal=0;
  $(document).ready(function() {
    // Move the variable declaration inside the $(document).ready() function
   

    // Attach the click event handlers for the Confirm and Cancel buttons
    $("#confirm-btn").on("click", function() {
      console.log(posaoId);
       $.post("ajax/ajaxRemovePost.php", { posaoId : posaoId}, function(response)
       { 
          location.reload();
       })
    
      $("#custom-modal").hide();
    });

    $("#cancel-btn").on("click", function() {
      $("#custom-modal").hide();
    });

    $("#job-confirm-btn").on("click", function() 
    {
      if(editVal==0)
      {
      const naslov = $("#job-title").val();
      const lokacija = $("#location").val();
      const opis = $("#job-description").val();
      const zahtevi = $("#job-requirements").val();
      const datum = $("#ending-date").val();

    
      $.post("ajax/ajaxDodajPosao.php", {naslov:naslov, lokacija: lokacija, opis:opis, zahtevi:zahtevi, datum:datum, posaoId:posaoId}, function(response)
      {
        
        location.reload();
      })}
      else if(editVal==1){
        const naslov = $("#job-title").val();
        const lokacija = $("#location").val();
        const opis = $("#job-description").val();
        const zahtevi = $("#job-requirements").val();
        const datum = $("#ending-date").val();
        $.post("ajax/ajaxEditJob.php", {naslov:naslov, lokacija: lokacija, opis:opis, zahtevi:zahtevi, datum:datum, posaoId:posaoId}, function(response){
          alert(response);
          editVal=0;
          location.reload();

        });
       
      }
      // Close the modal
      $("#job-custom-modal").hide();
    });
   
    $("#job-cancel-btn").on("click", function(){
      $("#job-custom-modal").hide();
    });
    
    
  });  
  function remove() {
       posaoId = $(event.target).attr("id");
      $("#custom-modal").show();
    }
  function addJob(){
    $("#job-title").val("");
        $("#location").val("");
        $("#job-description").val("");
        $("#job-requirements").val("");
       
        $("#ending-date").val("");
        $("#job-confirm-btn").text("Add job post");

   $("#job-custom-modal").show(); 
  }

  function edit(){
    editVal =1;
    posaoId= $(event.target).attr("id");
    console.log(posaoId);
    var jsonObject;
        $.post("ajax/ajaxFindJob.php", {posaoId: posaoId}, function(response){
          
          jsonObject = JSON.parse(response); 
        console.log(jsonObject);
        $("#job-title").val(jsonObject['naslov'].toString());
        $("#location").val(jsonObject['lokacija'].toString());
        $("#job-description").val(jsonObject['opisPosla'].toString());
        $("#job-requirements").val(jsonObject['zahtevi'].toString());
        var datumKrajaDate = jsonObject.datumKraja.date;
        var formattedDate = new Date(datumKrajaDate).toISOString().split('T')[0];
        $("#ending-date").val(formattedDate);
        $("#job-confirm-btn").text("Edit job");
        });
    $("#job-custom-modal").show();

  }
</script>
</html>