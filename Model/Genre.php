<?php

class Genre
{
  public $name;


  public function __construct($name)
  {
    $this->name = $name;
  }
}

$genreString = file_get_contents(__DIR__ . "/genre_db.json");
$genre = json_decode($genreString, true);
