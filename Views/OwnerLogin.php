<?php
     
?>

<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <h2 style="text-align:center">Ingreso de Owner</h2>
          <p style="color:red; text-align:center"><?php if(isset($_SESSION["loginError"])){ echo $_SESSION["loginError"]; $_SESSION["loginError"] = null;} ?></p>
          <form action="<?php echo FRONT_ROOT ?>User/OwnerLogin" method="post" class="login-form bg-dark-alpha p-5 text-white">
               <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" name="email" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
               </div>
               <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
               </div>
               <button class="btn btn-dark btn-block btn-lg" type="submit">Iniciar Sesión</button>
               <br>
               <div>
               <a href="<?php echo FRONT_ROOT ?>User/ShowKeeperLogin" >Click aca para ingresar como Keeper</a>
               </div>
               <div>
               <a href="<?php echo FRONT_ROOT ?>User/ShowSignUp" >Click aca para registrarse</a>
               </div>
               <div style="color: red; text-align:center;">
                    <?php if(isset($_SESSION["msj"])){echo $_SESSION["msj"];session_destroy();} ?>
               </div>
          </form>
     </div>
</main>