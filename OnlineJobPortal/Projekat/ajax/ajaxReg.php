<?php 
    require_once "../db_connection.php";
    $conn = connectToDatabase();
  
    if(isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['lozinka']) && isset($_POST['iskustvo']) && isset($_POST['diploma']) && isset($_POST['brT']) && isset($_POST['email']) ){
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $lozinka = $_POST['lozinka'];
        $iskustvo = $_POST['iskustvo'];
        $diploma = $_POST['diploma'];
        $brT = $_POST['brT'];
        $email = $_POST['email'];
        $sql = "{CALL dbo.dodajKorisnika(@ime = ?, @prezime = ?, @lozinka = ?, @iskustvo = ?, @diploma = ?, @brT = ?, @email = ?)}";

        $params = array(
            array(&$ime, SQLSRV_PARAM_IN),
            array(&$prezime, SQLSRV_PARAM_IN),
            array(&$lozinka, SQLSRV_PARAM_IN),
            array(&$iskustvo, SQLSRV_PARAM_IN),
            array(&$diploma, SQLSRV_PARAM_IN),
            array(&$brT, SQLSRV_PARAM_IN),
            array(&$email, SQLSRV_PARAM_IN)
        );
    
        $result = sqlsrv_query($conn, $sql, $params);
        if($result == false){
            die("Error executing stored procedure: " . print_r(sqlsrv_errors(), true));}
        else{
            if(file_exists("../cacheTxt/company_cache.txt")){
                unlink("../cacheTxt/company_cache.txt");}
            if(file_exists("../cacheTxt/jobCache.txt")){
                unlink("../cacheTxt/jobCache.txt");}
            if(file_exists("../cacheTxt/adsCache.txt")){
                    unlink("../cacheTxt/adsCache.txt");}
             if(file_exists("../cacheTxt/users_cache.txt")){
                    unlink("../cacheTxt/users_cache.txt");}
           
            echo "Uspesno";}
        
     }


?>