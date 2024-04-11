<?php
include_once "conction.php";
include_once "header.php";

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM Rio";
$stmt = $pdo->query($sql);

echo "<div class='menu-item-container'>";
while ($Rio = $stmt->fetch()) {
    echo "<div class='menu-item'>";
    echo "<div class='menu-title'>" . highlightSearchTerm($Rio['Titel'], $searchTerm) . "</div>";
    echo "<div class='menu-description'>" . highlightSearchTerm($Rio['Gerecht'], $searchTerm) . "</div>";
    echo "<div class='menu-price'>Price: $" . highlightSearchTerm($Rio['Prijs'], $searchTerm) . "</div>";

    if ($Rio['image'] != "") {
        echo "<img class='object-fit' width='120' style='margin-top: 8px;' src='pics/" . $Rio['image'] . "' />";
    }
    echo "</div>";
}
echo "</div>";

function highlightSearchTerm($text, $searchTerm) {
    if ($searchTerm !== '') {
        $text = preg_replace("/\b($searchTerm)\b/i", "<span class='highlight'>$1</span>", $text);
    }
    return $text;
}
?>

<html>
<head>
    <style>
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
</head>
<body class="menu-html">
<form class="search-bar" method="GET">
    <input class="search-bar-text-btn" type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($searchTerm); ?>">
    <button class="search-bar-text-btn" type="submit">Search</button>
</form>
</body>
</html>
