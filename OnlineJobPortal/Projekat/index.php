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
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<style>
        .panel-heading{
            height:100px;
          

        }
        .panel-title{
            margin-top:15px ;
            font-weight: bold;
            font-size: 35px !important;
        }
        #datumP{
            position: absolute;
            top: 0;
            right: 0;
            font-weight: bold;
            text-transform: uppercase;
            color: #555;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .panel-body{
            position: relative;
        }
        .box{
            position: relative;
            font-family: "Montserrat", sans-serif;
            font-size: 14px;
            color: #777;
            text-align: center;
            
            
           
        }
        #opisPosla{
            display:flex;
            align-items: center;
            justify-content: center;

            font-family: "Montserrat", sans-serif;
            font-size: 20px;
            line-height: 1.6;
            color: #555;
            text-align: center;
            margin-top: 30px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f5f5f5;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

        }
        #zahteviPosla{
            display:flex;
            align-items: center;
            justify-content: center;
            margin-top:5px;
            font-family: "Montserrat", sans-serif;
            font-size: 20px;
            line-height: 1.6;
            color: #555;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f5f5f5;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        #location {
            position: absolute;
            left: 0;
            font-family: "Roboto", sans-serif;
            font-size: 18px;
            color: #fff;
            background-color: #4d4d4d;
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            }

        #location:hover {
        background-color: #777;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        transition: background-color 0.3s, box-shadow 0.3s;
        }
        
        #nazivKomp {
            font-size: 60px;
        font-weight: bold;
        margin: 15px;
        }
        #dugmence{
            
          
        }
        .dugme{
            display: inline-block;
            padding: 12px 24px;
            border-radius: 50px;
            background-color: #007bff;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
        }
    </style>

    <title>Online Portal Poslova</title>
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
<div class="panel-group" id="accordion">
        <?php
        error_reporting(0);
        $data = getJobs("cacheTxt/jobCache.txt");
        error_reporting(E_ALL);
        

        foreach($data as $row){

                    echo '<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" class="dohvati" href="#collapse' . $row['idPosao'] . '"id="' . $row['idPosao'] .'">';
                   
                    echo  $row['naslov'] . "<br>";
                    echo '</a>
                                </h4>
                            </div>
                            <div id="collapse' . $row['idPosao'] . '" class="panel-collapse collapse">
                                <div class="panel-body">';
                    
                            
                                
                     
                    $date = $row['datumPostavljanja']->format('F j, Y'); 
                    $date1 = $row['datumKraja']->format('F j, Y');
                    echo  '<div class=box><span id=datumP>Datum postavljanja: ' . $date . '<br>' . '
                    Datum zavrsetka prijava:' . $date1 . ' </span></div>' . "<br>";
                    
                    echo '<div class=box><div id=location>' . $row['lokacija'] .'</div></div><br>';
                    echo '<div class="box"><div id="nazivKomp">' . $row['ImeKompanije'] . '</div>' . '</div>';
                    echo '<div id=opisPosla>Opis posla: <br>'. $row['opisPosla'] . '</div>';

                    echo '<div id=zahteviPosla>Zahtevi posla: <br>'. $row['zahtevi'] . ' </div><br>';
                    if(isset($_SESSION['ime']) && isset($_SESSION['idKor']))
                    {   $ime = $_SESSION['ime'];
                        $idKor = $_SESSION['idKor'];
                        if($idKor==0)
                        {   
                            echo '<div id=dugmence><button class=dugme id='. $row['idPosao'] . ' onclick=ukloni()>Ukloni posao!</dugme></div>';

                        }
                        else if($ime!="ADMIN")
                        {
                            echo '<div id=dugmence><button class=dugme id='. $row['idPosao'] . ' onclick=prijava('. $idKor.')>Prijavi se!</dugme></div>';

                        }
                    }
                    
                    echo '</div>
                            </div>
                        </div>';}
          
        ?>
    </div>
    <div id="odg"></div>
</body>




<script>
    function prijava(idKor){
        let posaoId = $(event.target).attr('id');
        
        $.post("ajax/ajaxPrijava.php", {posaoId:posaoId}, function(response){
           $("#odg").html(response);
           window.location.href ="profile.php?idKor=" + idKor;
            alert(response);
        })
        
        
       }
</script>
</html>