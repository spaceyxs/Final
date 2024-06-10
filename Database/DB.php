<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
const HOSTNAME = "localhost";
const USERNAME = "root";
const PASSWORD = "";
const DATABASE = "imdb";


try {
    $mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
} catch (mysqli_sql_exception) {
    echo "Connection Failed!";
}