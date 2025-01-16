<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database connection</title>
</head>
<body>
    <form action="index.php" method="post">
        <label for="dbName">Database name</label>
        <input type="text" name="dbName" placeholder="Input database name" required>
        <br><br>
        <label for="tableName">Input table name</label>
        <input type="text" name="tableName" placeholder="Input table name" required>
        <br><br>
        <label for="column1">Input first column name</label>
        <input type="text" name="column1" placeholder="Input column1 name" required>
        <br><br>
        <label for="column2">Input second column name</label>
        <input type="text" name="column2" placeholder="Input column2 name" required>
        <br><br>
        <button type="submit">Submit</button>
    </form>
    <?php
        $host = 'localhost';
        $user = 'root';
        $password = '';
        
        if (isset($_POST['dbName'], $_POST['tableName'], $_POST['column1'], $_POST['column2'])) {
            $dbName = $_POST['dbName'];
            $tableName = $_POST['tableName'];
            $column1 = $_POST['column1'];
            $column2 = $_POST['column2'];

            $conn = mysqli_connect($host, $user, $password);
            if (!$conn) {
                die("Cannot connect to the database.");
            }

            $sql = "CREATE DATABASE IF NOT EXISTS " . $dbName;
            if (mysqli_query($conn, $sql)) {
                echo "Database " . $dbName . " was successfully created or already exists.<br>";
            } else {
                echo "Error creating database: " . mysqli_error($conn) . "<br>";
            }

            mysqli_select_db($conn, $dbName);

            $tableSql = "CREATE TABLE IF NOT EXISTS " . $tableName . " (
                id INT AUTO_INCREMENT PRIMARY KEY,
                " . $column1 . " VARCHAR(255) NOT NULL,
                " . $column2 . " VARCHAR(255) NOT NULL
            )";

            if (mysqli_query($conn, $tableSql)) {
                echo "Table " . $tableName . " with columns " . $column1 . " and " . $column2 . " was successfully created!<br>";
            } else {
                echo "Error creating table: " . mysqli_error($conn) . "<br>";
            }

            mysqli_close($conn);
        } else {
            echo "Please fill in all the fields.<br>";
        }
    ?>
</body>
</html>