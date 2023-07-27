<?php 
    require_once "../db_connection.php";
    session_start();
    
    if(!isset($_SESSION['ime'])   || !isset($_SESSION['prezime']) || !isset($_SESSION['idKor']))
    {
        echo "Morate biti ulogovani!";
    }
    else{
        $conn= connectToDatabase();
       
      
            $idKor = $_SESSION['idKor'];
            $idPosao = $_POST['posaoId'];
            $sql = "{CALL dbo.dodajPrijavu(@idKor = ?, @idPosao = ?)}";
            $params = array(
                array(&$idKor, SQLSRV_PARAM_IN),
                array(&$idPosao, SQLSRV_PARAM_IN),
                
          
            );
           $rezultat = sqlsrv_query($conn, $sql, $params);
           if($rezultat==null){
            echo "Greska";
           }
          
            while($red = sqlsrv_fetch_array($rezultat,SQLSRV_FETCH_ASSOC)){
                if($red['alreadyApplied'] == 1){
                    echo "Vec ste se prijavili za ovaj posao!";
                }
                else {
                    echo "Uspesno ste se prijavili!";
                }
            }
           }
          
        

    


?>