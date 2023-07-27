<?php 
    require_once '../db_connection.php';
     $idPosao = $_POST['posaoId'];
        $conn = connectToDatabase();
        $sql = "DELETE FROM POSAO WHERE IdPosao={$idPosao} ";
        $result = sqlsrv_query($conn,$sql);
        if($result)
        {   
            $sql = "{CALL dbo.ukloniPosao(@id = ?)}";
            $params = array(
                array(&$idPosao, SQLSRV_PARAM_IN)
               
                
          
            );
            $rezultat = sqlsrv_query($conn, $sql, $params);
           if($rezultat==null)
           {
            die(print_r(sqlsrv_errors(), true));
            
           }
           else{
            if(file_exists("../cacheTxt/company_cache.txt")){
            unlink("../cacheTxt/company_cache.txt");}
            if(file_exists("../cacheTxt/jobCache.txt")){
            unlink("../cacheTxt/jobCache.txt");}
            echo "Uspesno!";
           }
        }
    

?>