<?php 
    $user = $_SESSION["user"];
    require_once('nav.php');
?>

<main class="d-flex align-items-center" >
    <div class="container mt-5">
        <div class="row justify-content-center" style=" height:50rem; ">
            <div class="col-sm-16">
                <div class="card border border-primary border-3" style="width: 30rem;">
                    <img src="https://i.pinimg.com/originals/d9/7b/bb/d97bbb08017ac2309307f0822e63d082.jpg" class="card-img-top w-25 rounded mx-auto d-block" alt="avatar">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user->getName(); ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo $user->getEmail(); ?></li>
                    </ul>
                    <div class="card-body">
                        <a href="<?php echo FRONT_ROOT ?>Company/ShowKeeperList" class="card-link">Ver Keepers</a>
                        <a href="<?php echo FRONT_ROOT ?>User/ShowPetList" class="card-link">Mis mascotas</a>
                        <a href="<?php echo FRONT_ROOT ?>JobOffer/ShowJobOfferByCompany/<?php echo $user->getId(); ?>" class="card-link">Mis reservas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>