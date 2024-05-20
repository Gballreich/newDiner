<?php

/** Order class represents a diner order */

class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    /**
     * constructor creates an order object
     * @param $_food the food the user ordered
     * @param $_meal the selected meal
     * @param $_condiments the selected condiments
     */
    public function __construct($_food="", $_meal="", $_condiments="")
    {
        $this->_food = $_food;
        $this->_meal = $_meal;
        $this->_condiments = $_condiments;
    }

    public function getFood()
    {
        return $this->_food;
    }

    public function setFood($food)
    {
        $this->_food = $food;
    }

    public function getMeal()
    {
        return $this->_meal;
    }

    public function setMeal($meal)
    {
        $this->_meal = $meal;
    }

    public function getCondiments()
    {
        return $this->_condiments;
    }

    public function setCondiments($condiments)
    {
        $this->_condiments = $condiments;
    }

}

