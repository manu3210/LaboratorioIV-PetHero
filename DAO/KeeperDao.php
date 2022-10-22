<?php
    namespace DAO;

    use DAO\IKeeperDao as IKeeperDao;
    use Models\Keeper as Keeper;

    class KeeperDao implements IKeeperDao
    {
        //private $keeperList;

        private $connection;
        private $tableName = "keepers";

        public function Add(Keeper $keeper)
        {
            try
            {
                $query  = "INSERT INTO " . $this->tableName . "(email, pass, firstName, lastName, phone, adress) VALUES (:email, :pass, :firstName, :lastName, :phone, :adress);";
                $parameters["email"] = $keeper->getEmail();
                $parameters["pass"] = $keeper->getPassword();
                $parameters["firstName"] = $keeper->getFirstName();
                $parameters["lastName"] = $keeper->getLastName();
                $parameters["phone"] = $keeper->getPhone();
                $parameters["adress"] = $keeper->getAdress();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function GetAll()
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);
                
                foreach ($result as $row)
                {                
                    $user = new keeper();
                    $user->setId($row["keeperId"]);
                    $user->setEmail($row["email"]);
                    $user->setFirstName($row["firstName"]);
                    $user->setLastName($row["lastName"]);
                    $user->setPhone($row["phone"]);
                    $user->setAdress($row["adress"]);
                    $user->setPassword($row["pass"]);

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        /*
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
        */
    }
?>