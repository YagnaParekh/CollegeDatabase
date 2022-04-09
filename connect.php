<?php

    try
    {
        $dbh = new PDO ("mysql:host=localhost;dbname=sa000846481",
                        "root", "");
    }
    catch(Exception $e)
    {
        die("ERROR: COULDN'T CONNECT. {$e->getMessage()}");
    }
?>