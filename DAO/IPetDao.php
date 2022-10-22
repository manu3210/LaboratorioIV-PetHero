<?php
    namespace DAO;

    use Models\Pet as Pet;

    interface IPetDAO
    {
        function GetPetsByUserId($id);
    }
?>