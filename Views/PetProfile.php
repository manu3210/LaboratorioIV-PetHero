<?php 
    require_once('nav.php');
?>

<main class="d-flex align-items-center" >
    <div class="container mt-4">
        <div class="row justify-content-center" >
            <div class="col-sm-16">
                <div class="card border border-primary border-3" style="width: 50rem;">
                    <?php if($pet->getUrlPhoto() != ""){ ?>
                        <img src="<?php echo $pet->getUrlPhoto() ?>" class="card-img-top w-250 rounded mx-auto d-block" alt="avatar">
                    <?php }?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pet->getName();?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> Tamaño: <?php echo $pet->getType(); ?></li>
                        <li class="list-group-item"> Raza: <?php echo $pet->getBreed(); ?></li>
                        <li class="list-group-item"> Detalles: <?php echo $pet->getDetails(); ?></li>
                        <?php if($pet->getUrlVideo() != ""){ ?>
                            <li class="list-group-item"> <iframe width="750" height="315" src="<?php echo $pet->getUrlVideo(); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></li>
                        <?php }?>
                        <?php if($pet->getUrlVaccination() != ""){ ?>
                            <li class="list-group-item"><img src="<?php echo $pet->getUrlVaccination() ?>" class="card-img-top w-250 rounded mx-auto d-block" alt="avatar"></li>
                        <?php }?>
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