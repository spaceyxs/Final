<?php

class UserModel
{
    private int $userID;
    private string $userName;
    private string $userSurname;
    private string $email;
    private string $password;
    private string $country;
    private string $city;
    private string $watchList;

    public function __construct($userID, $userName, $userSurname ,$email, $password, $country, $city, $watchList)
    {
        $this->userID = $userID;
        $this->userName = $userName;
        $this->userSurname = $userSurname;
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
        $this->city = $city;
        $this->watchList = $watchList;
    }


    public function getUserID(): int
    {
        return $this->userID;
    }


    public function getUserName(): string
    {
        return $this->userName;
    }


    public function getUserSurname(): string
    {
        return $this->userSurname;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getPassword(): string
    {
        return $this->password;
    }


    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getWatchList(): string
    {
        return $this->watchList;
    }

}

