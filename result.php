<?php
session_start();
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

    

} else {
    $result = "Please enter a valid number.";
}



if (!isset($_SESSION['results'])) {
    $_SESSION['results'] = [];
}

// ✅ SAVE ALWAYS
array_unshift($_SESSION['results'], $result);
array_slice($_SESSION['results'], 0,10); // Keep only the last 10 results

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
            <th>Observation</th>
            <th>Value</th>
        </tr>
        <?php foreach ($_SESSION['results'] as $entry): ?>
        <tr>
            <td><?php echo $entry; ?></td>
        </tr>
        <?php endforeach; ?>
    

</table>
</body>
</html>
