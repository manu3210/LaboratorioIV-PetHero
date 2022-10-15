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
                         <th>tamaño</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($keeperList as $keeper)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $keeper->getName(); ?></td>
                                             <td><?php echo $keeper->getEmail(); ?></td>
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