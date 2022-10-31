<?php
    namespace DAO;

    use Models\Review as Review;
    use Models\Owner as Owner;

    class ReviewDao
    {
        private $connection;
        private $tableName = "reviews";

        public function Add($review)
        {
            try
            {
                $query  = "INSERT INTO " . $this->tableName . "(details, createdAt, keeperId, score, ownerId) VALUES (:details, :createdAt, :keeperId, :score, :ownerId);";
                $parameters["details"] = $review->getDetails();
                $parameters["createdAt"] = $review->getCreatedAt();
                $parameters["keeperId"] = $review->getKeeper()->getId();
                $parameters["ownerId"] = $review->getOwner()->getId();
                $parameters["score"] = $review->getScore();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

                $lastId = "SELECT LAST_INSERT_ID() as reviewId";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($lastId);
                
                foreach ($result as $row)
                {          
                    return $row["reviewId"];
                }
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function GetById($id)
        {
            try
            {
                $query = "SELECT r.reviewId, r.details, r.createdAt, r.keeperId, r.score, r.ownerId, o.firstName, o.lastName FROM ".$this->tableName . " r"
                . " JOIN owners o ON o.ownerId = r.ownerId"
                . " WHERE r.reviewId = " . $id;
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                
                foreach ($result as $row)
                {          
                    $owner = new Owner();
                    $owner->setFirstName($row["firstName"]);
                    $owner->setLastName($row["lastName"]);

                    $review = new Review();
                    $review->setId($row["reviewId"]);
                    $review->setDetails($row["details"]);
                    $review->setCreatedAt($row["createdAt"]);
                    $review->setKeeper($row["keeperId"]);
                    $review->setScore($row["score"]);
                    $review->setOwner($owner);
                }
                return $review;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetKeeperReviews($id)
        {
            try
            {
                $reviewList = array();
                $query = "SELECT r.reviewId, r.details, r.createdAt, r.keeperId, r.score, r.ownerId, o.firstName, o.lastName FROM ".$this->tableName . " r"
                . " JOIN owners o ON o.ownerId = r.ownerId"
                . " WHERE keeperId = " . $id;
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                
                foreach ($result as $row)
                {          
                    $owner = new Owner();
                    $owner->setFirstName($row["firstName"]);
                    $owner->setLastName($row["lastName"]);

                    $review = new Review();
                    $review->setId($row["reviewId"]);
                    $review->setDetails($row["details"]);
                    $review->setCreatedAt($row["createdAt"]);
                    $review->setKeeper($row["keeperId"]);
                    $review->setScore($row["score"]);
                    $review->setOwner($owner);
                    array_push($reviewList, $review);
                }
                return $reviewList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
