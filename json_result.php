<?php

$file = __DIR__ . "/data.json";


// Load data
$results = [];

if (file_exists($file)) {
    $json = file_get_contents($file);

    if (!empty($json)) {
        $decoded = json_decode($json, true);

        if (is_array($decoded)) {
            $results = $decoded;
        }
    }
}

$celsius = $_GET["c"] ?? "";
$result = "";

if ($celsius !== "" && is_numeric($celsius)) {

    if ($celsius > 100) {
        $result = "The value is too elevated.";
    } else {
        $fahrenheit = ($celsius * 9 / 5) + 32;
        $date = date("Y-m-d H:i:s");

        $entry = [
            "date" => $date,
            "conversion" => $celsius . " °C = " . $fahrenheit . " °F"
        ];
        // ✅ SAVE ALWAYS
        array_unshift($results, $entry);

        $results = array_slice($results, 0, 10);// Keep only the last 10 results

        file_put_contents($file, json_encode($results, JSON_PRETTY_PRINT));

        $result = $entry['conversion'];
    }

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
    <a href="json_temp.php">
        <button>Back</button>
    </a>    
    </div>      

    <h2>Last 10 Results</h2>

    <table>
        <tr>
            <th>Date</th>
            <th>Conversion</th>
        </tr>
        <?php foreach ($results as $entry): ?>
        <tr>
            <td><?php echo $entry['date']; ?></td>
            <td><?php echo $entry['conversion']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html> 