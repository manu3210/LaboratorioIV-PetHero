<?php 
    $user = $_SESSION["user"];
    require_once('nav.php');
?>

<main class="d-flex align-items-center" >
    <div class="container mt-5">
        <div class="row justify-content-center" style=" height:30rem; ">
            <div class="col-sm-16">
                <p style="color: red; text-align: center"><?php if(isset($_SESSION["paramError"])) { echo $_SESSION["paramError"]; $_SESSION["paramError"] = null;} ?></p>
                <div class="card border border-primary border-3" style="width: 50rem;">
                    <img src="https://i.pinimg.com/originals/d9/7b/bb/d97bbb08017ac2309307f0822e63d082.jpg" class="card-img-top w-25 rounded mx-auto d-block" alt="avatar">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user->getFirstName();?> <?php echo $user->getLastName();?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> Email: <?php echo $user->getEmail(); ?></li>
                        <li class="list-group-item"> Telefono: <?php echo $user->getPhone(); ?></li>
                        <li class="list-group-item"> Direccion: <?php echo $user->getAdress(); ?></li>
                        <li class="list-group-item"> Tamaño de mascota permitido: <?php echo $user->getPetSize(); ?></li>
                        <li class="list-group-item"> Precio por dia: <?php echo $user->getPrice(); ?></li>
                        <li class="list-group-item"> Disponible desde: <?php echo $user->getAvailabilityFrom(); ?></li>
                        <li class="list-group-item"> Disponible hasta: <?php echo $user->getAvailabilityTo(); ?></li>
                    </ul>
                    <div class="card-body">
                        <a href="<?php echo FRONT_ROOT ?>User/ShowEditAvailability" class="card-link">Cambiar parametros</a>
                        <a href="<?php echo FRONT_ROOT ?>Booking/ShowBookingList" class="card-link">Mis reservas</a>
                        <a href="<?php echo FRONT_ROOT ?>User/ShowEditProfile" class="card-link">Editar perfil</a>
                        <a href="<?php echo FRONT_ROOT ?>Review/ShowReviewList/<?php echo $user->getId(); ?>" class="card-link">Ver comentarios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>