<?php
    namespace DAO;

    use Models\PetType as PetType;

    interface IPetTypeDAO
    {
        function AddPetType(PetType $petType);
    }
?>