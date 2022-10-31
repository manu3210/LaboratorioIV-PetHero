<?php
    namespace Controllers;
    use DAO\ReviewDao as ReviewDao;
    use DAO\KeeperDao as KeeperDao;
    use DAO\BookingDao as BookingDao;
    use Models\Review as Review;
    use Models\Keeper as Keeper;
    use Models\Booking as Booking;
    use DateTime;

    class ReviewController
    {
        private $reviewDao;
        private $keeperDao;
        private $bookingDao;

        public function __construct()
        {
            $this->reviewDao = new ReviewDao();
            $this->keeperDao = new KeeperDao();
            $this->bookingDao = new BookingDao();
        }

        public function ShowAddReview($keeperId, $bookingId)
        {
            $keeper = $this->keeperDao->GetById($keeperId);
            require_once(VIEWS_PATH."AddReview.php");
        }  
        
        public function ShowReviewList($keeperId)
        {
            $keeper = $this->keeperDao->GetById($keeperId);
            $reviewList = $this->reviewDao->GetKeeperReviews($keeperId);
            require_once(VIEWS_PATH."reviewList.php");
        }   
        
        public function AddReview($score, $details, $keeperId, $bookingId)
        {
            $keeper = $this->keeperDao->GetById($keeperId);
            $booking = $this->bookingDao->GetById($bookingId);

            if($keeper->getScore() != 0)
            {
                $totalScore = round(($keeper->getScore() + $score) / 2);
            }
            else
            {
                $totalScore = $score;
            }
            
            $keeper->setScore($totalScore);
            $this->keeperDao->SetScore($keeper);

            $owner = $_SESSION["user"];

            $review = new Review();
            $review->setDetails($details);
            $review->setScore($score);
            $review->setKeeper($keeper);
            $review->setOwner($owner);
            $review->setCreatedAt(date("Y/m/d"));

            $lastId = $this->reviewDao->Add($review);

            $review = $this->reviewDao->GetById($lastId);

            $booking->setReview($review);
            $this->bookingDao->SetReview($booking);
            header("location:" .FRONT_ROOT . "Booking/ShowBookingList");
        }
    }
?>