<?php 

    namespace Models;

    class User
    {
        
        private $id;
        private $email;
        private $password;
        private $firstName;
        private $lastName;
        private $phone;
        private $adress;
        
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

        public function getFirstName()
        {
            return $this->firstName;
        }

        public function setfirstName($firstName)
        {
            $this->firstName = $firstName;
            return $this;
        }

        public function getLastName()
        {
            return $this->lastName;
        }

        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
            return $this;
        }

        public function getPhone()
        {
            return $this->phone;
        }

        public function setPhone($phone)
        {
            $this->phone = $phone;
            return $this;
        }

        public function getAdress()
        {
            return $this->adress;
        }

        public function setadress($adress)
        {
            $this->adress = $adress;
            return $this;
        }
    }
?>