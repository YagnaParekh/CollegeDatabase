<?php

include "connect.php";
$userid = filter_input(INPUT_POST, "userid", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);

$error = null;
$message = null;

if (isset($_POST)) {
    try {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $error = "Email already exist. Try again";
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES ( :name, :email, :password)";
            $stmt = $dbh->prepare($sql);
            $params = ['name' => $userid, 'email' => $email, 'password' => $password];
            $success = $stmt->execute($params);
            if ($success) {
                $userId = $dbh->lastInsertId();
                session_start();
                $message = "YOU ARE NOW REGISTERED";
            } else {
                $error = "FAILED....";
            }
        }
    } catch (PDOException $e) {
        var_dump($e);
        $errors = $e->getMessage();
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>College Database</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <hr>
                <?php if (!empty($error)) {
                    "<p class='alert alert-danger'>$error</p>";
                }
                if (!empty($message)) {
                    "<p class='alert alert-success'>$message</p>";
                }
                ?>
                <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-warning">Go Back</a>
            </div>
        </div>
    </div>
</body>

</html>