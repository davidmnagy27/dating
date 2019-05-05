<?php
function validForm()
{
    global $f3;
    $isValid = true;

    if (!validName($f3->get('first'))) {
        $isValid = false;
        $f3->set("errors['first']", "Please enter a first name");
    }
    if (!validName($f3->get('last'))) {
        $isValid = false;
        $f3->set("errors['last']", "Please enter a last name");
    }
    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter age 18 to 118");
    }
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
    if (!validEmail($f3->get('email'))) {
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email");
    }
    return $isValid;
}

function validInterest()
{
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
function validName($name)
{
    return !empty($name) && ctype_alpha($name);
}
function validAge($age)
{
    return !empty($age) && ctype_digit($age) && (int)$age >= 18 && (int)$age <= 118;
}
function validPhone($phone)
{
    return ctype_digit($phone) && strlen($phone) === 10;
}
function validEmail($email)
{
    return filter_var($email);
}
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