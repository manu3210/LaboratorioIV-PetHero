<?php
    $user = $_SESSION["user"];

    if(get_class($user) == "Models\Owner")
    {
          $redirect = "User/ShowOwnerHome/";
    }
    else
    {
          $redirect = "User/ShowKeeperHome/";
    }
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Editar perfil</h2>
               <hr>
               <form action="<?php echo FRONT_ROOT ?>User/EditUser" method="post" class="bg-dark-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                                   <label for="">Email</label>
                                   <input type="text" name="email" value="<?php echo $user->getEmail(); ?>" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Contraseña</label>
                                   <input type="password" name="password" value="<?php echo $user->getPassword(); ?>" class="form-control">
                              </div>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="firstName" value="<?php echo $user->getFirstName(); ?>" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Apellido</label>
                                   <input type="text" name="lastName" value="<?php echo $user->getLastName(); ?>" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Telefono</label>
                                   <input type="text" name="phone" value="<?php echo $user->getPhone(); ?>" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Direccion</label>
                                   <input type="text" name="adress" value="<?php echo $user->getAdress(); ?>" class="form-control" required>
                              </div>
                         </div>
                    </div>
                    <button type="submit" class="btn btn-primary ml-auto">Confirmar</button>
                    <a href="<?php echo FRONT_ROOT?><?php echo $redirect?>"class="btn btn-primary me-md-2" type="button">Volver</a>
               </form>
          </div>
     </section>
</main>