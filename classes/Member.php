<?php

/**
 *The Member class represents a member of the dating site.
 *
 * The Member class represents a Member with a first name, last name, age, gender, phone number,
 * email address, location(state), seeking type(female or male), and biography.
 * @author David Nagy <dnagy@mail.greenriver.edu>
 * @copyright 2019
 */

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

    /**
     * Parameterized constructor for a Member
     * @param $fname Member first name of Member
     * @param $lname Member last name of Member
     * @param $age Member age of Member
     * @param $gender Member gender of Member
     * @param $phone Member phone number of Member
     * @return void
     */


    function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
    }
    /**
     * Gets the first name of Member
     * @return Member first name
     */

    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Sets the first name of Member
     * @param Member $fname the Member's first name
     * @return void
     */

    public function setFname($fname)
    {
        $this->_fname = $fname;
    }
    /**
     * Gets the last name of Member
     * @return Member last name
     */

    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Sets the Member last name
     * @param Member $lname the Member's last name
     * @return void
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }
    /**
     * Gets the Member age.
     * @return Member the Member's age
     */

    public function getAge()
    {
        return $this->_age;
    }
    /**
     * Sets the Member age
     * @param Member $age the Member's age
     * @return void
     */

    public function setAge($age)
    {
        $this->_age = $age;
    }
    /**
     * Gets the Member gender
     * @return Member the Member's gender
     */

    public function getGender()
    {
        return $this->_gender;
    }
    /**
     * Sets the Member gender
     * @param Member $gender the Member's gender
     * @return void
     */

    public function setGender($gender)
    {
        $this->_gender = $gender;
    }
    /**
     * Gets the Member phone number
     * @return Member phone number
     */

    public function getPhone()
    {
        return $this->_phone;
    }
    /**
     * Sets the Member phone number
     * @param Member $phone phone number
     * @return void
     */

    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }
    /**
     * Gets the Member email address
     * @return mixed Member email address
     */

    public function getEmail()
    {
        return $this->_email;
    }
    /**
     * Sets the Member email address
     * @param mixed $email Member email adress
     * @return void
     */

    public function setEmail($email)
    {
        $this->_email = $email;
    }
    /**
     * Gets the state(location) of the member
     * @return mixed Member state
     */

    public function getState()
    {
        return $this->_state;
    }
    /**
     * Sets the Member state (location)
     * @param mixed $state Member state
     * @return void
     */

    public function setState($state)
    {
        $this->_state = $state;
    }
    /**
     * Get the Member's preferred seeking gender
     * @return mixed Member's preferred seeking gender
     */

    public function getSeeking()
    {
        return $this->_seeking;
    }
    /**
     * Sets the Member preferred seeking gender
     * @param mixed $seeking Member's preferred seeking gender
     * @return void
     */

    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }
    /**
     * Gets the Member bio
     * @return mixed Member bio
     */

    public function getBio()
    {
        return $this->_bio;
    }
    /**
     * Sets the Member's bio
     * @param mixed $bio Member bio
     * @return void
     */

    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}
?>