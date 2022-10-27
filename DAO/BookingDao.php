<?php
    namespace DAO;

    use Models\Booking as Booking;
    use Models\Pet as Pet;
    use Models\Owner as Owner;
    use Models\Keeper as Keeper;

    class BookingDao implements IBookingDao
    {
        private $connection;
        private $tableName = "booking";

        public function Add($booking)
        {
            try
            {
                $query  = "INSERT INTO " . $this->tableName . "(dateFrom, dateTo, petId, ownerId, keeperId, price, isConfirmed, isHalfPaid ) VALUES (:dateFrom, :dateTo, :petId, :ownerId, :keeperId, :price, :isConfirmed, :isHalfPaid);";
                $parameters["dateFrom"] = $booking->getDateFrom();
                $parameters["dateTo"] = $booking->getDateTo();
                $parameters["petId"] = $booking->getPet()->getId();
                $parameters["ownerId"] = $booking->getOwner()->getId();
                $parameters["keeperId"] = $booking->getKeeper()->getId();
                $parameters["price"] = $booking->getPrice();
                $parameters["isConfirmed"] = $booking->getIsConfirmed();
                $parameters["isHalfPaid"] = $booking->getIsPaid() == false ? 0 : 1;
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
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
                $query = "SELECT b.bookingId, b.dateFrom, b.dateTo, b.price, b.isConfirmed, b.isHalfPaid, b.isTotalPaid, p.petName, p.breed, p.petId, p.urlPhoto, o.firstName, o.lastName, o.phone, o.email, k.firstName as kFirstName, k.lastName as kLastName, k.phone as kPhone, k.adress as kAdress, k.email as kEmail, k.price as kPrice FROM "
                . $this->tableName . " b"
                ." JOIN pets p ON p.petId = b.petId"
                ." JOIN owners o ON o.ownerId = b.ownerId"
                ." JOIN keepers k ON k.keeperId = b.keeperId"
                ." WHERE b.bookingId = " .$id . ";";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                
                foreach ($result as $row)
                {                
                    $booking = new Booking();
                    $booking->setId($row["bookingId"]);
                    $booking->setDateFrom($row["dateFrom"]);
                    $booking->setDateTo($row["dateTo"]);
                    $value = ($row["isConfirmed"] == 1) ? "Confirmada" : "Pendiente";
                    $booking->setIsConfirmed($value);
                    $booking->setIsPaid($row["isTotalPaid"]);
                    $booking->setPrice($row["price"]);

                    $pet = new Pet();
                    $pet->setName($row["petName"]);
                    $pet->setBreed($row["breed"]);
                    $pet->setId($row["petId"]);
                    $pet->setUrlPhoto($row["urlPhoto"]);
                    $booking->setPet($pet);

                    $owner = new Owner();
                    $owner->setFirstName($row["firstName"]);
                    $owner->setLastName($row["lastName"]);
                    $owner->setPhone($row["phone"]);
                    $owner->setEmail($row["email"]);
                    $booking->setOwner($owner);

                    $keeper = new Keeper();
                    $keeper->setFirstName($row["kFirstName"]);
                    $keeper->setLastName($row["kLastName"]);
                    $keeper->setPhone($row["kPhone"]);
                    $keeper->setEmail($row["kEmail"]);
                    $keeper->setAdress($row["kAdress"]);
                    $keeper->setPrice($row["kPrice"]);
                    $booking->setKeeper($keeper);

                }
                return $booking;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByOwnerId($id)
        {
            try
            {
                $bookingList = array();
                $query = "SELECT b.bookingId, b.dateFrom, b.dateTo, b.price, b.isConfirmed, b.isHalfPaid, b.isTotalPaid, p.petName, p.breed, p.petId, o.firstName, o.lastName, o.phone, o.email, k.firstName as kFirstName, k.lastName as kLastName, k.phone as kPhone, k.adress, k.email as kEmail FROM "
                . $this->tableName . " b"
                ." JOIN pets p ON p.petId = b.petId"
                ." JOIN owners o ON o.ownerId = b.ownerId"
                ." JOIN keepers k ON k.keeperId = b.keeperId"
                ." WHERE b.ownerId = " .$id . ";";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                
                foreach ($result as $row)
                {                
                    $booking = new Booking();
                    $booking->setId($row["bookingId"]);
                    $booking->setDateFrom($row["dateFrom"]);
                    $booking->setDateTo($row["dateTo"]);
                    $value = ($row["isConfirmed"] == 1) ? "Confirmada" : "Pendiente";
                    $booking->setIsConfirmed($value);
                    $booking->setIsPaid($row["isTotalPaid"]);
                    $booking->setPrice($row["price"]);

                    $pet = new Pet();
                    $pet->setName($row["petName"]);
                    $pet->setBreed($row["breed"]);
                    $pet->setId($row["petId"]);
                    $booking->setPet($pet);

                    $owner = new Owner();
                    $owner->setFirstName($row["firstName"]);
                    $owner->setLastName($row["lastName"]);
                    $owner->setPhone($row["phone"]);
                    $owner->setEmail($row["email"]);
                    $booking->setOwner($owner);

                    $keeper = new Keeper();
                    $keeper->setFirstName($row["kFirstName"]);
                    $keeper->setLastName($row["kLastName"]);
                    $keeper->setPhone($row["kPhone"]);
                    $keeper->setEmail($row["kEmail"]);
                    $booking->setKeeper($keeper);

                    array_push($bookingList, $booking);
                }
                return $bookingList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByKeeperId($id)
        {
            try
            {
                $bookingList = array();
                $query = "SELECT b.bookingId, b.dateFrom, b.dateTo, b.price, b.isConfirmed, b.isHalfPaid, b.isTotalPaid, p.petName, p.breed, p.petId, o.firstName, o.lastName, o.phone, o.email, k.firstName, k.lastName, k.phone, k.adress, k.email FROM "
                .$this->tableName 
                ." JOIN pets p ON p.petId = b.petId"
                ." JOIN owners o ON o.ownerId = b.ownerId"
                ." JOIN keepers k ON k.keeperId = b.keeperId"
                ." WHERE b.keeperId = " .$id . ";";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                
                foreach ($result as $row)
                {                
                    $booking = new Booking();
                    $booking->setId($row["bookingId"]);
                    $booking->setDateFrom($row["dateFrom"]);
                    $booking->setDateTo($row["dateTo"]);
                    $booking->setIsConfirmed($row["isConfirmed"]);
                    $booking->setIsPaid($row["isPaid"]);
                    $booking->setPrice($row["price"]);

                    $pet = new Pet();
                    $pet->setName($row["petName"]);
                    $pet->setBreed($row["breed"]);
                    $pet->setId($row["petId"]);
                    $booking->setPet($pet);

                    $owner = new Owner();
                    $owner->setFirstName($row["o.firstName"]);
                    $owner->setLastName($row["o.lastName"]);
                    $owner->setPhone($row["o.phone"]);
                    $owner->setEmail($row["o.email"]);
                    $booking->setOwner($owner);

                    $keeper = new Keeper();
                    $keeper->setFirstName($row["k.firstName"]);
                    $keeper->setLastName($row["k.lastName"]);
                    $keeper->setPhone($row["k.phone"]);
                    $keeper->setEmail($row["k.email"]);
                    $booking->setKeeper($keeper);

                    array_push($bookingList, $booking);
                }
                return $bookingList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        
    }
?>