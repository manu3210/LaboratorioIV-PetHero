<?php
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Registro</h2>
               <hr>
               <form action="<?php echo FRONT_ROOT ?>User/EditAvailability" method="post" class="bg-dark-alpha p-5">
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Desde</label>
                                   <input type="hidden" name="id" value="<?php echo $_SESSION["user"]->getId(); ?>">
                                   <input type="date" name="availabilityFrom" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Hasta</label>
                                   <input type="date" name="availabilityTo" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Precio por dia</label>
                                   <input type="number" name="price" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4" style="margin-top: 35px">
                              <div class="form-group">
                                   <label for="">Tipo</label>
                                   <select name="type">
                                        <?php foreach($petTypeList as $petType){ ?>
                                             <option value="<?php echo $petType->getSize(); ?>"><?php echo $petType->getSize(); ?></option>
                                        <?php } ?>
                                   </select>
                              </div>
                         </div>
                    </div>
                    <button type="submit" class="btn btn-primary ml-auto " >Confirmar</button>
                    <a href="<?php echo FRONT_ROOT ?>User/ShowKeeperHome/"class="btn btn-primary me-md-2" type="button">Volver</a>
               </form>
          </div>
     </section>
</main>