<?php

if (empty($_POST["name"])) {
    die("Nombre es obligatorio");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Correo valido es requerido");
}

if (strlen($_POST["password"]) < 8) {
    die("La contraseña debe contener 8 caracteres");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("La contraseña debe contener al menos una letra");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("La contraseña debe contener al menos un número");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Contraseñas deben ser iguales");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash);
                  
if ($stmt->execute()) {
    

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("Correo utilizado");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}


?>





