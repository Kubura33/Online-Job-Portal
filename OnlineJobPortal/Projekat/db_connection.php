<?php 
function connectToDatabase(){
      $serverName = "DESKTOP-80KOAUD\\SQLEXPRESS";
      $connectionOptions = array
      (
          "Database" => "OnlinePortalPoslova",
          "CharacterSet" => "UTF-8"
      );
      
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) 
    {
        die(print_r(sqlsrv_errors(), true));
    }

    return $conn;}

?>