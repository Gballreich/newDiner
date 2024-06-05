<?php
/*
 * This is my Data Layer
 * it belongs to the model
 *
CREATE TABLE orders (
 	order_id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    food VARCHAR(50),
    meal VARCHAR(20),
    condiments VARCHAR(50),
    date_time DATETIME DEFAULT NOW()

INSERT INTO orders (food, meal, condiments)
VALUES ('crepes', 'breakfast', 'nutella, whipped cream')
 */

class DataLayer
{
    //add a field to store the database connection object
    private $_dbh;

    //constructor
    function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

        try {
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
           // echo 'connected to database!';
        }
        catch (PDOException $e){
            die( $e->getMessage() );
        }
    }
//save order function
function saveOrder($order)
{
//step 1 - define the query
$sql = 'INSERT INTO orders (food, meal, condiments)
VALUES (:food, :meal, :condiments)';
//step 2
//prepare the statement
$statement = $this->_dbh->prepare($sql);

//step 3 - bind the parameters (if there are any)
$food = $order->getFood();
$meal = $order->getMeal();
$condiments = $order->getCondiments();

$statement->bindParam(':food', $food);
$statement->bindParam(':meal', $meal);
$statement->bindParam(':condiments', $condiments);

//step 4 - execute the query
$statement->execute();

//step 5 - optional
//process the results
$id = $this->_dbh->lastInsertId();
return $id;

}

//get meals for the diner app
   static function getMeals()
    {
        return array('breakfast', 'brunch', 'lunch', 'dinner', 'dessert');
    }

//get condiments for the diner app
   static function getConds()
    {
        return array('ketchup', 'mustard', 'mayo', 'sirracha', 'honey mustard', 'ranch');
    }
}