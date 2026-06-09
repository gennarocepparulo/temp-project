<?php

$result = "";

$celsius = $_GET["c"] ?? "";

if ($celsius !== "" && is_numeric($celsius)) {

    if ($celsius > 100) {
        $result = "The value is too elevated.";
    } else {
        $fahrenheit = ($celsius * 9 / 5) + 32;
        $date = date("Y-m-d H:i:s");
        $result = $celsius . " °C = " . $fahrenheit . " °F";
        $result = $date . " | " . $result;
    }

    // ✅ SAVE ALWAYS
    file_put_contents(__DIR__ . "/data.txt", $result . "\n", FILE_APPEND | LOCK_EX);

} else {
    $result = "Please enter a valid number.";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="result">
    <h1>Result</h1>

    <p><?php echo $result; ?></p>

    <a href="temp.php">
        <button>Back</button>
    </a>
    </div>

    <h2>Last 10 Results</h2>

    <table>
    <tr>
        <th>Obeserved</th>
        <th>Value</th>
    </tr>

    <?php
    $file = __DIR__ . "/data.txt";

    if (file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $index => $line) {
        echo "<tr>";
        echo "<td>" . ($index + 1) . "</td>";
        echo "<td>" . $line . "</td>";
        echo "</tr>";
    }
    }
    ?>

</table>
</body>
</html>
