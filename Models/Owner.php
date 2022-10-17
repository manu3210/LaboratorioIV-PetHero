<?php 
    namespace Models;

    class Owner extends User
    {
        private $pets;
        
        public function getPets()
        {
            return $this->pets;
        }

        public function setPets($pets)
        {
            $this->pets = $pets;
            return $this;
        }
    }
?>