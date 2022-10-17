<?php 

    namespace Models;

    class Pet
    {
        
        private $id;
        private $name;
        private $type;
        private $urlPhoto;
        private $urlVideo;
        private $urlvaccination;
        private $details;
        
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

        public function getUrlvaccination()
        {
            return $this->urlVideo;
        }

        public function setUrlvaccination($urlvaccination)
        {
            $this->urlvaccination = $urlvaccination;
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
    }
?>