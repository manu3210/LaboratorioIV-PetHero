<?php 
    namespace Models;

    class Owner extends User
    {
        private $pets;
        private $isAdmin;
        
        public function getPets()
        {
            return $this->pets;
        }

        public function setPets($pets)
        {
            $this->pets = $pets;
            return $this;
        }

        public function getIsAdmin()
        {
            return $this->isAdmin;
        }

        public function setIsAdmin($isAdmin)
        {
            $this->isAdmin = $isAdmin;
            return $this;
        }
    }
?>