<?php
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Vas a reservar con</h2>
               <hr>
               <div class="card" style="width: 100%;">
                    <div class="card-header" style="font-weight: bold;">
                         <?php echo $keeper->getFirstName() ?> <?php echo $keeper->getLastName() ?>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email: <?php echo $keeper->getEmail() ?></li>
                    <li class="list-group-item">Telefono: <?php echo $keeper->getPhone() ?></li>
                    <li class="list-group-item">Direccion: <?php echo $keeper->getAdress() ?></li>
                    <li class="list-group-item">Precio por dia: <?php echo $keeper->getPrice() ?></li>
                    </ul>
               </div>
               <br>
               <h2 class="mb-4">Va a cuidar a</h2>
               <hr>
               <div class="card" style="width: 100%;">
                    <img src="<?php echo $pet->getUrlPhoto() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h3 class="card-title"><?php echo $pet->getName() ?></h3>
                    <p class="card-text"><?php echo $pet->getDetails() ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Tamaño: <?php echo $pet->getType() ?></li>
                    <li class="list-group-item">Raza: <?php echo $pet->getBreed() ?></li>
                    </ul>
               </div>
               <br>
               <h2 class="mb-4">Datos de la reserva</h2>
               <hr>
               <div class="card" style="width: 100%;">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Dueño de la mascota: <?php echo $owner->getFirstName() ?> <?php echo $owner->getLastName() ?></li>
                    <li class="list-group-item">Cuidador elegido: <?php echo $keeper->getFirstName() ?> <?php echo $keeper->getLastName() ?></li>
                    <li class="list-group-item">Fecha de inicio: <?php echo $booking->getDateFrom() ?></li>
                    <li class="list-group-item">Fecha de fin: <?php echo $booking->getDateTo() ?></li>
                    <li class="list-group-item">Cantidad de dias: <?php echo $daysQty ?></li>
                    <li class="list-group-item">Precio total: <?php echo $booking->getPrice() ?></li>
                    </ul>
               </div>

               <div class="d-grid gap-2 d-md-flex justify-content-md-end d-inline" >
                    <a href="<?php echo FRONT_ROOT ?>Booking/ShowBookingList/"class="btn btn-primary me-md-2" type="button">Volver</a>
                    <a href="<?php echo FRONT_ROOT ?>Booking/AddBooking/"class="btn btn-primary me-md-2" type="button">Confirmar</a>
               </div>
          </div>
     </section>
</main>