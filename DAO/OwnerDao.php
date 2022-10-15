<?php
    namespace DAO;

    use DAO\IOwnerDAO as IOwnerDAO;
    use Models\Owner as Owner;
    use Models\Pet as Pet;

    class OwnerDAO implements IOwnerDAO
    {
        private $ownerList;

        public function Add(Owner $owner)
        {
            $this->RetrieveData();
            
            array_push($this->ownerList, $owner);

            $this->SaveData();
        }
        
        public function GetAll()
        {
            $this->RetrieveData();

            return $this->ownerList;
        }
        
        public function GetById ($id) 
        {
            return GetOwner($id);
        }
        
        public function Update($owner)
        {
            $toUpdate = $this->GetOwner($owner->getId());

            $toUpdate->setEmail($owner->getEmail());
            $toUpdate->setPassword($owner->getPassword());
            $toUpdate->setName($owner->getName());

            $this->SaveData();

            return $owner;
        }

        public function AddPet($user)
        {
            $this->RetrieveData();
            $petArray = $user->getPets();

            foreach($this->ownerList as $owner)
            {
                if($owner->getId() == $user->getId())
                {
                    $owner->setPets($petArray);
                }
            }
            $this->SaveData();
        }

        private function GetOwner($id)
        {
            $this->RetrieveData();

            foreach($this->ownerList as $owner)
            {
                if($owner->getId() == $id)
                {
                    return $owner;
                }
            }
        }
        
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->ownerList as $owner)
            {
                $valuesArray["id"] = $owner->getId();
                $valuesArray["email"] = $owner->getEmail();
                $valuesArray["password"] = $owner->getPassword();
                $valuesArray["name"] = $owner->getName();
                $valuesArray["pets"] = array();

                foreach($owner->getPets() as $pet)
                {
                    $valuesPetArray["id"] = $pet->getId();
                    $valuesPetArray["name"] = $pet->getName();
                    $valuesPetArray["type"] = $pet->getType();
                    array_push($valuesArray["pets"], $valuesPetArray);
                }

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/owners.json', $jsonContent);
        }
        
        private function RetrieveData()
        {
            $this->ownerList = array();
            $arrayToDecode = array();
            $petList = array();

            if(file_exists('Data/owners.json'))
            {
                $jsonContent = file_get_contents('Data/owners.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $owner = new Owner();
                    $owner->setId($valuesArray["id"]);
                    $owner->setEmail($valuesArray["email"]);
                    $owner->setPassword($valuesArray["password"]);
                    $owner->setName($valuesArray["name"]);

                    foreach($valuesArray["pets"] as $item)
                    {
                        $pet = new Pet();
                        $pet->setId($item["id"]);
                        $pet->setName($item["name"]);
                        $pet->setType($item["type"]);

                        array_push($petList, $pet);
                    }
                    $owner->setPets($petList);
                    array_push($this->ownerList, $owner);
                }
            }
        }

        public function GetAllPets()
        {
            $petList = array();

            foreach($this->ownerList as $owner)
            {
                foreach($owner->getPets() as $pet)
                {
                    array_push($petList, $pet);
                }
            }
            return $petList;
        }

        public function GetPetById($id)
        {
            $owner = $_SESSION["user"];

            foreach($owner->getPets() as $pet)
            {
                if($pet->getId() == $id)
                {
                    return $pet;
                }
            }
        }

        public function EditPet($id, $name, $type)
        {
            foreach($_SESSION["user"]->getPets() as $pet)
            {
                if($pet->getId() == $id)
                {
                    $pet->setName($name);
                    $pet->setType($type);
                }
            }
            $this->SaveData();
        }
    }
?>