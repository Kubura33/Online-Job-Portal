<?php
function check()
{
    if (isset($_SESSION['ime']) && isset($_SESSION['prezime']) && isset($_SESSION['idKor'])) 
           {
             $ime = $_SESSION['ime'];
             $prezime = $_SESSION['prezime'];
             $idKor = $_SESSION['idKor'];
             if($ime!= "ADMIN"){
             echo "<li><a href='profile.php?idKor={$idKor}'><span class='glyphicon glyphicon-user'></span> $ime $prezime</a></li>";}
             else{
              echo "<li><a href='#'><span class='glyphicon glyphicon-user'></span> $ime $prezime</a></li>";
             }
             echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
           }
           else if(isset($_SESSION['ime']) && isset($_SESSION['prezime']) && isset($_SESSION['idKomp'])) {
             $ime = $_SESSION['ime'];
             $prezime = $_SESSION['prezime'];
             $idKomp = $_SESSION['idKomp'];
             
             echo "<li><a href='profile.php?idKomp={$idKomp}'><span class='glyphicon glyphicon-user'></span> $ime $prezime</a></li>";
             echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
            
           }
           
           else 
           {
             
             echo "<li id='zameni'><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
           }
}


?>