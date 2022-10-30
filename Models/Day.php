<?php 

    namespace Models;

    class Day 
    {
        private $Id;
        private $dateString;
        private $isAvailable;
        private $keeperId;

        
        public function getdId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }
        
        public function getDateString()
        {
            return $this->dateString;
        }

        public function setDateString($dateString)
        {
            $this->dateString = $dateString;
            return $this;
        }

        public function getIsAvailable()
        {
            return $this->isAvailable;
        }

        public function setIsAvailable($isAvailable)
        {
            $this->isAvailable = $isAvailable;
            return $this;
        }

        public function getKeeperId()
        {
            return $this->keeperId;
        }

        public function setKeeperId($keeperId)
        {
            $this->keeperId = $keeperId;
            return $this;
        }

        
    }
?>