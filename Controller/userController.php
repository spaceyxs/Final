<?php

include $_SERVER["DOCUMENT_ROOT"] . "/Database/Models/UserModel.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Database/DB.php";

function addUser($userName, $userSurname, $email, $password, $country, $city, $watchList): UserModel
{
    global $mysqli;
    $query = "insert into user (userName, userSurname ,email, password, country, city, watchList) values (?,?,?,?,?,?,?);";

    $mysqli->execute_query($query, [$userName, $userSurname, $email, $password, $country, $city, $watchList]);

    return new UserModel(
        $mysqli->insert_id,
        $userName,
        $userSurname,
        $email,
        $password,
        $country,
        $city,
        $watchList
    );
}
function getUsersByID(array $userIDs): array
{
    global $mysqli;
    $query = "SELECT * FROM user";
    $sizeOfUserIDs = sizeof($userIDs);

    if ($sizeOfUserIDs > 0) {
        $query =
            $query .
            " where userID in (" .
            implode(',', array_fill(0, count($userIDs), '?')) . ");";
    }

    $result = $mysqli->execute_query($query, $userIDs);

    $res = array();
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $value) {
            $res[] = new UserModel(
                $value["userID"],
                $value["userName"],
                $value["userSurname"],
                $value["email"],
                $value["password"],
                $value["country"],
                $value["city"],
                $value["watchList"]
            );
        }
    }

    return $res;
}
function login($email, $password): bool
{
    global $mysqli;
    $query = " select * from user where email = '$email' and password = '$password'";
    $result = $mysqli->execute_query($query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }else{
        return false;
    }

}

function addWatchList($movieTitle, $userID): void
{
    global $mysqli;
    $query = "update user set watchList = ? where userID = $userID";
    $mysqli->execute_query($query,[$movieTitle]);

}