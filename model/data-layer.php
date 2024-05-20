<?php
/*
 * This is my Data Layer
 * it belongs to the model
 */

class DataLayer
{

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