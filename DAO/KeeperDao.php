<?php
    namespace DAO;

    use DAO\IKeeperDao as IKeeperDao;
    use Models\Keeper as Keeper;

    class KeeperDao implements IKeeperDao
    {
        private $keeperList;

        public function Add(Keeper $keeper)
        {
            $this->RetrieveData();
            $last = end($this->keeperList);
            $id = ($last != false) ? $last->getId() : 0;
            $id++;
            $keeper->setId($id);
            array_push($this->keeperList, $keeper);

            $this->SaveData();
        }
        
        public function GetAll()
        {
            $this->RetrieveData();

            return $this->keeperList;
        }
        
        public function GetById ($id) 
        {
            return GetKeeper($id);
        }
        
        public function EditUser($id, $email, $password, $firstName, $lastName, $phone, $adress)
        {
            $this->RetrieveData();

            foreach($this->keeperList as $keeper)
            {
                if($keeper->getId() == $id)
                {
                    $keeper->setEmail($email);
                    $keeper->setPassword($password);
                    $keeper->setFirstName($firstName);
                    $keeper->setLastName($lastName);
                    $keeper->setPhone($phone);
                    $keeper->setAdress($adress);
                }
            }
            $this->SaveData();
        }

        public function EditAvailability($id, $availabilityFrom, $availabilityTo, $price, $size)
        {
            $this->RetrieveData();

            foreach($this->keeperList as $keeper)
            {
                if($keeper->getId() == $id)
                {
                    $keeper->setavailabilityFrom($availabilityFrom);
                    $keeper->setavailabilityTo($availabilityTo);
                    $keeper->setPetSize($size);
                    $keeper->setPrice($price);
                }
            }
            $this->SaveData();
        }


        private function GetKeeper($id)
        {
            $this->RetrieveData();

            foreach($this->keeperList as $keeper)
            {
                if($keeper->getId() == $id)
                {
                    return $keeper;
                }
            }
        }
        
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->keeperList as $keeper)
            {
                $valuesArray["id"] = $keeper->getId();
                $valuesArray["email"] = $keeper->getEmail();
                $valuesArray["password"] = $keeper->getPassword();
                $valuesArray["firstName"] = $keeper->getFirstName();
                $valuesArray["lastName"] = $keeper->getLastName();
                $valuesArray["phone"] = $keeper->getPhone();
                $valuesArray["adress"] = $keeper->getAdress();
                $valuesArray["availabilityFrom"] = $keeper->getAvailabilityFrom();
                $valuesArray["availabilityTo"] = $keeper->getAvailabilityTo();
                $valuesArray["petSize"] = $keeper->getPetSize();
                $valuesArray["price"] = $keeper->getPrice();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/keepers.json', $jsonContent);
        }
        
        private function RetrieveData()
        {
            $this->keeperList = array();
            $arrayToDecode = array();

            if(file_exists('Data/keepers.json'))
            {
                $jsonContent = file_get_contents('Data/keepers.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $keeper = new Keeper();
                    $keeper->setId($valuesArray["id"]);
                    $keeper->setEmail($valuesArray["email"]);
                    $keeper->setPassword($valuesArray["password"]);
                    $keeper->setFirstName($valuesArray["firstName"]);
                    $keeper->setLastName($valuesArray["lastName"]);
                    $keeper->setPhone($valuesArray["phone"]);
                    $keeper->setAdress($valuesArray["adress"]);
                    $keeper->setAvailabilityFrom($valuesArray["availabilityFrom"]);
                    $keeper->setAvailabilityTo($valuesArray["availabilityTo"]);
                    $keeper->setPetSize($valuesArray["petSize"]);
                    $keeper->setPrice($valuesArray["price"]);

                    array_push($this->keeperList, $keeper);
                }
            }

            $this->SaveData();
        }
    }
?>