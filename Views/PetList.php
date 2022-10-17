<?php
    require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="row justify-content-between">
                    <div class="col-6">
                         <h2 class="mb-4">Mascotas</h2>
                    </div>
               </div>
               <hr>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Raza</th>
                         <th>tamaño</th>
                         <th></th>
                         <th></th>
                         <th></th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($petList as $pet)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $pet->getName(); ?></td>
                                             <td><?php echo $pet->getBreed(); ?></td>
                                             <td><?php echo $pet->getType(); ?></td>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>User/ShowEditPet/<?php echo $pet->getId(); ?>"><i class="far fa-edit text-dark"></i></a></td>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>User/ShowPetProfile/<?php echo $pet->getId(); ?>"><i class="fas fa-file-alt"></i></a></td>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>User/DeletePet/<?php echo $pet->getId(); ?>"><i class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
               <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?php echo FRONT_ROOT ?>User/ShowOwnerHome/"class="btn btn-primary me-md-2" type="button">Volver</a>
               </div>
          </div>
     </section>
</main>


<a href="<?php echo FRONT_ROOT ?>User/ShowAddPet"><h1>Agregar mascota</h1></a>