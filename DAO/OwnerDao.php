<?php
    namespace DAO;

    use DAO\IOwnerDAO as IOwnerDAO;
    use Models\Owner as Owner;
    use Models\Pet as Pet;
    use Models\User as User;
    use DAO\Connection as Connection;

    class OwnerDAO implements IOwnerDAO
    {
        private $ownerList;
        private $connection;
        private $tableName = "owners";

        public function Add(Owner $owner)
        {
            try
            {
                $query  = "INSERT INTO " . $this->tableName . "(email, pass, firstName, lastName, phone, adress) VALUES (:email, :pass, :firstName, :lastName, :phone, :adress);";
                $parameters["email"] = $owner->getEmail();
                $parameters["pass"] = $owner->getPassword();
                $parameters["firstName"] = $owner->getFirstName();
                $parameters["lastName"] = $owner->getLastName();
                $parameters["phone"] = $owner->getPhone();
                $parameters["adress"] = $owner->getAdress();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function EditUser(User $user)
        {
            try
            {
                $query  = "UPDATE " . $this->tableName 
                . " SET email='" . $user->getEmail() 
                . "', pass = '". $user->getPassword() 
                . "', firstName = '". $user->getFirstName() 
                . "', lastName = '". $user->getLastName() 
                . "', phone = '". $user->getPhone() 
                . "', adress = '". $user->getAdress() 
                ."' where ownerId = " . $user->getId();
                
                $this->connection  = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $e)
            {
                throw $e;
            }
        }

        public function GetAll()
        {
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);
                
                foreach ($result as $row)
                {                
                    $user = new Owner();
                    $user->setId($row["ownerId"]);
                    $user->setEmail($row["email"]);
                    $user->setFirstName($row["firstName"]);
                    $user->setLastName($row["lastName"]);
                    $user->setPhone($row["phone"]);
                    $user->setAdress($row["adress"]);
                    $user->setPassword($row["pass"]);
                    $user->setIsAdmin($row["isAdmin"]);

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>