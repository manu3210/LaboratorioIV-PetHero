<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDao as KeeperDao;
    use DAO\PetTypeDao as PetTypeDao;
    use Exception;
    use \Datetime;
    use DateInterval;
    use Dateperiod;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;
    use Models\Pet as Pet;
    use Models\PetType as PetType;
    use Models\User as User;
    use Models\Day as Day;

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

        public function ShowKeeperList()
        {
            $keeperList = $this->keeperDao->GetAll();
            require_once(VIEWS_PATH."KeeperList.php");
        }

        public function ShowEditAvailability()
        {
            $petTypeList = $this->petTypeDao->GetAll();
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
            $user = new User();
            $user->setId($id);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setPhone($phone);
            $user->setAdress($adress);

            if(get_class($_SESSION["user"]) == "Models\Owner")
            {
                $this->ownerDao->EditUser($user);
                header("location:" .FRONT_ROOT . "User/ShowOwnerHome");
            }
            else
            {
                $this->keeperDao->EditUser($user);
                header("location:" .FRONT_ROOT . "User/ShowKeeperHome");
            }
        }

        public function EditAvailability($id, $availabilityFrom, $availabilityTo, $price, $size)
        {
            $keeper = new Keeper();
            $keeper->setId($id);
            $keeper->setAvailabilityFrom($availabilityFrom);
            $keeper->setAvailabilityTo($availabilityTo);
            $keeper->setPrice($price);
            $keeper->setPetSize($size);

            $dateArray = $this->getRangeDate($availabilityFrom, $availabilityTo, 'Y-m-d');
            $days = array();

            foreach($dateArray as $date)
            {
                $day = new Day();
                $day->setDateString($date);
                $day->setIsAvailable(true);
                $day->setKeeperId($_SESSION["user"]->getId());
                array_push($days, $day);
            }

            $keeper->setDays($days);
            $this->keeperDao->EditAvailability($keeper);
            header("location:" .FRONT_ROOT . "User/ShowKeeperHome");
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

        

        public function Logout()
        {
            session_destroy();
            header("location:" .FRONT_ROOT . "Home/Index");
        }

        private function getRangeDate($date_ini, $date_end, $format) {

            $dt_ini = DateTime::createFromFormat($format, $date_ini);
            $dt_end = DateTime::createFromFormat($format, $date_end);
            $period = new DatePeriod(
                $dt_ini,
                new DateInterval('P1D'),
                $dt_end,
            );
            $range = [];
            foreach ($period as $date) {
                $range[] = $date->format($format);
            }
            $range[] = $date_end;
            return $range;
        }
    }
?>