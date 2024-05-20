<?php
class Controller
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }
    function home()
    {
       // echo '<h1>Hello from My Diner App!</h1>';

        // Render a view page
        $view = new Template();
        echo $view->render('views/home-page.html');
    }
    function breakfastMenu()
    {
        //echo '<h1>My Breakfast Menu TEST TEST TEST</h1>';

        // Render a view page
        $view = new Template();
        echo $view->render('views/breakfast-menu.html');
    }
    function lunchMenu()
    {
        //echo '<h1>My Breakfast Menu TEST TEST TEST</h1>';

        // Render a view page
        $view = new Template();
        echo $view->render('views/lunch-menu.html');
    }
    function dinnerMenu()
    {
        //echo '<h1>My Breakfast Menu TEST TEST TEST</h1>';

        // Render a view page
        $view = new Template();
        echo $view->render('views/dinner-menu.html');
    }
    function summary()
    {

        // Render a view page
        $view = new Template();
        echo $view->render('views/order-summary.html');
        //var_dump ( $f3->get('SESSION') );
        session_destroy();
    }
    function order1()
    {
        //echo '<h1>My ORDER1 ROUTE TEST TEST TEST</h1>';

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
                $this->_f3->set('errors["food"]','Please enter a food');
            }
            //validate meal then
            //get the data from the post array
            if(isset($_POST['meal'])
                and Validate::validMeal($_POST['meal'])) {

                $meal = $_POST['meal'];
            }else{
                $this->_f3->set('errors["meal"]','Please select a meal');
            }

            // create new order object and add food
            //and meal to the order fields
            //add the order object to the session
            $order = new Order($food, $meal);
            $this->_f3->set('SESSION.order', $order);


            // If there are no errors
            //Send the user to the next form
            //var_dump($f3->get('errors'));
            if(empty($this->_f3->get('errors'))){
                $this->_f3->reroute('order2');
            }
        }
        //Get the data from the model
        //and add it to the F3 hive
        $meals = DataLayer::getMeals();
        $this->_f3->set('meals', $meals);


        // Render a view page
        $view = new Template();
        echo $view->render('views/order1.html');
    }
    function order2()
    {

        //var_dump ( $f3->get('SESSION') );

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
                $this->_f3->get('SESSION.order')->setCondiments($condiments);

                // Send the user to the next form
                $this->_f3->reroute('summary');
            }
            else {
                // Temporary
                echo "<p>Validation errors</p>";
            }
        }

        //Get the data from the model
        //and add it to the F3 hive
        $conds = DataLayer::getConds();
        $this->_f3->set('conds', $conds);

        // Render a view page
        $view = new Template();
        echo $view->render('views/order2.html');
    }

}