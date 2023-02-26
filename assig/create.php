<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "assig";

$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the feilds are required";
            break;
        }

        if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
            $errorMessage = 'Please enter a valid email!';
            break;
        }
        
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $errorMessage = 'Please enter a valid phone number!';
            break;
        }

        // add new student to database
        $sql = "INSERT INTO students(name, email,phone,address)" .
            "VALUES ('$name', '$email', '$phone', '$address')";
        $result = $connection->query($sql);
        if (!$result) {
            if (strpos($connection->error, 'email') !== false) {
                $errorMessage = 'This email already in use.';
            } elseif (strpos($connection->error, 'phone') !== false) {
                $errorMessage = 'This phone number already in use.';
            } else {
                $errorMessage = 'Oops! something went wrong please try again.';
            }
            break;
        }

        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Student added correctly";

        header("location: ./index.php");
        exit;
    }
    while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2>New student</h2>
        <?php

        if (!empty($errorMessage)) {
            echo " <div class='alert alert-danger'> $errorMessage </div>";
        }
        ?>

        <form method="post">
            <div class="row">
                <label class="label">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="row">
                <label class="label">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="row">
                <label class="label">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
            </div>
            <div class="row">
                <label class="label">Address</label>
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
            </div>
            <?php
            if (!empty($successMessage)) {
                echo " <strong> $successMessage </strong>";
            }
            ?>

            <div class="row">
                <div class="button">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="button">
                    <a class="btn btn-outline-primary" href="./index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>