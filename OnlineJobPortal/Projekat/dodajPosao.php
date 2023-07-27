<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <title>Add User</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Dodaj posao</h2>
       
            <div class="form-group">
                <label for="name">Naziv</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Unesi naziv">
            </div>
            <div class="form-group">
                <label for="email">Zahtevi</label>
                <textarea class="form-control" id="zahtevi" name="description" placeholder="Unesite zahteve posla (up to 1000 characters)" rows="3" maxlength="1000"></textarea>
               
            </div>
            <div class="form-group">
                <label for="description">Opis Posla</label>
                <textarea class="form-control" id="description" name="description" placeholder="Unesite opis posla (up to 1000 characters)" rows="3" maxlength="1000"></textarea>
            </div>
            <div class="form-group">
                <label for="location">Lokacija</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Lokacija">
            </div>
            <div class="form-group">
                <label for="endDate">Datum Kraja</label>
                <input type="date" class="form-control" id="endDate" name="endDate">
            </div>
            <button type="submit" class="btn btn-primary" onclick="dodaj()">Add</button>
        
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
    function dodaj(){
        let naziv = $("#name").val()
        let zahtevi = $("#zahtevi").val()
        let opis = $("#description").val()
        let lokacija = $("#location").val()
        let datum = $("#endDate").val()
        if(naziv =="" || zahtevi =="" || opis == "" || lokacija =="" || datum == ""){
            alert("Unesi podatke!")
        }
        else{
            $.post("ajax/ajaxDodajPosao.php", {naziv:naziv, zahtevi:zahtevi, opis:opis, lokacija:lokacija, datum:datum}, function(response){
                alert(response)
            })
        }
    }
</script>
</html>
