<?php
    namespace Controllers;
    use Models\Pet as Pet;
    use DAO\PetDAO as PetDao;
    use DAO\PetTypeDAO as PetTypeDAO;
    
    class PetController
    {
        private $petDao;
        private $petTypeDao;

        public function __construct()
        {
            $this->petDao = new PetDao();
            $this->petTypeDao = new PetTypeDao();
        }

        public function ShowPetList()
        {
            $petList = $this->petDao->GetPetsByUserId($_SESSION["user"]->getId());
            require_once(VIEWS_PATH."PetList.php");
        }

        public function ShowAddPet()
        {
            $petTypeList = $this->petTypeDao->GetAll();
            require_once(VIEWS_PATH."AddPet.php");
        }

        public function ShowEditPet($id)
        {
            $pet = $this->petDao->GetById($id);
            $petTypeList = $this->petTypeDao->GetAll();
            require_once(VIEWS_PATH."EditPet.php");
        }

        public function ShowPetProfile($id)
        {
            $pet = $this->petDao->GetById($id);
            require_once(VIEWS_PATH."PetProfile.php");
        }

        /*************************************** POST ***************************************************/

        public function AddPet($name, $breed, $urlPhoto, $urlVideo, $urlVaccination, $type, $details)
        {
            $user = $_SESSION["user"];

            $pet = new Pet();
            $pet->setName($name);
            $pet->setType($type);
            $pet->setUrlPhoto($urlPhoto);
            $pet->setUrlVideo($urlVideo);
            $pet->setUrlVaccination($urlVaccination);
            $pet->setDetails($details);
            $pet->setBreed($breed);
            $pet->setOwner($user);
            

            $this->petDao->Add($pet);
            header("location:" .FRONT_ROOT . "User/ShowOwnerHome");
        }

        public function EditPet($id, $name, $breed, $urlPhoto, $urlVideo, $urlVaccination, $type, $details)
        {
            $pet = new Pet();

            $pet->setId($id);
            $pet->setName($name);
            $pet->setBreed($breed);
            $pet->setUrlPhoto($urlPhoto);
            $pet->setUrlVideo($urlVideo);
            $pet->setUrlVaccination($urlVaccination);
            $pet->setType($type);
            $pet->setDetails($details);

            $this->petDao->EditPet($pet);
            header("location:" .FRONT_ROOT . "Pet/ShowPetList");
        }

        public function DeletePet($id)
        {
            $this->petDao->DeletePet($id);
            header("location:" .FRONT_ROOT . "Pet/ShowPetList");
        }
    }
?>