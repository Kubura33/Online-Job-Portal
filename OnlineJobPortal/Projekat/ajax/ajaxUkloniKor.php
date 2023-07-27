<?php 
require_once "../db_connection.php";

$conn = connectToDatabase();

    

    $id = $_POST['korId'];

    $sql = "{CALL dbo.ukloniKorisnika(@id = ?)}";
    $params = array( array(&$id, SQLSRV_PARAM_IN));
    $rezultat = sqlsrv_query($conn, $sql, $params);
    if($rezultat==null)
        {
        die(print_r(sqlsrv_errors(), true));
            
        }
    else{
        if(file_exists("../cacheTxt/users_cache.txt"))
        {
                unlink("../cacheTxt/users_cache.txt");
        }
            echo "Uspesno!";
        }
        
       
    
    


?>