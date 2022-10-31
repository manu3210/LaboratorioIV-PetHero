<?php
    namespace DAO;

    use Models\Pet as Pet;
    use Models\Owner as Owner;

    class PetDao implements IPetDao
    {
        private $petList;
        private $connection;
        private $tableName = "pets";

        public function Add($pet)
        {
            try
            {
                $query  = "INSERT INTO " . $this->tableName . "(petName, petTypeId, urlPhoto, urlVideo, urlVaccination, details, breed, ownerId) VALUES (:petName, :petTypeId, :urlPhoto, :urlVideo, :urlVaccination, :details, :breed, :ownerId);";
                $parameters["petName"] = $pet->getName();
                $parameters["petTypeId"] = $pet->getType();
                $parameters["urlPhoto"] = $pet->getUrlPhoto();
                $parameters["urlVideo"] = $pet->getUrlVideo();
                $parameters["urlVaccination"] = $pet->getUrlVaccination();
                $parameters["details"] = $pet->getDetails();
                $parameters["breed"] = $pet->getBreed();
                $parameters["ownerId"] = $pet->getOwner()->getId();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function EditPet(Pet $pet)
        {
            try
            {
                $query  = "UPDATE " . $this->tableName 
                . " SET petName='" . $pet->getName() 
                . "', petTypeId = ". $pet->getType() 
                . ", urlPhoto = '". $pet->getUrlPhoto() 
                . "', urlVideo = '". $pet->getUrlVideo() 
                . "', urlVaccination = '". $pet->getUrlVaccination() 
                . "', details = '". $pet->getDetails() 
                . "', breed = '". $pet->getbreed() 
                ."' where petId = " . $pet->getId();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function GetById($id)
        {
            try
            {
                $query = "SELECT p.petId, p.petName, p.urlPhoto, p.urlVideo, p.urlVaccination, p.details, p.breed, t.size FROM "
                    .$this->tableName 
                    ." p join petTypes t on p.petTypeId = t.petTypeId WHERE petId = ".$id;

                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                
                foreach ($result as $row)
                {                
                    $pet = new Pet();
                    $pet->setName($row["petName"]);
                    $pet->setUrlPhoto($row["urlPhoto"]);
                    $pet->setUrlVideo($row["urlVideo"]);
                    $pet->setUrlVaccination($row["urlVaccination"]);
                    $pet->setDetails($row["details"]);
                    $pet->setBreed($row["breed"]);
                    $pet->setType($row["size"]);
                    $pet->setId($row["petId"]);
                    return $pet;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetPetsByUserId($id)
        {
            try
            {
                $petList = array();

                $query = "SELECT p.petId, p.petName, p.urlPhoto, p.urlVideo, p.urlVaccination, p.details, p.breed, t.size FROM "
                    .$this->tableName 
                    ." p join petTypes t on p.petTypeId = t.petTypeId WHERE ownerId = ".$id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);
                
                foreach ($result as $row)
                {                
                    $pet = new Pet();
                    $pet->setName($row["petName"]);
                    $pet->setUrlPhoto($row["urlPhoto"]);
                    $pet->setUrlVideo($row["urlVideo"]);
                    $pet->setUrlVaccination($row["urlVaccination"]);
                    $pet->setDetails($row["details"]);
                    $pet->setBreed($row["breed"]);
                    $pet->setType($row["size"]);
                    $pet->setId($row["petId"]);

                    array_push($petList, $pet);
                }

                return $petList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function deletePet($petId)
        {
            try
            {
                $query  = "DELETE FROM " . $this->tableName . " WHERE petId =" . $petId;
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        /* --------------------------------------------------------------------------------------------------------------------- */

        public function AddJson($pet)
        {
            $this->petList = Array();
            $this->RetrieveData();
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

        public function GetPetsByUserIdJson()
        {
            $this->RetrieveData();
            return $this->petList;
        }

        public function GetPetByIdJson($id)
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

        public function EditPetJson($id, $name, $type, $urlPhoto, $urlVideo, $urlVaccination, $breed, $details)
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

        public function DeletePetJson($id)
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