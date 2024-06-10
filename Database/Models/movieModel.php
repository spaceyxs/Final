<?php

class MovieModel
{
    private int $movieID;
    private string $movieTitle;
    private string $category;
    private string $movieImage;
    private string $movieTrailer;
    private string $actors;
    private int $rating;


    public function __construct($movieID, $movieTitle, $category, $movieImage, $movieTrailer, $actors, $rating)
    {
        $this->movieID = $movieID;
        $this->movieTitle = $movieTitle;
        $this->category = $category;
        $this->movieImage = $movieImage;
        $this->movieTrailer = $movieTrailer;
        $this->actors = $actors;
        $this->rating = $rating;

    }


    public function getMovieID(): int
    {
        return $this->movieID;
    }

    public function getMovieTitle(): string
    {
        return $this->movieTitle;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getMovieImage(): string
    {
        return $this->movieImage;
    }

    public function getMovieTrailer(): string
    {
        return $this->movieTrailer;
    }

    public function getActors(): string
    {
        return $this->actors;
    }

    public function getRating(): int
    {
        return $this->rating;
    }


}