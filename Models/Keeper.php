<?php 

    namespace Models;

    class Keeper extends User
    {
        private $availabilityFrom;
        private $availabilityTo;

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
            return $this->availabilityv;
        }

        public function setAvailabilityTo($availabilityTo)
        {
            $this->availabilityTo = $availabilityTo;
            return $this;
        }
    }
?>