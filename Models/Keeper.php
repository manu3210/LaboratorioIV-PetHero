<?php 

    namespace Models;

    class Keeper extends User
    {
        private $availabilityFrom;
        private $availabilityTo;
        private $petSize;
        private $price;

        public function getAvailabilityFrom()
        {
            return $this->availabilityFrom;
        }

        public function setAvailabilityFrom($availabilityFrom)
        {
            $this->availabilityFrom = $availabilityFrom;
            return $this;
        }

        public function getAvailabilityTo()
        {
            return $this->availabilityTo;
        }

        public function setAvailabilityTo($availabilityTo)
        {
            $this->availabilityTo = $availabilityTo;
            return $this;
        }
        public function getPetSize()
        {
            return $this->petSize;
        }

        public function setPetSize($petSize)
        {
            $this->petSize = $petSize;
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

    }
?>