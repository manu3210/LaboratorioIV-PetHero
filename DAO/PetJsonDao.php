<?php
    namespace DAO;

    use Models\Pet as Pet;
    use Models\Owner as Owner;

    class PetJsonDao implements IPetDao
    {
        private $petList;
        private $ownerList;

        public function Add($pet)
        {
            $this->petList = Array();
            $this->ownerList = Array();
            $this->RetrieveData();
            $last = end($this->petList);
            $id = ($last != false) ? $last->getId() : 0;
            $id++;
            $pet->setId($id);
            array_push($this->petList, $pet);
            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->petList as $pet)
            {
                
                $valuesPetArray["id"] = $pet->getId();
                $valuesPetArray["name"] = $pet->getName();
                $valuesPetArray["type"] = $pet->getType();
                $valuesPetArray["urlPhoto"] = $pet->getUrlPhoto();
                $valuesPetArray["urlVideo"] = $pet->getUrlVideo();
                $valuesPetArray["urlVaccination"] = $pet->getUrlVaccination();
                $valuesPetArray["details"] = $pet->getDetails();
                $valuesPetArray["breed"] = $pet->getBreed();

                $valuesArray["id"] = $pet->getOwner()->getId();
                $valuesArray["firstName"] = $pet->getOwner()->getFirstName();
                $valuesArray["lastName"] = $pet->getOwner()->getLastName();
                $valuesArray["phone"] = $pet->getOwner()->getPhone();
                $valuesArray["adress"] = $pet->getOwner()->getAdress();
                $valuesArray["email"] = $pet->getOwner()->getEmail();

                $valuesPetArray["owner"] = $valuesArray;


                
                array_push($arrayToEncode, $valuesPetArray);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/pets.json', $jsonContent);
        }
        
        private function RetrieveData()
        {
            $this->ownerList = array();
            $arrayToDecode = array();
            $this->petList = array();

            if(file_exists('Data/pets.json'))
            {
                $jsonContent = file_get_contents('Data/pets.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $item)
                {
                    $pet = new Pet();
                    $pet->setId($item["id"]);
                    $pet->setName($item["name"]);
                    $pet->setType($item["type"]);
                    $pet->setUrlPhoto($item["urlPhoto"]);
                    $pet->setUrlVideo($item["urlVideo"]);
                    $pet->setUrlVaccination($item["urlVaccination"]);
                    $pet->setDetails($item["details"]);
                    $pet->setBreed($item["breed"]);
                    
                    $owner = new Owner();
                    $owner->setId($item["owner"]["id"]);
                    $owner->setFirstName($item["owner"]["firstName"]);
                    $owner->setLastName($item["owner"]["lastName"]);
                    $owner->setPhone($item["owner"]["phone"]);
                    $owner->setAdress($item["owner"]["adress"]);
                    $owner->setEmail($item["owner"]["email"]);

                    $pet->setOwner($owner);

                    array_push($this->petList, $pet);
                }
            }
        
        }

        public function GetPetsByUserId($id)
        {
            $userPets = array();
            $this->RetrieveData();
            foreach($this->petList as $pet)
            {
                if($pet->getOwner()->getId() == $id)
                {
                    array_push($userPets, $pet);
                }
            }
            $this->petList = $userPets;
            return $this->petList;
        }

        public function GetById($id)
        {
            $this->RetrieveData();

            foreach($this->petList as $pet)
            {
                if($pet->getId() == $id)
                {
                    return $pet;
                }
            }
        }

        public function EditPet($updatePet)
        {
            $this->RetrieveData();

            foreach($this->ownerList as $owner)
            {
                if($owner->getId() == $_SESSION["user"]->getId())
                {
                    foreach($owner->getPets() as $pet)
                    {
                        if($pet->getId() == $id)
                        {
                            $pet->setName($updatePet->getName());
                            $pet->setType($updatePet->getType());
                            $pet->setUrlPhoto($updatePet->getUrlPhoto());
                            $pet->setUrlVideo($updatePet->getUrlVideo());
                            $pet->setUrlVaccination($updatePet->geturlVaccination());
                            $pet->setDetails($updatePet->getDetails());
                            $pet->setBreed($updatePet->getBreed());
                        }
                    }
                }
            }
            $this->SaveData();
        }

        public function DeletePet($id)
        {
            $this->RetrieveData();
            $index = 0;

            foreach($this->petList as $pet)
            {
                if($pet->getId() == $id)
                {
                    unset($this->petList[$index]);
                }
                $index++;
            }
            $this->SaveData();
        }
    }

?>