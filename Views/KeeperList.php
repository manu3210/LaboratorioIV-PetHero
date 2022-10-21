<?php
    require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="row justify-content-between">
                    <div class="col-6">
                         <h2 class="mb-4">Keepers</h2>
                    </div>
               </div>
               <hr>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>Email</th>
                         <th>Tamaño de mascota maximo</th>
                         <th>Precio por dia</th>
                         <th>Disponible desde</th>
                         <th>Disponible hasta</th>
                         <th>Reservar</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($keeperList as $keeper)
                              {
                                   if($keeper->getAvailabilityFrom() != null){
                                   ?>
                                        <tr>
                                             <td><?php echo $keeper->getFirstName(); ?></td>
                                             <td><?php echo $keeper->getLastName(); ?></td>
                                             <td><?php echo $keeper->getEmail(); ?></td>
                                             <td><?php echo $keeper->getPetSize(); ?></td>
                                             <td><?php echo $keeper->getPrice(); ?></td>
                                             <td><?php echo $keeper->getAvailabilityFrom(); ?></td>
                                             <td><?php echo $keeper->getAvailabilityTo(); ?></td>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>#<?php echo $keeper->getId(); ?>"><i class="fas fa-business-time"></i></a></td>
                                        </tr>
                                   <?php
                              }}
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