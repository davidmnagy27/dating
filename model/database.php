<?php
/*
CREATE TABLE member
(
    member_id int PRIMARY KEY AUTO_INCREMENT,
	fname varchar(255) not null,
    lname varchar(255) not null,
    age int(3),
    gender char(1),
    phone varchar(13),
    email varchar(350),
    state char(2),
    seeking char(1),
    bio varchar(500),
    premium tinyint
);
CREATE TABLE interest
(
    interest_id int PRIMARY KEY AUTO_INCREMENT,
    interest varchar(100),
    type varchar(30)
);
CREATE TABLE memberinterest
(
    interest_id int,
    member_id int,
    FOREIGN KEY (interest_id) REFERENCES interest(interest_id),
    FOREIGN KEY (member_id) REFERENCES member(member_id),
    PRIMARY KEY (interest_id, member_id)
);
*/
require '/home/dnagygre/config2.php';


class Database
{
    private $_dbh;
    /**
     * Database constructor.
     * @return void
     */
    function __construct()
    {
        $this->connect();
    }
    /**
     * Establishes a connection to the database for later use
     * @return void;
     */
    function connect()
    {
        try {
            //Instantiate a db project
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);

        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }
    /**
     * Inserts a member of the dating site into the database.
     * @return void;
     */
    function insertMember($fname,$lname,$age,$gender,$phone,$email,$state,$seeking,$bio,$premium)
    {
        $sql = "INSERT INTO member(fname, lname, age, gender, phone, email, state, seeking, bio, premium) 
        VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium)";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':seeking',$seeking, PDO::PARAM_STR);
        $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
        if($premium instanceof PremiumMember)
        {
            $statement->bindParam(':premium', $b=true, PDO::PARAM_BOOL);
        }
        else
        {
            $statement->bindParam(':premium', $b=false, PDO::PARAM_BOOL);
        }
        $statement->execute();
        if($member instanceof PremiumMember)
        {
            $lastMemberID = $this->_dbh->lastInsertId();
            if(!empty($member->getOutDoorInterests())) {
                foreach ($member->getOutDoorInterests() as $interest) {
                    $this->insertInterest($interest, $lastMemberID);
                }
            }
            if(!empty($member->getInDoorInterests())) {
                foreach ($member->getInDoorInterests() as $interest)
                {
                    $this->insertInterest($interest, $lastMemberID);
                }
            }
        }
    }
    /**
     * A private method to insert an interest into the connection table member-interest
     * @param String $interest The interest being looked for in the interest table
     * @param int $lastMemberID ID of the last inserted member
     * @return void
     */
    private function insertInterest($interest, $lastMemberID)
    {
        $sqlIntID = "SELECT interest_id FROM interest WHERE interest = :interest";
        $statementIntID = $this->_dbh->prepare($sqlIntID);
        $statementIntID->bindParam(':interest', $interest, PDO::PARAM_STR);
        $statementIntID->execute();
        $intID = $statementIntID->fetch(PDO::FETCH_NUM);
        $sqlInterests = "INSERT INTO member_interest(member_id, interest_id) VALUES (:member_id, :interest_id)";
        $statementInterest = $this->_dbh->prepare($sqlInterests);
        $statementInterest->bindParam(':member_id', $lastMemberID, PDO::PARAM_INT);
        $statementInterest->bindParam(':interest_id', $intID[0], PDO::PARAM_INT);
        $statementInterest->execute();
    }
    /**
     * Gets all current members
     * @return array mixed An assoc array to hold all the info on the members
     */
    function getMembers()
    {
        $sql = "SELECT * FROM member ORDER BY lname";
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /**
     * Gets 1 member's info
     * @param String $member_id id of the member
     * @return array mixed an array of the specific members info
     */
    function getMember($member_id)
    {
        $sql = "SELECT * FROM member WHERE member_id = :member_id";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    /**
     * Gets the interests of the member
     * @param String $member_id The id of the member
     * @return array mixed Gets the interests of the member
     */
    function getInterests($member_id)
    {
        $sql = "SELECT interest.interest FROM member_interest INNER JOIN interest ON 
        member_interest.interest_id=interest.interest_id WHERE member_interest.member_id = :member_id";
        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_NUM);
        $interests = [];
        foreach ($row as $item)
        {
            array_push($interests, $item[0]);
        }
        if(empty($interests))
        {
            array_push($interests, "No interests selected");
        }

        return $interests;
    }
}