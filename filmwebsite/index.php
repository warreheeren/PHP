<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Film website</title>
  <link rel="stylesheet" href="style.css">
</head>
<?php
$averageScore = 0;
$films = [
    'titel' => 'Spider-man: Homecomming',
    'synopsis' => 'Peter Parker balances his life as an ordinary high school student in Queens with his superhero alter-ego Spider-Man, and finds himself on the trail of a new menace prowling the skies of New York City.',
    'Directors' => ['Jon Watts', 'Jonathan Goldstein'],
    'acteurs' => ['Tom Holland', 'Michael Keaton', 'Robert Downey Jr.', 'Marisa Tomei'],
    'karakters' => ['Peter Parker', 'Adrian Toomes', 'Tony Stark', 'May Parker'],
    'gemiddeldeScore' => $averageScore,
    'info' => 'In the aftermath of Captain America: Civil War (2016), the fifteen-year-old sophomore and Tony Starks protégé, Peter Parker, finds himself back to his hometown of Queens, New York, trying to juggle high school and his super-hero alter-ego. On pins and needles, waiting for his mentor to give him a chance to prove his mettle and become an official Avenger, instead, Stark, intent on protecting him, keeps Peter on a short leash, fearful that, one of these days, the boy may bite off more than he can chew. And then, the Vulture, a winged super-criminal brandishing advanced Chitauri weaponry, emerges, and of course, Parker sees his arrival as a golden opportunity to demonstrate that he has what it takes to be part of the Earths mightiest team of super-heroes.
               Is Spider-Man ready to be more than the neighbourhoods friendly, web-slinging defender?',
    'reviews' => [
      [
        'reviewTitle' => 'Matige film',
        'date' => '2024/10/11',
        'name' => 'Warre',
        'review' => 'De film viel een beetje tegen maar alsnog geslaagd.',
        'email' => 'warre.heeren@hotmail.com',
        'score' => '8/10'
      ],
      [
        'reviewTitle' => 'Goede film',
        'date' => '2024/10/11',
        'name' => 'Warre',
        'review' => 'De film was heel goed.',
        'email' => 'warreheeren@hotmail.com',
        'score' => '10/10'
      ]
    ],
    'tags' => ['marvel', 'spider-man', 'cosmics'],
    'images' => ['images/screenshot1.jpg', 'images/screenshot2.jpg', 'images/screenshot3.jpg', 'images/screenshot4.jpg']
]; 


$reviews = $films['reviews'];
$reviewCount = count($reviews);
$totalScore = 0;
  foreach ($reviews as $review) {
    $scoreParts = explode('/', $review['score']);
    $numericScore = (int)$scoreParts[0];
    $totalScore += $numericScore;
  }
  $averageScore = $totalScore / $reviewCount;

  $max_stars = 5;
  $stars = round(($averageScore / 10) * $max_stars);
?>
<body>

  <div class="page-intro">
    <div class="container">
      <p>Movies</p>
    </div>
  </div>

  <main>
    <header class="main-header">
      <div class="container clearfix">
        <img class="movie-poster" src="images/poster.jpg" alt="Spider-man: Homecoming" />
        <div class="score">
          <?php
            for($i = 1; $i <= $stars; $i++){
              echo '<div class="star"></div>';
            }
          ?>
        </div>
        <h1 class="movie-title"><?php echo $films['titel'] ?></h1>
        <p class="movie-synopsis"><?php echo $films['synopsis'] ?></p>
        <div class="tag-list">
          <?php 
                $tagsString = implode(', ', $films['tags']);
                echo '<a class="tag" href="#">' . htmlspecialchars($tagsString) . '</a>';
          ?>
        </div>
      </div>
    </header>
    <div class="main-content">
      <div class="container clearfix">
        <div class="content">
          <?php
            if($averageScore >= 8){
              echo '<div class="recommended">
                      This movie is highly recommended!
                    </div>';
            }
          ?>
          <?php 
            echo '<p>'. $films['info'] .'</p>'
          ?>
          <div class="directors">
            <p><b>Directors:</b><p>
            <?php 
            for($i = 0; $i < count($films['Directors']); $i++){
              echo ''. $films['Directors'][$i] . ',';
            }
            ?>
           
          </div>
          <div class="actors">
            <p><b>Actors:</b></p>
            <?php
              $actorUpperCaseArray = [];
              $dataPush = "";
              foreach ($films['acteurs'] as $acteur) {
                $dataPush = strtoupper($acteur);
                array_push($actorUpperCaseArray, $dataPush);
            }
            echo '<table class="actors-table">';
            for ($i = 0; $i < count($films['acteurs']); $i++) {
                echo '<tr>';
                echo '<td class="actors-table-actor">' . $films['acteurs'][$i] . '</td>';
                echo '<td class="actors-table-character">' . $films['karakters'][$i] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            ?>
          </div>
          
          <div class="screenshots">
            <?php 
              for($i = 0; $i < count($films['images']); $i++){
                echo '<img src="'. $films['images'][$i] . '">';
              }
            ?>
          </div>
        </div>
        <aside class="reviews">
          <h1>Reviews</h1>
          <?php 
          if ($reviewCount > 0) {
              echo '<p>User score: <b>'. round($averageScore, 1) . '/10</b></p>';
          }
          ?>
            <?php
              foreach($films['reviews'] as $review){
                  echo '<article class="review">
                    <header class="review-header"> 
                      <h1 class="review-title">' . $review['reviewTitle'] . '</h1>
                      <p class="review-author">Geschreven door <a href="mailto:'. $review['email'] .'">'. $review['name'] . '</a></p>
                      <p class="review-date">Gepubliceerd op <time>'. $review['date'] .'</time></p>
                    </header>
                    <div class="review-content">
                      <p>'. $review['review'] .'</p>
                    </div>
                    <div class="review-score">'
                      . $review['score'] .
                    '</div>
                  </article>';
              }
            ?>
        </aside>
      </div>
    </div>
  </main>

  <footer class="main-footer">
    Movies - 2021 &copy; CVO De Verdieping
  </footer>
  
</body>
</html>