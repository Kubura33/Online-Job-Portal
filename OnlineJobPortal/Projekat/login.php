<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .login-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 150px;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-container .form-control {
      border-radius: 0;
    }

    .login-container .btn-primary {
      border-radius: 0;
      width: 100%;
    }

    .login-container .btn-primary:hover {
      background-color: #2c3e50;
      border-color: #2c3e50;
    }

    .login-container .create-account {
      text-align: center;
      margin-top: 20px;
    }

    .login-container .create-account a {
      color: #2c3e50;
      text-decoration: none;
    }

    .login-container .create-account a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  
  <div class="container">
    <div class="login-container">
      <h2>Login</h2>
      
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Email" required id="email">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Password" required id="password">
        </div>
        <br>
        <input type="checkbox" id="cek" name="cek"> <label for="cek">Kompanija?</label>
        <button type="submit" class="btn btn-primary" onclick=login()>Login</button>
        <div class="create-account">
          <p>Don't have an account? <a href="register.php">Create one</a></p>
        </div>
        
    </div>
  </div>
</body>
<script>
  $(document).ready(function(){});

  function login(){
    let email = $("#email").val();
    let password = $("#password").val();
    if($("#cek").prop("checked")){
      $.post("ajax/ajaxKompanijaLogin.php", {email:email, password:password}, function(response){
       
       
       window.location.href ="index.php";
       
     })
    }
    else{
    if(email == "" || password == ""){
      alert("Unesite sve parametre");
    }
    else{
      $.post("ajax/ajaxLogin.php", {email:email, password:password}, function(response){
       
       
        window.location.href ="index.php";
        
      })
    }}
  }

</script>
</html>
