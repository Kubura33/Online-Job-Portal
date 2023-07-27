<?php 
require_once "../db_connection.php";
$conn = connectToDatabase();
if(isset($_POST['slova'])){
    $slova = $_POST['slova'];
    if($slova==""){
      
        if($conn)
        {
            $sql = "SELECT ime, prezime, iskustvo, diploma, kontaktTelefon, emailKorisnik FROM KORISNIK";
            $result = sqlsrv_query($conn,$sql);
            if($result)
            {
                while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
                {   
                    echo '<tr>'.
                    '<td>' . $row['ime'] . '</td>' .
                    '<td>' . $row['prezime'] . '</td>' .
                    '<td>' . $row['iskustvo'] . '</td>' .
                    '<td>' . $row['diploma'] . '</td>' .
                    '<td>' . $row['kontaktTelefon'] . '</td>' .
                    '<td>' . $row['emailKorisnik'] . '</td>' .
                    '</tr>';

                }
            }

        } 
    }
    else{
    $sql = "SELECT * FROM dbo.pretraziKorisnika('{$slova}')";
    $rezultat = sqlsrv_query($conn, $sql);
    if($rezultat==null){
        die(print_r(sqlsrv_errors(), true));
    }
    else{
        while($row = sqlsrv_fetch_array($rezultat,SQLSRV_FETCH_ASSOC))
                    {   
                        echo "<tr>";
                        echo "<td>" . $row['ime'] . "</td>";
                        echo "<td>" . $row['prezime'] . "</td>";
                        echo "<td>" . $row['iskustvo'] . "</td>";
                        echo "<td>" . $row['diploma'] . "</td>";
                        echo "<td>" . $row['kontaktTelefon'] . "</td>";
                        echo "<td>" . $row['emailKorisnik'] . "</td>";
                        echo "</tr>";

                    }
    }}
}

?>