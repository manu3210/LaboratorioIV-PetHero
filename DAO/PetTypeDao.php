<?php
    namespace DAO;

    use DAO\IPetTypeDao as IPetTypeDao;
    use Models\PetType as PetType;

    class PetTypeDao implements IPetTypeDao
    {
        private $petTypeList;

        public function AddPetType(PetType $petType)
        {
            $this->RetrieveData();
            $last = end($this->petTypeList);
            $id = ($last != false) ? $last->getId() : 0;
            $id++;
            $petType->setId($id);
            array_push($this->petTypeList, $petType);

            $this->SaveData();
        }
        
        public function GetAll()
        {
            $this->RetrieveData();

            return $this->petTypeList;
        }
        
        public function GetById ($id) 
        {
            return GetpetType($id);
        }
        
        public function EditpetType($id, $size)
        {
            $this->RetrieveData();

            foreach($this->petTypeList as $petType)
            {
                if($petType->getId() == $id)
                {
                    $petType->setSize($size);
                }
            }
            $this->SaveData();
        }

        private function GetpetType($id)
        {
            $this->RetrieveData();

            foreach($this->petTypeList as $petType)
            {
                if($petType->getId() == $id)
                {
                    return $petType;
                }
            }
        }
        
        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->petTypeList as $petType)
            {
                $valuesArray["id"] = $petType->getId();
                $valuesArray["size"] = $petType->getSize();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/petType.json', $jsonContent);
        }
        
        private function RetrieveData()
        {
            $this->petTypeList = array();
            $arrayToDecode = array();

            if(file_exists('Data/petType.json'))
            {
                $jsonContent = file_get_contents('Data/petType.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $petType = new PetType();
                    $petType->setId($valuesArray["id"]);
                    $petType->setSize($valuesArray["size"]);

                    array_push($this->petTypeList, $petType);
                }
            }
            $this->SaveData();
        }
    }
?>