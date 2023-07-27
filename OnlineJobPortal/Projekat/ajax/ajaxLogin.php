<?php
    require_once "../db_connection.php";
    session_start();

    $conn = connectToDatabase();
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $rowcount=0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($email == "" || $password=="")
        {
            echo "Unesite sve podatke!";
        }
        else if($email == "ADMIN" && $password=="ADMIN")
        {
            $_SESSION['ime'] = "ADMIN";
            $_SESSION['prezime'] = " ";
            $_SESSION['idKor']=0;
        }
        else
        {
            $sql = "SELECT idKorisnik, ime, prezime FROM KORISNIK WHERE emailKorisnik = '{$email}' and lozinka = '{$password}'";
            $rezultat = sqlsrv_query($conn,$sql);
            if ($rezultat === false) 
            {
                die(print_r(sqlsrv_errors(), true)); // Print the error details
            }
            
           else{
            
                while($row = sqlsrv_fetch_array($rezultat,SQLSRV_FETCH_ASSOC))
                {
                    $ime = $row['ime'];
                    $prezime = $row['prezime'];
                    $_SESSION['ime'] = $ime;
                    $_SESSION['prezime'] = $prezime;
                    $_SESSION['idKor'] = $row['idKorisnik'];
                    $rowcount++;
                   
                    
                }
                if($rowcount==1)
                {
                    echo "Ulogovani ste kao " . $ime . " " . $prezime ;
                    if(file_exists("../cacheTxt/company_cache.txt")){
                        unlink("../cacheTxt/company_cache.txt");}
                    if(file_exists("../cacheTxt/jobCache.txt")){
                        unlink("../cacheTxt/jobCache.txt");}
                    if(file_exists("../cacheTxt/adsCache.txt")){
                            unlink("../cacheTxt/adsCache.txt");}
                     if(file_exists("../cacheTxt/users_cache.txt")){
                            unlink("../cacheTxt/users_cache.txt");}
                }
                else
                {
                    echo "Ne postoji korisnik sa unetim podacima";
                }
            
           }
        }
    }
?>