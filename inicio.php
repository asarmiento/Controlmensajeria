<div class="titulo"></div>

<!-- AQU�? CREAMOS EL MENU DE LA PAGINA DE INICIO -->

<div class="menu-inicio">

	<?php if ($this->session->userdata('cargo') == 'Administrador'): ?>

        
        <a href="inicio/CicloEmpresas"><li><img src="asset/img/ver-clientes.png"><br>Clientes</li></a>
        <a href="empleados"><li><img src="asset/img/mensajeros.png">Mensajeros</li></a>
        <li><img src="asset/img/reportes.png">Reportes</li>
        <a href="usuario/listauser"><li><img src="asset/img/usuarios.png">Usuarios</li></a>
        <a href="usuario/cpass"><li><img src="asset/img/contrasena.png"><br>Cambiar<br>Contrase&ntilde;a</li></a>

    
            <!-- ********************************************
                            Menú para Editores 
            *************************************************-->


		<?php elseif ($this->session->userdata('cargo') == 'Editores'): ?>
        <a href="inicio/CicloEmpresas"><li><img src="asset/img/ver-clientes.png"><br>Clientes</li></a>
           <li><img src="asset/img/reportes.png">Reportes</li>
        <a href="usuario/cpass"><li><img src="asset/img/contrasena.png"><br>Cambiar<br>Contrase&ntilde;a</li></a>
   
            <!-- ********************************************
                            Menú para Clientes 
            *************************************************-->
		<?php elseif ($this->session->userdata('cargo') == 'Cliente1'): ?>
        <a href="claro/createCiclo"><li><img src="asset/img/productos.png">Productos</li></a>
        <a href="claro/view_mnt"><li><img src="asset/img/ciclo-actual.png"><br>Ciclo Actual</li></a>
        <a href="claro/ciclomes"><li><img src="asset/img/ciclos-mes.png"><br>Ver ciclos por Mes</li></a>
        <a href=""><li><img src="asset/img/reportes.png">Reportes</li></a>
        <a href="usuario/cpass"><li><img src="asset/img/contrasena.png"><br>Cambiar<br>Contrase&ntilde;a</li></a> 
        <?php elseif ($this->session->userdata('cargo') == 'Cliente2'): ?>
        <a href="claro/view_mnt"><li><img src="asset/img/ciclo-actual.png"><br>Ciclo Actual</li></a>
        <a href="usuario/cpass"><li><img src="asset/img/contrasena.png"><br>Cambiar<br>Contrase&ntilde;a</li></a> 
        <?php elseif ($this->session->userdata('cargo') == 'Cliente3'): ?>
        <a href="claro/view_mnt"><li><img src="asset/img/ciclo-actual.png"><br>Ciclo Actual</li></a>
        <a href="usuario/cpass"><li><img src="asset/img/contrasena.png"><br>Cambiar<br>Contrase&ntilde;a</li></a> 
        <?php endif; ?>

    </div>