<?php
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Comentario a <?php echo $keeper->getFirstName() ?> <?php echo $keeper->getLastName() ?></h2>
               <hr>
               <form action="<?php echo FRONT_ROOT ?>Review/AddReview" method="post" class="bg-dark-alpha p-5">
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                <fieldset>
                                    <legend>Seleccione un puntaje</legend>
                                    <div>
                                    <input type="radio" name="score" value="1" checked>
                                    <label for="huey">1</label>
                                    <input type="radio" name="score" value="2">
                                    <label for="dewey">2</label>
                                    <input type="radio" name="score" value="3">
                                    <label for="louie">3</label>
                                    <input type="radio" name="score" value="4">
                                    <label for="louie">4</label>
                                    <input type="radio" name="score" value="5">
                                    <label for="louie">5</label>
                                    <input type="radio" name="score" value="6">
                                    <label for="louie">6</label>
                                    <input type="radio" name="score" value="7">
                                    <label for="louie">7</label>
                                    <input type="radio" name="score" value="8">
                                    <label for="louie">8</label>
                                    <input type="radio" name="score" value="9">
                                    <label for="louie">9</label>
                                    <input type="radio" name="score" value="10">
                                    <label for="louie">10</label>
                                    </div>
                                </fieldset>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Comentarios</label>
                                   <textarea name="details" rows="4" cols="71"></textarea>
                              </div>
                         </div>
                         <input type="hidden" name="keeperId" value="<?php echo $keeper->getId(); ?>">
                         <input type="hidden" name="bookingId" value="<?php echo $bookingId ?>">
                    </div>
                    <button type="submit" class="btn btn-primary ml-auto " >Agregar</button>
                    <a href="<?php echo FRONT_ROOT ?>User/ShowOwnerHome/"class="btn btn-primary me-md-2" type="button">Volver</a>
               </form>
          </div>
     </section>
</main>