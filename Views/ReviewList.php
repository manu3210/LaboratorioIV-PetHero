<?php
    require_once('nav.php');
    $score = $keeper->getScore();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="row justify-content-between">
                    <div class="col-6">
                         <h2 class="mb-4">Comentarios de <?php echo $keeper->getFirstName(); ?> <?php echo $keeper->getLastName(); ?></h2>
                         <h5 class="mb-4">Puntaje: <?php if ($score != null) { echo $score; } else { echo "puntuacion indefinida"; }?></h5>
                    </div>
               </div>
               <hr>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Fecha</th>
                         <th>Autor</th>
                         <th>Comentario</th>
                         <th>puntaje</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($reviewList as $review)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $review->getCreatedAt(); ?></td>
                                             <td><?php echo $review->getOwner()->getFirstName(); ?> <?php echo $review->getOwner()->getLastName(); ?></td>
                                             <td><?php echo $review->getDetails(); ?></td>
                                             <td><?php echo $review->getScore(); ?></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
               <div class="d-grid gap-2 d-md-flex justify-content-md-end">
               <?php if(get_class($_SESSION["user"]) == "Models\Owner")
               {?>
                    <a href="<?php echo FRONT_ROOT ?>Booking/ShowBookingList/"class="btn btn-primary me-md-2" type="button">Volver</a>
               <?php }
               else
               { ?>
                    <a href="<?php echo FRONT_ROOT ?>User/ShowKeeperHome/"class="btn btn-primary me-md-2" type="button">Volver</a>
               <?php } ?>
               </div>
          </div>
     </section>
</main>