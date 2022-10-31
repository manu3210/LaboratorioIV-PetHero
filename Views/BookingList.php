<?php
    require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <div class="row justify-content-between">
                    <div class="col-6">
                         <h2 class="mb-4">RESERVAS</h2>
                    </div>
               </div>
               <hr>
               <table class="table bg-dark-alpha">
                    <thead>
                         <th>Dueño de mascota</th>
                         <th>Cuidador de mascota</th>
                         <th>Desde</th>
                         <th>Hasta</th>
                         <th>Precio</th>
                         <th>Estado</th>
                         <th>Detalles</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($bookingList as $booking)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $booking->getOwner()->getFirstName() ?> <?php echo $booking->getOwner()->getLastName(); ?></td>
                                             <td><?php echo $booking->getKeeper()->getFirstName() ?> <?php echo $booking->getKeeper()->getLastName(); ?></td>
                                             <td><?php echo $booking->getDateFrom(); ?></td>
                                             <td><?php echo $booking->getDateTo(); ?></td>
                                             <td><?php echo $booking->getPrice(); ?></td>
                                             <td><?php echo $booking->getIsConfirmed(); ?></td>
                                             <td style="text-align: center;"><a href="<?php echo FRONT_ROOT ?>Booking/ShowBookingDetails/<?php echo $booking->getId(); ?>"><i class="fas fa-file-alt"></i></a></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
               <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <?php if(get_class($_SESSION["user"]) == "Models\Owner")
                    { ?>
                         <a href="<?php echo FRONT_ROOT ?>User/ShowOwnerHome/"class="btn btn-primary me-md-2" type="button">Volver</a>
                         <a href="<?php echo FRONT_ROOT ?>Booking/ShowNewBooking"class="btn btn-primary me-md-2" type="button">Generar Reserva</a>
                    <?php } 
                    else
                    {?>
                         <a href="<?php echo FRONT_ROOT ?>User/ShowKeeperHome/"class="btn btn-primary me-md-2" type="button">Volver</a>
                    <?php }
                    require_once(VIEWS_PATH."BookingList.php");?>
               </div>
          </div>
     </section>
</main>

