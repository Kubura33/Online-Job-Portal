<?php 
    require_once 'db_connection.php';
    require_once 'caching/cache.php';
function getJobsFromDatabase(){
    $conn = connectToDatabase();
    $sql = "SELECT ImeKompanije, idPosao, POSAO.EmployerID, naslov, zahtevi, lokacija, datumPostavljanja, datumKraja, opisPosla 
            FROM EMPLOYER, POSAO 
            WHERE EMPLOYER.EmployerID = POSAO.EmployerID and datumKraja >= GETDATE()";

    $result = sqlsrv_query($conn, $sql);
    $data = array();
    if($result)
    {
        while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
        {
            $data[] = $row;
            
        }
        cacheUsersData($data, "cacheTxt/jobCache.txt");
    }
    return $data;
}

?>