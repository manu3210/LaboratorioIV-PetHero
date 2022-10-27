<?php
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Seleccione la fecha y el tipo de mascota</h2>
               <hr>
               <form action="<?php echo FRONT_ROOT ?>Booking/GetAvailableKeepers" method="post" class="bg-dark-alpha p-5">
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Desde</label>
                                   <input type="date" name="from" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Hasta</label>
                                   <input type="date" name="to" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-lg-4" style="margin-top: 35px">
                              <div class="form-group">
                                   <label for="">Tipo</label>
                                   <select name="type">
                                        <?php foreach($petList as $pet){ ?>
                                             <option value="<?php echo $pet->getId(); ?>"><?php echo $pet->getName(); ?> - <?php echo $pet->getBreed(); ?></option>
                                        <?php } ?>
                                   </select>
                              </div>
                         </div>
                    </div>
                    <button type="submit" class="btn btn-primary ml-auto " >Confirmar</button>
                    <a href="<?php echo FRONT_ROOT ?>User/ShowBookingList/"class="btn btn-primary me-md-2" type="button">Volver</a>
               </form>
          </div>
     </section>
</main>