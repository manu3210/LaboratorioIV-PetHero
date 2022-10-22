<?php
    namespace Controllers;
    use DAO\PetTypeDao as petTypeDao;
    use Models\PetType as PetType;

    class PetTypeController
    {
        private $petTypeDao;

        public function __construct()
        {
            $this->petTypeDao = new PetTypeDao();
        }

        public function ShowSetPetTypes()
        {
            require_once(VIEWS_PATH."SetPetTypes.php");
        }     
        
        public function AddPetType($size)
        {
            $petType = new PetType();
            $petType->setSize($size);

            $this->petTypeDao->Add($petType);
            header("location:" .FRONT_ROOT . "User/ShowOwnerHome");
        }
    }
?>