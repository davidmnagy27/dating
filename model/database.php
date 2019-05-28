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

Class Database
{
    private $dbh;
    /**
     * database constructor.
     */
    public function __construct()
    {
        $this->connect();
    }
    /**
     *  connect to database
     * @return void
     */
    public function connect()
    {
        try{
            $this->dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD
            );
        } catch (PDOException $e)
        {
            $this->dbh = $e->getMessage();
        }
    }
    /**
     * Inserts a member into database
     * @param $member membership object
     * @return void
     */
    public function insertMember($member)
    {
        if(isset($this->dbh)){
            // SQL statement
            $sql = "INSERT INTO member(fname, lname, age, gender, phone, email, state, seeking, bio, premium) 
                VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium)";


            $statement = $this->dbh->prepare($sql);

            //assign values
            $fname = $member->getFname();
            $lname = $member->getLname();
            $age = $member->getAge();
            $gender = $member->getGender();
            $phone = $member->getPhone();
            $state = $member->getState();
            $seeking = $member->getSeeking();
            $email = $member->getEmail();
            $bio = $member->getBio();
            if($member instanceof  PremiumMember)
            {
                $premium =1;
            }
            else
            {
                $premium=0;
            }

            $statement->bindParam(':fname',$fname, PDO::PARAM_STR);
            $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
            $statement->bindParam(':age', $age, PDO::PARAM_INT);
            $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
            $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':state', $state, PDO::PARAM_STR);
            $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
            $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
            $statement->bindParam(':premium', $premium, PDO::PARAM_INT);

            $statement->execute();

            $id = $this->dbh->lastInsertId();

            if($member instanceof PremiumMember) {
                $indoor=$member->getInDoorInterests();
                $outdoor=$member->getOutDoorInterests();
                if(isset($indoor))
                {
                    $this->insertInterest($indoor, $id);
                }
                if(isset($outdoor))
                {
                    $this->insertInterest($outdoor, $id);
                }
            }
        }
    }

    private function getInterestID($interest)
    {
        if(isset($this->dbh)){
            $sql = "SELECT interest_id FROM interest WHERE interest = :interest";
            $statement = $this->dbh->prepare($sql);
            $statement->bindParam(':interest', $interest, PDO::PARAM_STR);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row['interest_id'];
        }
    }

    private function insertInterest($array,$id)
    {
        $sql = "INSERT INTO memberinterest(interest_id, member_id) VALUES (:interest, :member)";
        $statement = $this->dbh->prepare($sql);
        //for each indoor interest bind and execute statement
        foreach ($array as $value) {
            //bind interest id and member id
            $statement->bindParam(":interest", $this->getInterestID($value),
                PDO::PARAM_INT);
            $statement->bindParam(":member", $id, PDO::PARAM_INT);
            //execute
            $statement->execute();
        }
    }

    public function getMembers()
    {
        $sql = "SELECT * FROM member ORDER BY lname ASC";
        $statement = $this->dbh->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMember($member_id)
    {
        $sql = "SELECT * FROM member WHERE member_id = :id";
        $statement = $this->dbh->prepare($sql);
        $statement->bindParam(":id", $member_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getInterests($member_id)
    {
        $sql = "SELECT * FROM memberinterest WHERE member_id = :id";
        $statement = $this->dbh->prepare($sql);
        $statement->bindParam(":id", $member_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $interestArray= array();
        if (isset($result)) {
            foreach ($result as $value) {
                array_push( $interestArray, $this->getInterestString($value['interest_id']));
            }
            return implode(", ", $interestArray);
        }else{
            return "";
        }
    }

    private function getInterestString($interest_id)
    {
        $sql = "SELECT * FROM interest WHERE interest_id = :id";
        $statement = $this->dbh->prepare($sql);
        $statement->bindParam(":id", $interest_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['interest'];
    }
}