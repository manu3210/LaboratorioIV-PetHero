<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDao as KeeperDao;
    use Exception;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;
    use Models\Pet as Pet;

    class UserController
    {
        private $ownerDao;
        private $keeperDao;

        public function __construct()
        {
            $this->ownerDao = new OwnerDao();
            $this->keeperDao = new KeeperDao();
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
            require_once(VIEWS_PATH."OwnerHome.php");
        }

        public function ShowKeeperHome()
        {
            require_once(VIEWS_PATH."KeeperHome.php");
        }

        public function ShowPetList()
        {
            require_once(VIEWS_PATH."PetList.php");
        }

        public function ShowAddPet()
        {
            require_once(VIEWS_PATH."AddPet.php");
        }

        public function ShowEditPet($id)
        {
            $pet = $this->ownerDao->GetPetById($id);
            require_once(VIEWS_PATH."EditPet.php");
        }

        public function ShowKeeperList()
        {
            $keeperList = $this->keeperDao->getAll();
            require_once(VIEWS_PATH."KeeperList.php");
        }



        // ---------------------------------- POST -------------------------------------- //

        public function AddUser($email, $password, $name, $isKeeper)
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
            $user->setName($name);

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

        public function AddPet($name, $type)
        {
            $user = $_SESSION["user"];

            $pet = new Pet();
            $pet->setName($name);
            $pet->setType($type);

            $arr = $user->getPets();
            array_push($arr, $pet);
            $user->setPets($arr);

            $this->ownerDao->AddPet($user);
            header("location:" .FRONT_ROOT . "User/ShowOwnerHome");
        }

        public function EditPet($id, $name, $type)
        {
            $this->ownerDao->EditPet($id, $name, $type);
            header("location:" .FRONT_ROOT . "User/ShowPetList");
        }

        public function Logout()
        {
            session_destroy();
            header("location:" .FRONT_ROOT . "Home/Index");
        }
    }
?>