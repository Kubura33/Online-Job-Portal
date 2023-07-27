<?php 
require_once 'db_connection.php';
require_once 'caching/cache.php';
function getAdsFromDatabase()
{
    $conn = connectToDatabase();
    $sql = "SELECT ImeKompanije, opisReklame 
            FROM EMPLOYER, REKLAMIRANJE
            WHERE EMPLOYER.EmployerID = REKLAMIRANJE.EmployerID";
    $result = sqlsrv_query($conn, $sql);
    $ads = array();
    if($result)
    {
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
        {
            $ads[] = $row;
        }
        cacheUsersData($ads,"cacheTxt/adsCache.txt");
        
    }
    return $ads;
}

?>