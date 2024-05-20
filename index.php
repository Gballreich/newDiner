<?php

// 328/diner/index.php
// This is my CONTROLLER!

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
//Require the data-layer
//Require the validation page
require_once ('vendor/autoload.php');
//require_once ('model/data-layer.php');
//require_once ('model/validate.php');
//require_once ('classes/order.php');

/*
if(Validate::validFood('tacos')){
    echo "this is valid";
}
/*
//var_dump(DataLayer::getMeals());

 //test order class
/*
echo"<pre>";
$order = new Order ('pad thai', 'lunch', ['soy sauce']);
var_dump($order);
echo"</pre>";
*/


// Instantiate the F3 Base class
$f3 = Base::instance();

// Define a default route
// https://tostrander.greenriverdev.com/328/hello-fat-free/
$f3->route('GET /', function() {
    //echo '<h1>Hello from My Diner App!</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/home-page.html');
});



// Breakfast menu
$f3->route('GET /menus/breakfast', function() {
    //echo '<h1>My Breakfast Menu</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});



// Lunch menu
$f3->route('GET /menus/lunch', function() {
    //echo '<h1>My Breakfast Menu</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/lunch-menu.html');
});


// Dinner menu
$f3->route('GET /menus/dinner', function() {
    //echo '<h1>My Breakfast Menu</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/dinner-menu.html');
});



// Order Summary
$f3->route('GET /summary', function($f3) {

    // Render a view page
    $view = new Template();
    echo $view->render('views/order-summary.html');
    //var_dump ( $f3->get('SESSION') );
    session_destroy();
});



// Order Form Part I
$f3->route('GET|POST /order1', function($f3) {
    //echo '<h1>My Breakfast Menu</h1>';

    //Initialize variables
    $food ="";
    $meal ="";

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //echo "<p>You got here using the POST method</p>";
        //var_dump ($_POST);

        //var_dump($_POST);

        //validate food then
        // Get the data from the post array
        if(Validate::validFood($_POST['food'])){
            $food = $_POST['food'];
        }else{
            $f3->set('errors["food"]','Please enter a food');
        }
        //validate meal then
        //get the data from the post array
        if(isset($_POST['meal'])
            and Validate::validMeal($_POST['meal'])) {

                $meal = $_POST['meal'];
        }else{
            $f3->set('errors["meal"]','Please select a meal');
        }

            // create new order object and add food
            //and meal to the order fields
            //add the order object to the session
            $order = new Order($food, $meal);
            $f3->set('SESSION.order', $order);


            // If there are no errors
            //Send the user to the next form
            //var_dump($f3->get('errors'));
            if(empty($f3->get('errors'))){
                $f3->reroute('order2');
            }
    }
    //Get the data from the model
    //and add it to the F3 hive
    $meals = DataLayer::getMeals();
    $f3->set('meals', $meals);


    // Render a view page
    $view = new Template();
    echo $view->render('views/order1.html');
});

// Order Form Part II
$f3->route('GET|POST /order2', function($f3) {

    var_dump ( $f3->get('SESSION') );

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //var_dump($_POST);
        // Get the data from the post array
        if (isset($_POST['conds']))
            $condiments = implode(", ", $_POST['conds']);
        else
            $condiments = "None selected";

        // If the data valid
        if (true) {

            // Add the data to the session array
            $f3->get('SESSION.order')->setCondiments($condiments);

            // Send the user to the next form
            $f3->reroute('summary');
        }
        else {
            // Temporary
            echo "<p>Validation errors</p>";
        }
    }

    //Get the data from the model
    //and add it to the F3 hive
    $conds = DataLayer::getConds();
    $f3->set('conds', $conds);

    // Render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// Run Fat-Free
$f3->run();