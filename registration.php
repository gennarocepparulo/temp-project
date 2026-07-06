<?php
session_start();

try {
    $dsn = "mysql:host=localhost;dbname=prova;charset=utf8mb4";
    $pdo = new PDO($dsn, "temp_user", "temp123");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$username = $_POST["username"];
$password = $_POST["password"];
$repeatPassword = $_POST["repeat_password"];
$action = $_POST["action"];

if ($action === "register") {

    if ($password !== $repeatPassword) {
        echo "Passwords do not match ❌";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare(
        "INSERT INTO users (username, password) VALUES (?, ?)"
    );

    if ($stmt->execute([$username, $hashedPassword])) {
        echo "User registered successfully ✅";
    } else {
        echo "Error during registration ❌";
    }
}
if ($action === "login") {

    $stmt = $pdo->prepare(
        "SELECT * FROM users WHERE username = ?"
    );

    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user["password"])) {

            $_SESSION["user"] = $username;

            echo "Login successful ✅";

            header("Location: temp.php");
                    exit;

        } else {
            echo "Wrong password ❌";
        }
    } else {
        echo "User not found ❌";
    }
}
?>