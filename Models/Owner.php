<?php 

    namespace Models;

    class Owner
    {
        
        private $id;
        private $email;
        private $password;
        private $name;
        private $pets;
        
        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;

            return $this;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

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