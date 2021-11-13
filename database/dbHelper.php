<?php
require_once('config.php');
function execute($sql)
{
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE, PORT);
    // run query insert, update, delete
    return mysqli_query($con, $sql);
    // close database
    mysqli_close($con);
}

function executeResult($sql)
{
    $con    = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE, PORT);
    // echo "$sql";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $data   = [];
        while ($row = mysqli_fetch_array($result, 1)) {
            $data[] = $row;
        }
        // close database
        mysqli_close($con);
        return $data;
    } else {
        return null;
    }
}
function executeOneResult($sql)
{
    $con    = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE, PORT);
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_assoc($result);
    return $row;
}
function executeReturnId($sql)
{
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE, PORT);
    if (mysqli_query($conn, $sql)) {
        return $last_id = mysqli_insert_id($conn);
    } else {
        return 0;
    }
}
function executeSingleResult($sql)
{
    //create connection toi database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE, PORT);

    //query
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, 1);
    //dong connection
    mysqli_close($conn);

    return $row;
}