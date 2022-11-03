<?php
     error_reporting(0);
     if(isset($_GET['payment_id']))
     {
          header("location:" .FRONT_ROOT . "Booking/PayBooking" . $booking->getId());
     }
     require_once('nav.php');
     require_once 'vendor/autoload.php';
     MercadoPago\SDK::setAccessToken('TEST-3389983883488298-041413-f52c7c3586029b5c5bc9bc33d8ab8532-14666069');
     $preference = new MercadoPago\Preference();
     
     $item = new MercadoPago\Item();
     $item->title = "Reserva keeper";
     $item->quantity = 1;
     $item->unit_price = $booking->getPrice() / 2;
     $item->currency_id = "ARS";
     $item->id = $booking->getId();
     
     $preference->items = array($item);
     
     $preference->back_urls = array(
          "success" => "http://localhost/LaboratorioIV-PetHero/Booking/PayBooking/?id=" . $item->id,
     );
     
     $preference->auto_return = "approved";
     $preference->save();
?>

<style> 
.disabled {
    cursor: not-allowed;
    pointer-events: none;
}
</style>
<script src="https://sdk.mercadopago.com/js/v2"></script>

<?php if($booking->getIsPaid() == false && $booking->getIsConfirmed() == "Confirmada")
{ ?>
     <script>
     const mp = new MercadoPago('TEST-1efc4489-e74c-4bac-ad21-e8b192c427e5', {
          locale: 'es-AR'
     });

     mp.checkout({
          preference:{
               id: '<?php echo $preference->id; ?>'
          },
          render: {
               container: '.checkout-btn',
               label: 'Pagar'
          }
     })
     </script>
<?php } ?>




<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos del cuidador</h2>
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
                    <li class="list-group-item"><a href="<?php echo FRONT_ROOT ?>Review/ShowReviewList/ <?php echo $keeper->getId(); ?>">Ver comentarios del Keeper</a> <?php if($booking->getReview()->getId() == null){ ?>| <a href="<?php echo FRONT_ROOT ?>Review/ShowAddReview/?keeperId=<?php echo $keeper->getId(); ?>&bookingId=<?php echo $booking->getId(); ?>">Escribir comentarios</a> <?php } ?></li>
                    </ul>
               </div>
               <br>
               <h2 class="mb-4">Datos de la mascota</h2>
               <hr>
               <div class="card" style="width: 100%;">
                    <img src="<?php echo $pet->getUrlPhoto() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h3 class="card-title"><?php echo $pet->getName() ?></h3>
                    <p class="card-text"><?php echo $pet->getDetails() ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Raza: <?php echo $pet->getBreed() ?></li>
                    </ul>
               </div>
               <br>
               <h2 class="mb-4">Datos de la reserva</h2>
               <hr>
               <div class="card" style="width: 100%;">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Estado de la reserva: <?php echo $booking->getIsConfirmed() ?></li>
                    <li class="list-group-item">Estado del pago: 
                         <?php 
                              if ( $booking->getisPaid() == 1) 
                              {
                                   echo "Pagado";
                              }
                              else
                              {
                                   echo "Impago";
                              }   
                         ?>
                    </li>
                    <li class="list-group-item">Dueño de la mascota: <?php echo $owner->getFirstName() ?> <?php echo $owner->getLastName() ?></li>
                    <li class="list-group-item">Cuidador elegido: <?php echo $keeper->getFirstName() ?> <?php echo $keeper->getLastName() ?></li>
                    <li class="list-group-item">Fecha de inicio: <?php echo $booking->getDateFrom() ?></li>
                    <li class="list-group-item">Fecha de fin: <?php echo $booking->getDateTo() ?></li>
                    <li class="list-group-item">Precio total: <?php echo $booking->getPrice() ?></li>
                    </ul>
               </div>

               <div class="d-grid gap-2 d-md-flex justify-content-md-end d-inline" >
                    <a href="<?php echo FRONT_ROOT ?>Booking/ShowBookingList/"class="btn btn-primary me-md-2" type="button">Volver</a>
                    <?php 
                         if(get_class($_SESSION["user"]) == "Models\Owner")
                         { ?>
                              <div class="checkout-btn"></div>
                         <?php } 
                         else
                         {
                              if($booking->getIsConfirmed() == "Confirmada")
                              { ?>
                                   <a href="<?php echo FRONT_ROOT ?>Booking/ShowBookingList/"class="btn btn-secondary me-md-2 disabled"  type="button">Confirmar</a>
                         <?php } ?>
                         <?php 
                              if($booking->getIsConfirmed() == "Pendiente")
                              { ?>
                                   <a href="<?php echo FRONT_ROOT ?>Booking/DeclineBooking/<?php echo $booking->getId(); ?>"class="btn btn-danger me-md-2" type="button">Rechazar</a>
                                   <a href="<?php echo FRONT_ROOT ?>Booking/ConfirmBooking/<?php echo $booking->getId(); ?>"class="btn btn-success me-md-2" type="button">Confirmar</a>
                         <?php }
                         }
                         ?>
               </div>
          </div>
     </section>
</main>