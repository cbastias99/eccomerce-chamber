<?php
session_start();
require 'database.php';
if (isset($_SESSION['user_id'])) {
    header('Location:/login/index.php');
  }
$message = '';
if (!empty($_POST['email']) && !empty($_POST['password'])){
   $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";

   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':email',$_POST["email"]);
   $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
   $stmt->bindParam(':password',$password);

   if ($stmt->execute()){
    $message = 'Registrado satisfactoriamente';
    header('Location: /login/login.html');
   }
   else{
    $message='ha ocurrido un error creando su contraseña';
   }
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title><style >
        .container {
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.registrar{
    font-size: xx-large;
    font-weight: bolder;
}

.form {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    align-items: center;
    justify-content: center;
    border-radius: 2vw;
    border: 1px solid black;
    height: 80vh;
    width: 20vw;
}

.form input {
    width: 15vw;
    height: 6vh;
    border-radius: 1vw;
    outline: none;
    border: none;
    background-color: rgba(226, 226, 226, 0.8);
    margin: 2vh 1vw;
    font-size: medium;
}

.form input::placeholder {
    text-align: center;
}

.form button {
    width: 15vw;
    height: 6vh;
    border-radius: 1vw;
    outline: none;
    border: none;
    cursor: pointer;
    margin-top: 3vh;
}

.form button:hover {
    background-color: black;
    color: white;
}
    </style>
</head>
<body>
    <div class="container">
           <div class="card">
   
               <form class="form">
                   <p class="register">Sign up</p>
                   Indique su correo
                   <input type="text" name='email' placeholder="sucorreo">
                   contraseña
                   <input type="password" name="pass" id="pass"> 
                   Confirmar contraseña
                   <input type="password" name="pass" id="pass">

                   <button>Sign up</button>
               </form>
           </div>
       </div>
</body>
</html>
