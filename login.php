<?php

include "connect.php";
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);

$error = null;
$message = "You are not logged in !";

if (isset($_POST) && !empty($_POST)) {
    try {
        $sql = "SELECT * FROM users WHERE email=? and password = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$email, $password]);
        if ($stmt->rowCount() == 0) {
            $error = "Email and Password not matched. Try again";
        } else {
            $getRow = $stmt->fetch(PDO::FETCH_ASSOC);
            session_start();
            $message = "YOU ARE NOW Logged In";
            $_SESSION["userid"] = $getRow['id'];
        }


    } catch (PDOException $e) {
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

<nav class="navbar navbar-default">
  <div class="container-fluid">
  <ul class="nav navbar-nav navbar-right">
      <li><a href="Logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
    </ul>
  </div>
</nav>
    <div class="container">
        <div class="row">
            <hr>
            <?php if (!empty($error)) {
                echo "<p class='alert alert-danger'>$error</p>";
            }
            if (!empty($message)) {
                echo "<p class='alert alert-success'>$message</p>";
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php if (isset($_SESSION["userid"])) { ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Student Id</th>
                                <th>Subject </th>
                                <th>Final Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01</td>
                                <td>Mary Doe</td>
                                <td>A+</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                        <hr>
                        <div id="data">
                        <form id="dataForm" method="POST" action="Add.php" class="form-horizontal">
                            <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" class="form-control mb-2" id="subject" name = "subject" placeholder="SUBJECT NAME">
                                <input type="number" class="form-control" id="finalgrade" name = "finalgrade" placeholder="0.00">
                            </div>
                            </div>
                            
                            
                            <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-default">Add</button>
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
</body>

</html>