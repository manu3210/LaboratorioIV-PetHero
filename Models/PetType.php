<?php 

    namespace Models;

    class PetType
    {
        private $size;
        private $id;

        public function getSize()
        {
            return $this->size;
        }

        public function setSize($size)
        {
            $this->size = $size;
            return $this;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }
    }
?>