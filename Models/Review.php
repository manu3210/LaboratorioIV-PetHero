<?php 

    namespace Models;

    class Review
    {
        private $id;
        private $details;
        private $createdAt;
        private $score;
        private $keeper;
        private $owner;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }

        public function getDetails()
        {
            return $this->details;
        }

        public function setDetails($details)
        {
            $this->details = $details;
            return $this;
        }

        public function getCreatedAt()
        {
            return $this->createdAt;
        }

        public function setCreatedAt($createdAt)
        {
            $this->createdAt = $createdAt;
            return $this;
        }

        public function getScore()
        {
            return $this->score;
        }

        public function setScore($score)
        {
            $this->score = $score;
            return $this;
        }

        public function getKeeper()
        {
            return $this->keeper;
        }

        public function setKeeper($keeper)
        {
            $this->keeper = $keeper;
            return $this;
        }

        public function getOwner()
        {
            return $this->owner;
        }

        public function setOwner($owner)
        {
            $this->owner = $owner;
            return $this;
        }
    }
?>