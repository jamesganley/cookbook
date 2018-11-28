<?php

require_once 'src/Unirest.php';

$api_keys = [
  "X-Mashape-Key" => "ovPM3cb30mmsh7abxqslX3XQ9bgZp101Drfjsn5Nc5rjIn4UyA",
  "X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.mashape.com"
];

function getRecipe($api_keys, $query, $type, $number = 20) {
  $endpoint = "https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/";
  $endpoint .="search?number=${number}&offset=0&query=${query}&type=${type}";
  $response = Unirest\Request::get($endpoint, $api_keys);
  $meals = json_decode($response->raw_body)->results;

  /*function getInstructions($api_keys, $id) {
  $endpoint1 = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/"
  $endpoint1 = "$id/analyzedInstructions?";
  $response =  Unirest\Request::get($endpoint1, $api_keys);
  $instructions = json_decode($response->raw_body)->steps;
}*/

  $html = "<div class='container'>";
  $baseUrl="https://spoonacular.com/recipeImages/";

  foreach ($meals as $meal) {
    $mealTitle = $meal->title;

    $mealid= $meal->id;
    $imgSrc = $baseUrl . $meal->image;
    $howtocook="https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/${mealid}/information";
    $response = Unirest\Request::get($howtocook, $api_keys);
    $ings = json_decode($response->raw_body)->instructions;
    // $inglines=$ings->

 $html .= "<div class='container'><img style='display: inlineBlock; width: 28%' src=${imgSrc}><h3>${mealTitle}</h3><p> ${ings}</p></div>";
  }

 $html .= "</div>";

  return $html;

  $option;
  $type=$option;

}
/*$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/324694/analyzedInstructions?stepBreakdown=false",
  array(
    "X-Mashape-Key" => "ovPM3cb30mmsh7abxqslX3XQ9bgZp101Drfjsn5Nc5rjIn4UyA",
    "X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com"
  )
);
*/




if(isset($_POST['select'])){
  $option=$_POST['select'];
}

// echo getRecipe($api_keys, "chicken", "breakfast", 10);

?>
