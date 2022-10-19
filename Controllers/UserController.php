<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDao as KeeperDao;
    use DAO\PetTypeDao as PetTypeDao;
    use Exception;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;
    use Models\Pet as Pet;
    use Models\PetType as PetType;

    class UserController
    {
        private $ownerDao;
        private $keeperDao;
        private $petTypeDao;

        public function __construct()
        {
            $this->ownerDao = new OwnerDao();
            $this->keeperDao = new KeeperDao();
            $this->petTypeDao = new PetTypeDao();
        }

        // ----------------------------------- GET ------------------------------------ //

        public function ShowSignUp()
        {
            require_once(VIEWS_PATH."SignUp.php");
        }

        public function ShowHome()
        {
            require_once(VIEWS_PATH."presentation.php");
        }

        public function ShowOwnerLogin()
        {
            require_once(VIEWS_PATH."OwnerLogin.php");
        }

        public function ShowKeeperLogin()
        {
            require_once(VIEWS_PATH."KeeperLogin.php");
        }

        public function ShowOwnerHome()
        {
            $users = $this->ownerDao->Getall();
            foreach($users as $item)
            {
                if($item->getId() == $_SESSION["user"]->getId())
                {
                    $_SESSION["user"] = $item;
                }
            }
            require_once(VIEWS_PATH."OwnerHome.php");
        }

        public function ShowKeeperHome()
        {
            $users = $this->keeperDao->Getall();
            foreach($users as $item)
            {
                if($item->getId() == $_SESSION["user"]->getId())
                {
                    $_SESSION["user"] = $item;
                }
            }
            require_once(VIEWS_PATH."KeeperHome.php");
        }

        public function ShowEditProfile()
        {
            require_once(VIEWS_PATH."EditUser.php");
        }

        public function ShowPetList()
        {
            $users = $this->ownerDao->Getall();
            foreach($users as $user)
            {
                if($user->getId() == $_SESSION["user"]->getId())
                {
                    $petList = $user->getPets();
                }
            }

            require_once(VIEWS_PATH."PetList.php");
        }

        public function ShowAddPet()
        {
            $petTypeList = $this->petTypeDao->GetAll();
            require_once(VIEWS_PATH."AddPet.php");
        }

        public function ShowEditPet($id)
        {
            $users = $this->ownerDao->Getall();
            $petTypeList = $this->petTypeDao->GetAll();
            foreach($users as $user)
            {
                if($user->getId() == $_SESSION["user"]->getId())
                {
                    $pet = $this->ownerDao->GetPetById($id);
                }
            }
            require_once(VIEWS_PATH."EditPet.php");
        }

        public function ShowPetProfile($id)
        {
            $users = $this->ownerDao->Getall();
            foreach($users as $user)
            {
                if($user->getId() == $_SESSION["user"]->getId())
                {
                    $pet = $this->ownerDao->GetPetById($id);
                }
            }
            require_once(VIEWS_PATH."PetProfile.php");
        }

        public function ShowKeeperList()
        {
            $keeperList = $this->keeperDao->getAll();
            require_once(VIEWS_PATH."KeeperList.php");
        }

        public function ShowEditAvailability()
        {
            require_once(VIEWS_PATH."EditAvailability.php");
        }


        // ---------------------------------- POST -------------------------------------- //

        public function AddUser($email, $password, $firstName, $lastName, $phone, $adress, $isKeeper)
        {
            if($isKeeper == 0)
            {
                $user = new Owner();
                $user->setPets = array();
            }
            else
            {
                $user = new Keeper();
            }
            
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setPhone($phone);
            $user->setAdress($adress);

            if($isKeeper == 0)
            {
                $this->ownerDao->Add($user);
            }
            else
            {
                $this->keeperDao->Add($user);
            }
            
            $this->ShowHome();
        }

        public function OwnerLogin ($email, $password)
        {
            $data = $this->ownerDao->GetAll();

            foreach($data as $user)
            {
                if($user->getPassword() == $password && $user->getEmail() == $email)
                {
                    $_SESSION["user"] = $user;
                    header("location:" .FRONT_ROOT . "User/ShowOwnerHome");
                }
            }
        }

        public function KeeperLogin ($email, $password)
        {
            $data = $this->keeperDao->GetAll();

            foreach($data as $user)
            {
                if($user->getPassword() == $password && $user->getEmail() == $email)
                {
                    $_SESSION["user"] = $user;
                    header("location:" .FRONT_ROOT . "User/ShowKeeperHome");
                }
            }
        }

        public function EditUser($id, $email, $password, $firstName, $lastName, $phone, $adress)
        {
            
            if(get_class($_SESSION["user"]) == "Models\Owner")
            {
                $this->ownerDao->EditUser($id, $email, $password, $firstName, $lastName, $phone, $adress);
                header("location:" .FRONT_ROOT . "User/ShowOwnerHome");
            }
            else
            {
                $this->keeperDao->EditUser($id, $email, $password, $firstName, $lastName, $phone, $adress);
                header("location:" .FRONT_ROOT . "User/ShowKeeperHome");
            }
        }

        public function AddPet($name, $breed, $urlPhoto, $urlVideo, $urlVaccination, $type,  $details)
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

            $arr = $user->getPets();
            $last = end($arr);
            $id = ($last != false) ? $last->getId() : 0;
            $id++;
            $pet->setId($id);
            array_push($arr, $pet);
            $user->setPets($arr);

            $this->ownerDao->AddPet($user);
            header("location:" .FRONT_ROOT . "User/ShowOwnerHome");
        }

        public function EditPet($id, $name, $breed, $urlPhoto, $urlVideo, $urlVaccination, $type, $details)
        {
            $this->ownerDao->EditPet($id, $name, $type, $urlPhoto, $urlVideo, $urlVaccination, $breed, $details);
            header("location:" .FRONT_ROOT . "User/ShowPetList");
        }

        public function DeletePet($id)
        {
            $this->ownerDao->DeletePet($id);
            header("location:" .FRONT_ROOT . "User/ShowPetList");
        }

        public function EditAvailability($id, $availabilityFrom, $availabilityTo)
        {
            $this->keeperDao->EditAvailability($id, $availabilityFrom, $availabilityTo);
            header("location:" .FRONT_ROOT . "User/ShowKeeperHome");
        }

        public function Logout()
        {
            session_destroy();
            header("location:" .FRONT_ROOT . "Home/Index");
        }
    }
?>