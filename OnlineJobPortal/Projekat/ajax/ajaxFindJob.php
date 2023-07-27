<?php 
require_once("../db_connection.php");
if(isset($_POST['posaoId']))
{   $conn = connectToDatabase();
    $id = $_POST['posaoId'];
    $sql = "SELECT naslov, lokacija, opisPosla, zahtevi, datumKraja FROM POSAO WHERE IdPosao = {$id} ";
    $result = sqlsrv_query($conn, $sql);
    if($result){
        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        if ($row) {
            echo json_encode($row);
        } else {
            echo json_encode(array("error" => "No matching record found for posaoId: " . $id));
        }
    } else {
        echo json_encode(array("error" => "Error executing the SQL query: " . print_r(sqlsrv_errors(), true)));
    }
} else {
    echo json_encode(array("error" => "No posaoId parameter received."));
}


?>