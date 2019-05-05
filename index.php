<?php
session_start();


ini_set('display_errors', true);
error_reporting(E_ALL);
//Require autoload file
require_once('vendor/autoload.php');
require_once('model/validate.php');
//Create an instance of the Base class
$f3 = Base::instance();

// validate against array
$f3->set("indoorInterests", array('tv', 'puzzles', 'movies', 'reading', 'cooking', 'playing cards', 'board games', 'video games'));
$f3->set("outdoorInterests", array('hiking', 'walking', 'biking', 'climbing', 'swimming', 'collecting'));

//adding array of states
$f3->set('states', array('Alabama','Alaska','Arizona','Arkansas','California',
    'Colorado','Connecticut','Delaware','District of Columbia','Florida','Georgia',
    'Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana',
    'Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri',
    'Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York',
    'North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island',
    'South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington',
    'West Virginia','Wisconsin','Wyoming'));
//define a default route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});

//Route to information form
$f3->route('GET|POST /personal-info', function ($f3)
{
    if(!empty($_POST)) {
        //Get data from form
        $first = $_POST['first'];
        $last = $_POST['last'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        //Add data to hive
        $f3->set('first', $first);
        $f3->set('last', $last);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phone', $phone);
        //If data is valid
        if (validForm()) {
            //Write data to Session
            $_SESSION['first'] = $first;
            $_SESSION['last'] = $last;
            $_SESSION['age'] = $age;
            $_SESSION['phone'] = $phone;


            if (empty($gender)) {
                $_SESSION['gender'] = "No gender selected";
            }
            else {
                $_SESSION['gender'] = $gender;
            }
            $f3->reroute('/profile');
        }
    }
    $view = new Template();
    echo $view->render('views/person-info.html');
});
$f3->route('GET|POST /profile', function ($f3)
{//Route to information form

    if(!empty($_POST)) {
        //Get data from form
        $email = $_POST['email'];
        $state = $_POST['state'];
        $bio = $_POST['bio'];
        $seeking = $_POST['seeking'];
        //Add data to hive
        $f3->set('email', $email);
        $f3->set('state', $state);
        $f3->set('bio', $bio);
        $f3->set('seeking', $seeking);
        //If data is valid
        if (validSecondForm()) {
            //Write data to Session
            $_SESSION['email'] = $email;
            $_SESSION['state'] = $state;
            if (empty($bio)) {
                $_SESSION['bio'] = "No biography";
            }
            else {
                $_SESSION['bio'] = $bio;
            }
            if (empty($seeking)) {
                $_SESSION['seeking'] = "Not seeking any";
            }
            else {
                $_SESSION['seeking'] = $seeking;
            }
            $f3->reroute('/interests');
        }
    }
    $view = new Template();
    echo $view->render('views/profile.html');
});
$f3->route('GET|POST /interests', function ($f3)
{//Route to information form
    if(!empty($_POST)) {
        //Get data from form
        $indoor = $_POST['indoor'];
        $outdoor = $_POST['outdoor'];
        //Add data to hive
        $f3->set('indoor', $indoor);
        $f3->set('outdoor', $outdoor);
        //If data is valid
        if (validInterest()) {
            //Write data to Session
            if (empty($indoor)) {
                $_SESSION['indoor'] = ["no indoor interests"];
            }
            else {
                $_SESSION['indoor'] = $indoor;
            }
            if (empty($outdoor)) {
                $_SESSION['outdoor'] = ["no outdoor interests"];
            }
            else {
                $_SESSION['outdoor'] = $outdoor;
            }
            $f3->reroute('/summary');
        }
    }
    $view = new Template();
    echo $view->render('views/interests.html');
});
$f3->route('GET|POST /summary', function ()
{
    $view = new Template();
    echo $view->render('views/summary.html');

});
//Run fat-free
$f3->run();
?>