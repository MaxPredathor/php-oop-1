<?php
include __DIR__ . "/Genre.php";
class Movie
{
  public int $id;
  public string $title;
  public string $overview;
  public float $vote_average;
  public string $poster_path;

  public string $original_language;

  public Genre $genre;



  function __construct($id, $title, $overview, $vote, $image, $language)
  {
    $this->id = $id;
    $this->title = $title;
    $this->overview = $overview;
    $this->vote_average = $vote;
    $this->poster_path = $image;
    $this->original_language = $language;

    $genres = json_decode(file_get_contents(__DIR__ . "/../Model/genre_db.json"), true);

    $randomIndex = array_rand($genres);
    $randomGenre = $genres[$randomIndex];

    $this->genre = new Genre($randomGenre);
  }

  public function getFlag()
  {
      $flag = 'img/' . $this->original_language . '.png';
      return $flag;
  }
  public function getVote()
  {
    $vote = ceil($this->vote_average / 2);
    $template = "<p>";
    for ($n = 1; $n <= 5; $n++) {
      $template .= $n <= $vote ? '<i class="fa-solid fa-star" style="color: #d9cc12;"></i>' : '<i class="fa-regular fa-star" style="color: #d9cc12;"></i>';
    }
    $template .= '</p>';
    return $template;
  }

  public function printCard()
  {
    $image = $this->poster_path;
    $title = $this->title;
    $content = substr($this->overview, 0, 100) . "...";
    $custom = $this->getVote();
    $genre = $this->genre->name;
    $flag = $this->getFlag();
    include __DIR__ . "/../Views/card.php";
  }
}

// $action = new Genre('Action');
// $comedy = new Genre('Comedy');
$movieString = file_get_contents(__DIR__ . "/movie_db.json");
$movieList = json_decode($movieString, true);
$movies = [];

foreach ($movieList as $movie) {
  // $genres = rand(0, count($genre) - 1);
  $movies[] = new Movie($movie['id'], $movie['title'], $movie['overview'], $movie['vote_average'], $movie['poster_path'], $movie['original_language']);
}
