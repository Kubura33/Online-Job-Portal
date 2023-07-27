<?php 
    session_start();
    require_once "../db_connection.php";
    $conn = connectToDatabase();
   
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $rowcount=0;
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($email == "" || $password==""){
            echo "Unesite sve podatke!";
        }
        else{
            $sql = "SELECT EmployerID, ImeKompanije, recruiter FROM EMPLOYER WHERE emailPoslodavac = '{$email}' and lozinka = '{$password}'";
            $rezultat = sqlsrv_query($conn,$sql);
            if ($rezultat === false) {
                die(print_r(sqlsrv_errors(), true)); // Print the error details
            }
            
           else{
            
                while($row = sqlsrv_fetch_array($rezultat,SQLSRV_FETCH_ASSOC)){
                    $ime = $row['ImeKompanije'];
                    $prezime = $row['recruiter'];
                    $_SESSION['ime'] = $ime;
                    $_SESSION['prezime'] = $prezime;
                    $_SESSION['idKomp'] = $row['EmployerID'];
                    $rowcount++;
                   
                    
                }
                if($rowcount==1){
                    echo "Ulogovani ste kao " . $ime . " " . $prezime ;
                }
                else{
                    echo "Ne postoji korisnik sa unetim podacima";
                }
            
           }
        }
    }
?>