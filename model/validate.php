<?php
/*
 * validate data for the diner app
 */

class Validate
{

//return true if food contains
//at least 3 characters
   static function validFood($food)
    {
        return strlen(trim($food)) >= 3;
    }

//return true if meal
//is valid
   static function validMeal($meal)
    {
        return in_array($meal, DataLayer::getMeals());
    }
}