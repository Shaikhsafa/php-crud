<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "assig";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("connection failed: " . $connection->connect_error);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h2>Student</h2>
        <a class="btn btn-primary my-3" href="./create.php">Add Student</a>
        <br>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <tbody>

                <?php
                $sql = "SELECT * FROM students";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }
                //read data of each row
                while ($row = $result->fetch_assoc()) {
                    echo " 
    <tr>
        <td>$row[id]</td>
        <td>$row[name]</td>
        <td>$row[email]</td>
        <td>$row[phone]</td>
        <td>$row[address]</td>
        <td>$row[created_at]</td>
        <td>
            <a class='btn-primary' href='./edit.php?id=$row[id]'>Edit</a>
            <a class='btn-primary'href='./delete.php?id=$row[id]'>Delete</a>

        </td>
    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>