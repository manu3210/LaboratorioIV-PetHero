<?php
    namespace Controllers;
    use Models\Booking as Booking;
    use Models\Pet as Pet;
    use DAO\BookingDao as BookingDao;
    use DAO\PetTypeDao as PetTypeDao;
    use DAO\KeeperDao as KeeperDao;
    use DAO\PetDao as PetDao;
    use \Datetime;
    use DateInterval;
    use Dateperiod;
    
    class BookingController
    {
        private $bookingDao;
        private $petTypeDao;
        private $keeperDao;
        private $petDao;


        public function __construct()
        {
            $this->bookingDao = new BookingDao();
            $this->petTypeDao = new PetTypeDao();
            $this->keeperDao = new KeeperDao();
            $this->petDao = new PetDao();
        }

        public function ShowBookingList()
        {
            if(get_class($_SESSION["user"]) == "Models\Owner")
            {
                $id = $_SESSION["user"]->getId();
                $bookingList = $this->bookingDao->GetByOwnerId($id);
            }
            else
            {
                $bookingList = $this->bookingDao->GetByKeeperId($_SESSION["user"]->getId());
            }
            require_once(VIEWS_PATH."BookingList.php");
        }

        public function ShowNewBooking()
        {
            $petList = $this->petDao->GetPetsByUserId($_SESSION["user"]->getId());
            require_once(VIEWS_PATH."NewBooking.php");
        }

        public function ShowAddBooking($keeperId, $from, $to, $petId)
        {
            $pet = $this->petDao->GetById($petId);
            $keeper = $this->keeperDao->GetById($keeperId);
            $owner = $_SESSION["user"];
            $booking = new Booking();
            $booking->setDateFrom($from);
            $booking->setDateTo($to);
            $booking->setPet($pet);
            $booking->setOwner($_SESSION["user"]);
            $booking->setKeeper($keeper);
            $booking->setIsConfirmed(false);
            $booking->setIsPaid(false);
            $dateTo = new DateTime($to);
            $dateFrom = new DateTime($from);
            $interval = date_diff($dateTo, $dateFrom);
            $daysQty = $interval->d;
            $price = $daysQty * $keeper->getPrice();
            $booking->setPrice($price);

            $_SESSION["booking"] = $booking;

            require_once(VIEWS_PATH."AddBooking.php");
        }

        public function ShowBookingDetails($id)
        {
            $booking = $this->bookingDao->GetById($id);
            $keeper = $booking->getKeeper();
            $owner = $booking->getOwner();
            $pet = $booking->getPet();
            require_once(VIEWS_PATH."BookingDetails.php");
        }


        /*************************************** POST ***************************************************/

        public function AddBooking()
        {
            $booking =  $_SESSION["booking"];
            $this->bookingDao->Add($booking);
            header("location:" .FRONT_ROOT . "Booking/ShowBookingList");
        }

        public function GetAvailableKeepers($from, $to, $petId)
        {
            $keeperList = $this->keeperDao->GetAll();
            $pet = $this->petDao->getById($petId);
            $size = $pet->getType();
            $index = 0;

            foreach($keeperList as $keeper)
            {
                if($keeper->getPetSize() != $size)
                {
                    unset($keeperList[$index]);
                }
                $index++;
            }

            $ownerDays = $this->getRangeDate($from, $to, 'Y-m-d');
            $index = 0;

            foreach($keeperList as $keeper)
            {
                $keeperDays = array();
                foreach($keeper->getDays() as $day)
                {
                    array_push($keeperDays, $day->getDateString());
                }

                foreach($ownerDays as $day)
                {
                    if(!in_array($day, $keeperDays))
                    {
                        unset($keeperList[$index]);
                        break;
                    }
                }
                $index++;
            }

            $index = 0;
            foreach($keeperList as $keeper)
            {
                foreach($ownerDays as $day)
                {
                    foreach($keeper->getDays() as $keeperDay)
                    {
                        if($keeperDay->getDateString() == $day && $keeperDay->getIsAvailable() != 1)
                        {
                            unset($keeperList[$index]);
                        }
                    }
                }
                $index++;
            }

            require_once(VIEWS_PATH."KeeperList.php");
        }

        public function ConfirmBooking($id)
        {
            $booking = $this->bookingDao->GetById($id);
            $keeperId =  $_SESSION["user"]->getId();
            $keeper = $this->keeperDao->GetById($keeperId);
            $keeperDays = $keeper->getDays();

            $bookingDays = $this->getRangeDate($booking->getDateFrom(), $booking->getDateTo(), 'Y-m-d');

            foreach($bookingDays as $bDay)
            {
                foreach($keeperDays as $kDay)
                {
                    if($bDay == $kDay->getDateString())
                    {
                        $kDay->setIsAvailable(0);
                    }
                }
            }

            foreach($keeperDays as $day)
            {
                if($day->getIsAvailable() == 1)
                    {
                        $day->setIsAvailable(1);
                    }
            }
            

            $this->keeperDao->UpdateDays($keeperDays);

            $booking->setIsConfirmed(true);
            $this->bookingDao->UpdateConfirmation($booking);
            $this->ShowBookingDetails($id);
        }

        public function PayBooking($id)
        {
            $booking = $this->bookingDao->GetById($id);
            $booking->setIsPaid(true);
            $this->bookingDao->UpdateConfirmation($booking);
            $this->ShowBookingDetails($id);
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