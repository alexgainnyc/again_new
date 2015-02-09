<?php
/*
Ex:

Router::register("GET", "/", "index"); //view
Router::register("GET", "/", "index@method"); //controller -> IndexController::method()
Router::register("GET", "/", function () { }); //callback

Router::register("GET", "/detail/(:num)", function ($id) { return $id; }); //with params
*/

Router::register("GET", "/", "index");
Router::register("GET", "/case/(:num)", "case");
Router::register("GET", "/work", "all");
Router::register("GET", "/about", "contact");
Router::register("GET", "/culture", "culture");

?>