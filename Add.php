<?php

session_start();
include "connect.php";
include "college.php";  

$subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING);
$finalgrade = filter_input(INPUT_POST, "finalgrade", FILTER_VALIDATE_FLOAT);

$is_valid = true;

if($subject === false || $subject === null || $finalgrade === false || $finalgrade === null)
{
    $is_valid = false;
    echo "Incorrect..";
}
else
{
    $is_valid = true;
}

$access = isset($_SESSION["userid"]);
?>
<h1> <?= $access ?> </h1>
<?php

    if($is_valid)
    {

        $command = "INSERT INTO collegedatabase(subject, finalgrade) VALUES(?,?)";
        $stmt = $dbh->prepare($command);
        $params = [$subject, $finalgrade];
        $success = $stmt->execute($params);

        if($success)
        {
            echo "<p> {$subject}'s data has been added to College Database. </p>";
        }
        else
        {
            echo "<p> FAILED TO INSERT....</p>";
        }
    }
    else
    {
        echo "<p> FAILED....</p>";

    }
?>