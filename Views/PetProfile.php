<?php 
    require_once('nav.php');
?>

<main class="d-flex align-items-center" >
    <div class="container mt-5">
        <div class="row justify-content-center" style=" height:50rem; ">
            <div class="col-sm-16">
                <div class="card border border-primary border-3" style="width: 30rem;">
                    <img src="<?php echo $pet->getUrlPhoto() ?>" class="card-img-top w-250 rounded mx-auto d-block" alt="avatar">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pet->getName();?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> Tamaño: <?php echo $pet->getType(); ?></li>
                        <li class="list-group-item"> Raza: <?php echo $pet->getBreed(); ?></li>
                        <li class="list-group-item"> Detalles: <?php echo $pet->getDetails(); ?></li>
                        <li class="list-group-item"> <iframe width="430" height="315" src="<?php echo $pet->getUrlVideo(); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></li>
                        <li class="list-group-item"><img src="<?php echo $pet->getUrlVaccination() ?>" class="card-img-top w-250 rounded mx-auto d-block" alt="avatar"></li>
                    </ul>
                    <div class="card-body">
                        <a href="<?php echo FRONT_ROOT ?>User/ShowPetList/" class="card-link">Volver</a>
                        <a href="<?php echo FRONT_ROOT ?>User/ShowEditPet/<?php echo $pet->getId(); ?>" class="card-link">Editar perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>