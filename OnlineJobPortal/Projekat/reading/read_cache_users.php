<?php 
    require_once 'db_connection.php';
    require_once 'caching/cache.php';


    function getUsersFromDatabase()
    {   
        $conn = connectToDatabase();
        $sql = "SELECT idKorisnik, ime, prezime, iskustvo, diploma, kontaktTelefon, emailKorisnik FROM KORISNIK";
        $result = sqlsrv_query($conn, $sql);
        $usersData = array();
        if($result)
        {
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) 
            {
                
                $usersData[] = $row;
            }
            cacheUsersData($usersData, 'cacheTxt/users_cache.txt');
        }
        else {
            die(print_r(sqlsrv_errors(), true));
        }

        return $usersData;

    }


    function getCompaniesFromDatabase()
{   
    $conn = connectToDatabase();
    $sql = "SELECT EmployerID, ImeKompanije, recruiter, grad, adresa, emailPoslodavac, telefonPoslodavac, opisPoslodavac  FROM EMPLOYER";
    $result = sqlsrv_query($conn, $sql);
    $companyData = array();
    if($result)
    {
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) 
        {
            
            $companyData[] = $row;
            cacheUsersData($companyData, 'cacheTxt/company_cache.txt');
        }
    }
    else {
        die(print_r(sqlsrv_errors(), true));
    }

    return $companyData;

}

   
?>