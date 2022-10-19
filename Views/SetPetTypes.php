<?php
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar tipo de mascota</h2>
               <hr>
               <form action="<?php echo FRONT_ROOT ?>PetType/AddPetType" method="post" class="bg-dark-alpha p-5">
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Tamaño</label>
                                   <input type="text" name="size" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" class="btn btn-primary ml-auto " >Agregar</button>
                    <a href="<?php echo FRONT_ROOT ?>User/ShowOwnerHome/"class="btn btn-primary me-md-2" type="button">Volver</a>
               </form>
          </div>
     </section>
</main>