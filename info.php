<?php

include "connect.php";
include "college.php";

session_start();

$access = isset($_SESSION["userid"]);

if($access)
{
    $command = "SELECT * FROM collegedatabase ORDER BY subject DESC";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute();

    $student_list = [];

    if($success)
    {
        while($row = $stmt->fetch())
        {
            $student = [
                "id"=>$row["id"],
                "subject"=>$row["subject"],
                "finalgrade"=>$row["finalgrade"]
            ];
            array_push($student_list, $student);
        }
    }
    else
    {
        echo "<p>FAILED......</p>";
    }
}
else
{
    echo "<p> ACCESS DENIED....</p>";
}

echo json_encode($student_list);
?>