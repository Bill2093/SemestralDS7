<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

if (array_key_exists('fname1', $_POST)){

    $sql = "CALL sp_buscar('".$_POST['fname1']."')";

    $result = $mysqli->query($sql);
    
    $palabra = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
<h1>Traductor</h1>
    
    <?php if (isset($user)): ?>
        
        <!--<p>Hola <?= htmlspecialchars($user["name"]) ?> Bienvenido </p>-->
        
        <p><a href="logout.php">Log out</a></p>

        <form method ="post" action ="index.php">
        <label for="fname">Escribir Palabra:</label>
        <input type="text" id="fname" name="fname1"><br><br>
        
        <input type="submit" value="Submit">

            </form>

        <h4>Resultado</h4>

        <label for="fname">Respuesta en Español:</label>
        <input type="text" id="fname" name="fname" value="<?php echo $palabra['Español']?>" placeholder="Primera Palabra"><br><br>

        <label for="fname">Respuesta en Ingles:</label>
        <input type="text" id="fname" name="fname" value="<?php echo $palabra['Ingles']?>" placeholder="Segunda Palabra"><br><br>
            
        <div class="fondo">
        
    <?php else: ?>
                
            <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>
                
    <?php endif; ?>
        
    </div> 
    
</body>
</html>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    