<?php

class PremiumMember extends Member
{
    protected $_inDoorInterests;
    protected $_outDoorInterests;

    public function __construct($fname, $lname, $age, $gender, $phone)
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }

    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }
}
?>
