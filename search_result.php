
<?php

require_once("settings.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Unable to connect to the database: " . mysqli_connect_error());
}

if (isset($_GET['model'])) {

    $model = mysqli_real_escape_string($conn, trim($_GET['model']));

    if ($model == "") {
        echo "Please enter a model to search.";
    }
    else {

        $sql = "SELECT * FROM cars WHERE model LIKE '%$model%'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            echo "<h1>Search Results</h1>";

            echo "<table border='1' cellpadding='5'>";

            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Make</th>";
            echo "<th>Model</th>";
            echo "<th>Price</th>";
            echo "<th>Year</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($result)) {

                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['car_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['make']) . "</td>";
                echo "<td>" . htmlspecialchars($row['model']) . "</td>";
                echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                echo "<td>" . htmlspecialchars($row['yom']) . "</td>";
                echo "</tr>";

            }

            echo "</table>";

        }
        else {
            echo "No matching cars found.";
        }
    }

}
else {
    echo "Please enter a model to search.";
}

mysqli_close($conn);

?>