<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: registration.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature Converter</title>
    
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <div class="container">

    <?php if (isset($_SESSION["user"])): ?>

  
    <?php else: ?>

        <a href="registration.html">Login / Register</a>

    <?php endif; ?>
    
<p>Welcome, <?php echo $_SESSION["user"]; ?></p>


    <button><a href="logout.php">Logout</a></button>
    


    <h1>Celsius to Fahrenheit</h1>
   <p>Celsius is way better 😄</p>

    <form action="result.php" method="get">
        <input type="text" name="c" placeholder="Enter Celsius">
        <button type="submit">Go</button>
        <p><?php echo hello; ?></p>
    </form>
    </div>
</body>
</html>
