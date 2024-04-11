<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "Guest";
}

require_once("conction.php");
require_once "header.php";

$sql = "SELECT id, Titel, Gerecht, Prijs FROM Rio";
$stmt = $pdo->query($sql);

?>

<body class="admin-items">
<div class="items-container">
    <h2 class="welcoming-text">Welcome to the admin panel of Flaming burger</h2>

    <h3>Items List</h3>
    <a href="addDish.php" class="add-btn">Add Item</a>
    <table class="items-table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

       if ($stmt) {
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . highlightSearchTerm($row['Titel'], $searchTerm) . "</td>";
        echo "<td>" . highlightSearchTerm($row['Gerecht'], $searchTerm) . "</td>";
        echo "<td>$" . $row['Prijs'] . "</td>";
        echo "<td><a href='EditDish.php?id=" . $row['id'] . "' class='edit-btn'>Edit</a></td>";
        echo "<td><a href='deleteDish.php?id=" . $row['id'] . "' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No items found</td></tr>";
}


        function highlightSearchTerm($text, $searchTerm) {
            if ($searchTerm !== '') {
                $text = preg_replace("/\b($searchTerm)\b/i", "<span class='highlight'>$1</span>", $text);
            }
            return $text;
        }
?>


        <body class="menu-html">
        <form class="search-bar" method="GET">
            <input class="search-bar-text-btn" type="text" name="search" placeholder="Search" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button class="search-bar-text-btn" type="submit">Search </button>
        </form>
        </body>

<?php
$pdo = null;
?>
