<?php

//David Nagy
//5/5/19
// validate.php
// validating forms for required fields

//function validName
function validName($name)
{
    return !empty($name) && ctype_alpha($name);
}//function validAge
function validAge($age)
{
    return !empty($age) && ctype_digit($age) && (int)$age >= 18 && (int)$age <= 118;
}//function validPhone
function validPhone($phone)
{
    return ctype_digit($phone) && strlen($phone) === 10;
}//function validEmail
function validEmail($email)
{
    return filter_var($email);
}//function validOutdoors
function validOutdoor($outdoor)
{
    global $f3;
    if(empty($outdoor))
    {
        return true;
    }
    foreach($outdoor as $interest)
    {
        if(!in_array($interest, $f3->get('outdoorInterests')))
        {
            return false;
        }
    }
    return true;
}
//function validIndoors
function validIndoor($indoor)
{
    global $f3;
    if(empty($indoor))
    {
        return true;
    }
    foreach($indoor as $interest)
    {
        if(!in_array($interest, $f3->get('indoorInterests')))
        {
            return false;
        }
    }
    return true;
}

function validForm()
{
    global $f3;
    $isValid = true;
//Validate first name is all alphabetic
    if (!validName($f3->get('first'))) {
        $isValid = false;
        $f3->set("errors['first']", "Please enter a first name");
    }
    //Validate last name is all alphabetic
    if (!validName($f3->get('last'))) {
        $isValid = false;
        $f3->set("errors['last']", "Please enter a last name");
    }//Validate if age is numeric and between 18 & 118
    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter age 18 to 118");
    }//Validates phone number
    if (!validPhone($f3->get('phone'))) {
        $isValid = false;
        $f3->set("errors['phone']", "Please enter a valid phone number");
    }
    return $isValid;
}
function validSecondForm()
{
    global $f3;
    $isValid = true;
    //Validates email
    if (!validEmail($f3->get('email'))) {
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email");
    }
    return $isValid;
}

function validInterest()
{// Validates each interest against
    // a list of valid options
    global $f3;
    $isValid = true;
    if (!validOutdoor($f3->get('outdoor'))) {
        $isValid = false;
        $f3->set("errors['outdoor']", "Please enter valid outdoor interests");
    }
    if (!validIndoor($f3->get('indoor'))) {
        $isValid = false;
        $f3->set("errors['indoor']", "Please enter valid indoor interests");
    }
    return $isValid;
}
