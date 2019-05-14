<?php

class Member
{
    protected $_fname;
    protected $_lname;
    protected $_age;
    protected $_gender;
    protected $_phone;
    protected $_email;
    protected $_state;
    protected $_seeking;
    protected $_bio;


    function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
    }

    public function getFname()
    {
        return $this->_fname;
    }

    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    public function getLname()
    {
        return $this->_lname;
    }

    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    public function getAge()
    {
        return $this->_age;
    }

    public function setAge($age)
    {
        $this->_age = $age;
    }

    public function getGender()
    {
        return $this->_gender;
    }

    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    public function getPhone()
    {
        return $this->_phone;
    }

    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getState()
    {
        return $this->_state;
    }

    public function setState($state)
    {
        $this->_state = $state;
    }

    public function getSeeking()
    {
        return $this->_seeking;
    }

    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    public function getBio()
    {
        return $this->_bio;
    }

    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}
?>