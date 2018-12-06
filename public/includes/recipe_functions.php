<?php


require_once 'src/Unirest.php';
$api_keys = [
  "X-Mashape-Key" => "ovPM3cb30mmsh7abxqslX3XQ9bgZp101Drfjsn5Nc5rjIn4UyA",
  "X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.mashape.com"
];

function getRecipe($api_keys, $query, $type, $number) {
  $endpoint = "https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/";
  $endpoint .="search?number=${number}&offset=0&query=${query}&type=${type}";
  $response = Unirest\Request::get($endpoint, $api_keys);
  $meals = json_decode($response->raw_body)->results;
  $counter=1;

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
      $counter++;
    $mealid= $meal->id;
    $imgSrc = $baseUrl . $meal->image;
    $howtocook="https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/${mealid}/information";
    $response = Unirest\Request::get($howtocook, $api_keys);
    $ings = json_decode($response->raw_body)->instructions;
    $ingredientlines=json_decode($response->raw_body)->extendedIngredients;
    foreach ($ingredientlines as $key ) {
      $name=$key->name;

    }

    // $inglines=$ings->
    $idname='demo'.$counter;


 $html .= "<div class='col-lg-6 col-md-8 offset-lg-0 offset-md-2'>
          <div class='review-item'>
          <div class ='review-thumb set-bg' data-setbg=${imgSrc}>
          <img src=${imgSrc}>
          </div>
          <div class='review-text'>
          <h6>${mealTitle}</h6>
          <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#{$idname}'>
          Read Recipe
          </button>
          <div class='modal fade' id='{$idname}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id={$idname}>${mealTitle}</h5>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                <img src=${imgSrc}>
                <h4>Ingredients</h4>
                ${name}
                <h4>Instructions</h4>
                ${ings}
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-primary' data-dismiss='modal'>Close</button>
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>
          </div>";
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
