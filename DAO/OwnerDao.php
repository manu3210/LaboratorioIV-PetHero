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
            $last = end($this->ownerList);
            $id = ($last != false) ? $last->getId() : 0;
            $id++;
            $owner->setId($id);
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
            return $this->GetOwner($id);
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

        public function EditUser($id, $email, $password, $firstName, $lastName, $phone, $adress)
        {
            $this->RetrieveData();

            foreach($this->ownerList as $owner)
            {
                if($owner->getId() == $id)
                {
                    $owner->setEmail($email);
                    $owner->setPassword($password);
                    $owner->setFirstName($firstName);
                    $owner->setLastName($lastName);
                    $owner->setPhone($phone);
                    $owner->setAdress($adress);
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
                $valuesArray["firstName"] = $owner->getFirstName();
                $valuesArray["lastName"] = $owner->getLastName();
                $valuesArray["phone"] = $owner->getPhone();
                $valuesArray["adress"] = $owner->getAdress();
                $valuesArray["pets"] = array();

                if($owner->getPets() != null)
                {
                    foreach($owner->getPets() as $pet)
                    {
                        $valuesPetArray["id"] = $pet->getId();
                        $valuesPetArray["name"] = $pet->getName();
                        $valuesPetArray["type"] = $pet->getType();
                        $valuesPetArray["urlPhoto"] = $pet->getUrlPhoto();
                        $valuesPetArray["urlVideo"] = $pet->getUrlVideo();
                        $valuesPetArray["urlVaccination"] = $pet->getUrlVaccination();
                        $valuesPetArray["details"] = $pet->getDetails();
                        $valuesPetArray["breed"] = $pet->getBreed();
                        array_push($valuesArray["pets"], $valuesPetArray);
                    }
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
                    $owner->setFirstName($valuesArray["firstName"]);
                    $owner->setLastName($valuesArray["lastName"]);
                    $owner->setPhone($valuesArray["phone"]);
                    $owner->setAdress($valuesArray["adress"]);

                    foreach($valuesArray["pets"] as $item)
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

                        array_push($petList, $pet);
                    }
                    $owner->setPets($petList);
                    $petList = array();
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
            $owner = $this->GetById($_SESSION["user"]->getId());

            foreach($owner->getPets() as $pet)
            {
                if($pet->getId() == $id)
                {
                    return $pet;
                }
            }
        }

        public function EditPet($id, $name, $type, $urlPhoto, $urlVideo, $urlVaccination, $breed, $details)
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
                            $pet->setName($name);
                            $pet->setType($type);
                            $pet->setUrlPhoto($urlPhoto);
                            $pet->setUrlVideo($urlVideo);
                            $pet->setUrlVaccination($urlVaccination);
                            $pet->setDetails($details);
                            $pet->setBreed($breed);
                        }
                    }
                }
            }
            $this->SaveData();
        }

        public function DeletePet($id)
        {
            $this->RetrieveData();
            $petList = array();
            $index = 0;

            foreach($this->ownerList as $owner)
            {
                if($owner->getId() == $_SESSION["user"]->getId())
                {
                    $petList = $owner->getPets();
                    foreach($petList as $pet)
                    {
                        if($pet->getId() == $id)
                        {
                            unset($petList[$index]);
                            $owner->setPets($petList);
                        }
                        $index++;
                    }
                }
            }
            $this->SaveData();
        }
    }
?>