<?php 
    require_once "../db_connection.php";
    if(isset($_POST['naslov']) && isset($_POST['opis']) && isset($_POST['lokacija']) && isset($_POST['datum']) && isset($_POST['zahtevi']) && isset($_POST['posaoId'])){
        $naslov = $_POST['naslov'];
        $opis = $_POST['opis'];
        $lokacija = $_POST['lokacija'];
        $datum = $_POST['datum'];
        $zahtevi = $_POST['zahtevi'];
        $posaoId = $_POST['posaoId'];
        $conn = connectToDatabase();
        $sql = "UPDATE POSAO SET naslov = '{$naslov}' , opisPosla = '{$opis}', lokacija = '{$lokacija}', datumKraja = '{$datum}', zahtevi = '{$zahtevi}' where IdPosao = {$posaoId}";
        $result = sqlsrv_query($conn,$sql);
        if($result)
        {
            echo "Job successfully edited!";

        }
        else 
        {
            die(print_r(sqlsrv_errors(), true));
        }
    }
?>