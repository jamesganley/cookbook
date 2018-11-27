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

  $html = "<ul>";

  foreach ($meals as $meal) {
    $mealTitle = $meal->title;
    $html .= "<li>${mealTitle}</li>";
  }

  $html .= "</ul>";

  return $html;

}


echo getRecipe($api_keys, "chicken", "breakfast", 10);


//
//
// function searchRecipeByIngredients($ingredients) {
//
// }
//
// $response = Unirest\Request::get("" ,
//
//   array(
//
//     "X-Mashape-Key" => "ovPM3cb30mmsh7abxqslX3XQ9bgZp101Drfjsn5Nc5rjIn4UyA",
//
//     "X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.mashape.com"
//
//   )
//
// );



echo "<pre>";



print_r($response);

 ?>
