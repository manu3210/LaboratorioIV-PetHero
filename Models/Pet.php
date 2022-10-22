<?php 

    namespace Models;

    class Pet
    {
        
        private $id;
        private $name;
        private $type;
        private $urlPhoto;
        private $urlVideo;
        private $urlVaccination;
        private $details;
        private $breed;
        private $owner;
        
        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        public function getType()
        {
            return $this->type;
        }

        public function setType($type)
        {
            $this->type = $type;
            return $this;
        }

        public function getUrlPhoto()
        {
            return $this->urlPhoto;
        }

        public function setUrlPhoto($urlPhoto)
        {
            $this->urlPhoto = $urlPhoto;
            return $this;
        }

        public function getUrlVideo()
        {
            return $this->urlVideo;
        }

        public function setUrlVideo($urlVideo)
        {
            $this->urlVideo = $urlVideo;
            return $this;
        }

        public function getUrlVaccination()
        {
            return $this->urlVaccination;
        }

        public function setUrlVaccination($urlVaccination)
        {
            $this->urlVaccination = $urlVaccination;
            return $this;
        }

        public function getDetails()
        {
            return $this->details;
        }

        public function setDetails($details)
        {
            $this->details = $details;
            return $this;
        }

        public function getBreed()
        {
            return $this->breed;
        }

        public function setbreed($breed)
        {
            $this->breed = $breed;
            return $this;
        }

        public function getOwner()
        {
            return $this->owner;
        }

        public function setOwner($owner)
        {
            $this->owner = $owner;
            return $this;
        }
    }
?>