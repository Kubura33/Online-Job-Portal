<?php 
    require_once '../db_connection.php';
    session_start();

    $conn = connectToDatabase();
    
        $idKomp = $_SESSION['idKomp'];
        $naslov = $_POST['naslov'];
        $zahtevi = $_POST['zahtevi'];
        $lokacija = $_POST['lokacija'];
        $opis = $_POST['opis'];
        $datum = $_POST['datum'];
        $date = date("Y-m-d", strtotime($datum));
        $params = array(
            array(&$idKomp, SQLSRV_PARAM_IN),
            array(&$naslov, SQLSRV_PARAM_IN),
            array(&$zahtevi, SQLSRV_PARAM_IN),
            array(&$lokacija, SQLSRV_PARAM_IN),
            array(&$date, SQLSRV_PARAM_IN),
            array(&$opis, SQLSRV_PARAM_IN)
            
            
      
        );
        $sql = "{CALL dbo.dodajPosao(@idEmployer = ?, @naslov = ?, @zahtevi = ? , @lokacija = ? , @datumKraja=? , @opis = ?)}";
        $rezultat = sqlsrv_query($conn, $sql, $params);

        if($rezultat == false){
            die(print_r(sqlsrv_errors(), true)); 
        }
        else {
            if(file_exists("../cacheTxt/jobCache.txt")){
            unlink("../cacheTxt/jobCache.txt");}
            if(file_exists("../cacheTxt/company_cache.txt")){
            unlink("../cacheTxt/company_cache.txt");}
            echo "Posao uspesno dodat!";
          
        }
    
?>