<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDao as KeeperDao;
    use Exception;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;

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

        // ---------------------------------- POST -------------------------------------- //

        public function AddUser($email, $password, $name, $isKeeper)
        {
            if($isKeeper == 0)
            {
                $user = new Owner();
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
                $this->ownerDao->Add($user);
            }
            
            $this->ShowHome();
        }
    }
?>