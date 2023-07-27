<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <style>
         body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-sizing: border-box;
        }

        label {
            display: block;
            text-align: left;
            color: #333333;
            margin-top: 15px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #cccccc;
            box-sizing: border-box;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            border-radius: 4px;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 10px;
            color: #666666;
        }
    </style>
    <title>Register</title>
</head>
<body>
    <div class="container">
    
            <label for="ime">Ime</label>
            <br>
            <input type="text" id="ime">
            <br>
            <label for="prezime">Prezime</label>
            <br>
            <input type="text" id="prezime">
            <br>
            <label for="lozinka">Lozinka</label>
            <br>
            <input type="password" id="lozinka">
            <br>
            <label for="iskustvo">Iskustvo</label>
            <br>
            <input type="text" id="iskustvo">
            <br>
            <label for="diploma">Diploma</label>
            <br>
            <input type="text" id="diploma">
            <br>
            <label for="brT">Broj telefona</label>
            <br>
            <input type="text" id="brT">
            <br>
            <label for="email">E-mail</label>
            <br>
            <input type="email" id="email">
            <br>
            <br>
            <button id='register' onclick="login()">Registruj se</button>
            <br>
            
            <div id="odg"></div>

    
    
    </div>
</body>
<script>
    $(document).ready(function(){

    });
    function login(){
        let ime = $("#ime").val();
        let prezime = $("#prezime").val();
        let lozinka = $("#lozinka").val();
        let iskustvo = $("#iskustvo").val();
        let diploma = $("#diploma").val();
        let brT = $("#brT").val();
        let email = $("#email").val();
        if(ime == "" || prezime == "" || lozinka == "" || iskustvo == "" || diploma == "" || brT == "" || email == "" ){
                $("#odg").html("Unesite sve podatke!");
        }
        else{
            $.post("ajax/ajaxReg.php", {ime:ime, prezime:prezime, lozinka:lozinka, iskustvo:iskustvo, diploma:diploma, brT:brT, email:email}, function(response){
                $("#odg").html(response);
                window.location.href ="login.php";
            })
        }

    }
</script>
</html>