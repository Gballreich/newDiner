<?php

// 328/diner/index.php
// This is my CONTROLLER!

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once ('vendor/autoload.php');
require_once('controllers/controller.php');


// Instantiate the F3 Base class
$f3 = Base::instance();
$con = new Controller($f3);
$datalayer = new DataLayer();

$myOrder = new Order('breakfast', 'pancakes', 'maple syrup');
//$id = $datalayer->saveOrder($myOrder);
//echo "Order $id inserted successfully!";


// Define a default route
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});

// Breakfast menu
$f3->route('GET /menus/breakfast', function() {
    $GLOBALS['con']->breakfastMenu();
});

// Lunch menu
$f3->route('GET /menus/lunch', function() {
    $GLOBALS['con']->lunchMenu();
});

// Dinner menu
$f3->route('GET /menus/dinner', function() {
    $GLOBALS['con']->dinnerMenu();
});

// Order Summary
$f3->route('GET /summary', function($f3) {
    $GLOBALS['con']->summary();
});

// Order Form Part I
$f3->route('GET|POST /order1', function($f3) {
    $GLOBALS['con']->order1();
});

// Order Form Part II
$f3->route('GET|POST /order2', function($f3) {
    $GLOBALS['con']->order2();
});

// Run Fat-Free
$f3->run();