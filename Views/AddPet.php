<?php
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Registro</h2>
               <hr>
               <form action="<?php echo FRONT_ROOT ?>User/AddPet" method="post" class="bg-dark-alpha p-5">
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="name" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Raza</label>
                                   <input type="text" name="breed" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Url foto de perfil</label>
                                   <input type="text" name="urlPhoto" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Url video</label>
                                   <input type="text" name="urlVideo" value="" class="form-control">
                              </div>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Url foto de plan de vacunacion</label>
                                   <input type="text" name="urlvaccination" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4" style="margin-top: 35px">
                              <div class="form-group">
                                   <label for="">Tipo</label>
                                   <select name="cars" id="cars">
                                        <?php foreach($petTypeList as $petType){ ?>
                                             <option value="<?php echo $petType->getSize(); ?>"><?php echo $petType->getSize(); ?></option>
                                        <?php } ?>
                                   </select>
                              </div>
                         </div>
                         
                    </div>
                    <div class="row">
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Detalles adicionales</label>
                                   <textarea id="w3review" name="w3review" rows="4" cols="71"></textarea>
                              </div>
                         </div>
                    </div>
                    <button type="submit" class="btn btn-primary ml-auto " >Agregar</button>
                    <a href="<?php echo FRONT_ROOT ?>User/ShowPetList/"class="btn btn-primary me-md-2" type="button">Volver</a>
               </form>
          </div>
     </section>
</main>