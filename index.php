<?php
session_start();




//TUrn on error reporting
ini_set('display_errors', true);
error_reporting(E_ALL);
//Require autoload file
require_once('vendor/autoload.php');
//Create an instance of the Base class
$f3 = Base::instance();
//define a default route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});
$f3->route('POST /personal-info', function () {
    $view = new Template();
    echo $view->render('views/person-info.html');
});

$f3->route('POST /profile', function () {
    $_SESSION['first'] = $_POST['first'];
    $_SESSION['last'] = $_POST['last'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phone'] = $_POST['phone'];
    $view = new Template();
    echo $view->render('views/profile.html');
});

//Run fat-free
$f3->run();
?>