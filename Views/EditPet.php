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
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Url foto de perfil</label>
                                   <input type="text" name="urlPhoto" value="<?php echo $pet->getUrlPhoto(); ?>" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Url video</label>
                                   <input type="text" name="urlVideo" value="<?php echo $pet->getUrlVideo(); ?>" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Url foto de plan de vacunacion</label>
                                   <input type="text" name="urlvaccination" value="<?php echo $pet->getUrlVaccination(); ?>" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Raza</label>
                                   <input type="text" name="breed" value="<?php echo $pet->getBreed(); ?>" class="form-control" required>
                              </div>
                         </div>
                         
                    </div>
                    <div class="row">
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Detalles adicionales</label>
                                   <textarea id="w3review" name="w3review" rows="4" cols="71"><?php echo $pet->getDetails(); ?></textarea>
                              </div>
                         </div>
                    </div>
                    <button type="submit" class="btn btn-primary ml-auto ">Agregar</button>
                    <a href="<?php echo FRONT_ROOT ?>User/ShowPetList/"class="btn btn-primary me-md-2" type="button">Volver</a>
               </form>
          </div>
     </section>
</main>