<?php

include $_SERVER["DOCUMENT_ROOT"] . "/Database/DB.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Database/Models/MovieModel.php";

function getMoviesByID(array $movieIDs): array
{
    global $mysqli;
    $query = "SELECT * FROM movie";
    $sizeOfUserIDs = sizeof($movieIDs);

    if ($sizeOfUserIDs > 0) {
        $query =
            $query .
            " where movieID in (" .
            implode(',', array_fill(0, count($movieIDs), '?')) . ");";
    }

    $result = $mysqli->execute_query($query, $movieIDs);

    $res = array();
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $value) {
            $res[] = new MovieModel(
                $value["movieID"],
                $value["movieTitle"],
                $value["category"],
                $value["movieImage"],
                $value["movieTrailer"],
                $value["actors"],
                $value["rating"]
            );
        }
    }

    return $res;
}

function getMoviesByTitle($parameter): array
{
    global $mysqli;
    $query = "select * from movie where movieTitle like '$parameter'";
    $res = array();
    $result = $mysqli->execute_query($query);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $value) {
            $res[] = new MovieModel(
                $value["movieID"],
                $value["movieTitle"],
                $value["category"],
                $value["movieImage"],
                $value["movieTrailer"],
                $value["actors"],
                $value["rating"]
            );
        }
    }
    return $res;
}
function getMoviesByActors($parameter): array
{
    global $mysqli;
    $query = "select * from movie where actors like '$parameter'";
    $res = array();
    $result = $mysqli->execute_query($query);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $value) {
            $res[] = new MovieModel(
                $value["movieID"],
                $value["movieTitle"],
                $value["category"],
                $value["movieImage"],
                $value["movieTrailer"],
                $value["actors"],
                $value["rating"]
            );
        }
    }
    return $res;
}
function movieRating($rate, $movieID): void
{
    global $mysqli;
    $query = "update movie set rating = ? where movieID = $movieID";
    $mysqli->execute_query($query,[$rate]);
}
