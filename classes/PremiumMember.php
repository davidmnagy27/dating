<?php

/**
 * The PremiumMember class represents a premium member of the dating site.
 *
 * The PremiumMember class represents a premium member with indoor/outdoor interests.
 */

class PremiumMember extends Member
{
    protected $_inDoorInterests;
    protected $_outDoorInterests;


    /**
     * Parameterized constructor for a PremiumMember
     * @param $fname PremiumMember first name
     * @param $lname PremiumMember last name
     * @param $age PremiumMember age
     * @param $gender PremiumMember gender
     * @param $phone PremiumMember phone number
     * @return void
     */

    public function __construct($fname, $lname, $age, $gender, $phone)
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }


    /**
     * Gets the PremiumMember indoor interests
     * @return mixed Premium Member indoor interests
     */

    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }
    /**
     * Sets the PremiumMember indoor interests
     * @param mixed $indoorInterests Premium Member indoor interests
     * @return void
     */

    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }
    /**
     * Gets the PremiumMember outdoor interests
     * @return mixed Premium Member outdoor interests
     */

    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }
    /**
     * Sets the PremiumMember outdoor interests
     * @param mixed $outdoorInterests Premium Member outdoor interests
     * @return void
     */

    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }
}
?>
