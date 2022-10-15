<?php
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Edicion de mascota</h2>
               <hr>
               <form action="<?php echo FRONT_ROOT ?>User/EditPet" method="post" class="bg-dark-alpha p-5">
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="hidden" name="id" value="<?php echo $pet->getId(); ?>">
                                   <input type="text" name="name" value="<?php echo $pet->getName(); ?>" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Tipo</label>
                                   <input type="text" name="type" value="<?php echo $pet->getType(); ?>" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>