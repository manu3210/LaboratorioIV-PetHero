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
    }

?>