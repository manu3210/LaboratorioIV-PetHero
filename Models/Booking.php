<?php 

    namespace Models;

    class Booking
    {
        private $id;
        private $dateFrom;
        private $dateTo;
        private $pet;
        private $owner;
        private $keeper;
        private $price;
        private $isConfirmed;
        private $isPaid;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }

        public function getDateFrom()
        {
            return $this->dateFrom;
        }

        public function setDateFrom($dateFrom)
        {
            $this->dateFrom = $dateFrom;
            return $this;
        }

        public function getDateTo()
        {
            return $this->dateTo;
        }

        public function setDateTo($dateTo)
        {
            $this->dateTo = $dateTo;
            return $this;
        }

        public function getPet()
        {
            return $this->pet;
        }

        public function setPet($pet)
        {
            $this->pet = $pet;
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

        public function getKeeper()
        {
            return $this->keeper;
        }

        public function setKeeper($keeper)
        {
            $this->keeper = $keeper;
            return $this;
        }
        
        public function getPrice()
        {
            return $this->price;
        }

        public function setPrice($price)
        {
            $this->price = $price;
            return $this;
        }

        public function getIsConfirmed()
        {
            return $this->isConfirmed;
        }

        public function setIsConfirmed($isConfirmed)
        {
            $this->isConfirmed = $isConfirmed;
            return $this;
        }

        public function getisPaid()
        {
            return $this->isPaid;
        }

        public function setisPaid($isPaid)
        {
            $this->isPaid = $isPaid;
            return $this;
        }
    }
?>