<?php
function ensureDatabaseCreated()
{
    mysqli_report(MYSQLI_REPORT_OFF);
    $c = new mysqli(
        $_ENV["WSM_DBHELPER_SERVER"],
        $_ENV["WSM_DBHELPER_USERNAME"],
        $_ENV["WSM_DBHELPER_PASSWORD"]
    );
    if ($e = $c->connect_error)
        throw new Exception("Connection failed: $e");

    $sql = "CREATE DATABASE " . $_ENV["WSM_DBHELPER_DATABASE"];
    $result = !$c->query($sql);
    $c->close();
    return $result;
}

function connectDatabase() {
    mysqli_report(MYSQLI_REPORT_OFF);
    $r = new mysqli(
        $_ENV["WSM_DBHELPER_SERVER"],
        $_ENV["WSM_DBHELPER_USERNAME"],
        $_ENV["WSM_DBHELPER_PASSWORD"],
        $_ENV["WSM_DBHELPER_DATABASE"]
    );
    if ($e = $r->connect_error)
        throw new Exception("Connection failed: $e");
    return $r;
}
?>