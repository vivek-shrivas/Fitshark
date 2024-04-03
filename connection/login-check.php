<?php
session_start();

$response = array();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $response["logged_in"] = true;
} else {
    $response["logged_in"] = false;
}

echo json_encode($response);
