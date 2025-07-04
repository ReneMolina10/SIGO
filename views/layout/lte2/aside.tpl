  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="#" class="d-block p-1 text-center text-light border-bottom">
      <h4 class="brand-text font-weight-bold m-0"></h4>
      <span class="text-light">{$_layoutParams.configs.app_name_short|default:""}</span>
    </a>
    <!--  <img src="{$_layoutParams.ruta_view}dist/img/AdminLTELogo.png" alt="Logo" class="brand-image"
           style="opacity: .8">  {$_layoutParams.configs.app_name} -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 mb-3 d-flex">
        <style>
          #edit-profile {
            opacity: 0;
          }

          #name-profile:hover~#edit-profile {
            opacity: 1;
          }

          #img-profile:hover~#edit-profile {
            opacity: 1;
          }
        </style>
        <a id="img-profile" class="image">
          <img src="https://sigo.uqroo.mx/public/img/index/logoblanco.png"
            style="filter: brightness(0) invert(1);"
            >
        </a>      
        <div id="name-profile" class="info text-light">
          <p>{$_layoutParams.nombre} <br/>{$_layoutParams.email}</p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat" data-widget="treeview" role="menu"
          data-accordion="false">

          <li class="nav-item d-none">
            <a href="#" class="nav-link ">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Opciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{$_layoutParams.root}usr/" class="nav-link ">
                  <i class="far fa-dot-circle  nav-icon"></i>
                  <p>Usr generator</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item d-none">
            <a href="{$_layoutParams.root}test_generator/" class="nav-link ">
              <i class="far fa-dot-circle  nav-icon"></i>
              <p>Test generator</p>
            </a>
          </li>

          {*DIFERENTES VISTAS DEPENDIENDO DEL ROL DEL USUARIO*}

          {*ROL = 1 -> SUPER USUARIO / ROOT*}

          {*ROL = 2 -> OPERADOR*}

          {*ROL = 0 -> INVITADO / NO ESTA REGISTRADO*}

          <li class="nav-item">
            <a href="{$_layoutParams.root}/" class="nav-link ">
              <i class="fa-solid fa-home nav-icon"></i>
              <p>Inicio</p>
            </a>
          </li>



<!--212519 color negro -->
          


          <li class="nav-item">
          <a href="" class="nav-link">
            <i class="fa-solid fa-copy nav-icon"></i>
            <p>Minutas</p>
          </a>
          <ul class="nav nav-treeview" style="background-color: #2c3b4d; border-radius: 6px; margin: 6px 0 6px 8px; padding: 6px;">
            <li class="nav-item">
              <a class="nav-link text-light" style="padding-left: 32px;" href="{$_layoutParams.root}minutas">
                <i class="fa-regular fa-file-lines nav-icon"></i>
                Minutas
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-light" style="padding-left: 32px;" href="{$_layoutParams.root}minu_asunto">
                <i class="fa-regular fa-comment-dots nav-icon"></i>
                Asuntos
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-light" style="padding-left: 32px;" href="{$_layoutParams.root}minu_acuerdo">
                <i class="fa-regular fa-handshake nav-icon"></i>
                Acuerdos
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-light" style="padding-left: 32px;" href="{$_layoutParams.root}minu_mejoras">
                <i class="fa-regular fa-lightbulb nav-icon"></i>
                Mejoras
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-light" style="padding-left: 32px;" href="{$_layoutParams.root}minu_firmantes">
                <i class="fa-regular fa-pen-to-square nav-icon"></i>
                Firmantes
              </a>
            </li>
            
          </ul>
        </li>





          <!-- 
          <li class="nav-item">
            <a href="{$_layoutParams.root}solicitudes/" class="nav-link ">
              <i class="fa-solid fa-envelopes-bulk nav-icon"></i>
              <p>Mis Solicitudes</p>
            </a>
          </li>

          {if $_layoutParams.infousr.idrole == 1 || $_layoutParams.infousr.idrole == 2}
            <li class="nav-item">
              <a href="{$_layoutParams.root}panel/" class="nav-link ">
                <i class="fa-solid fa-envelope-open-text  nav-icon"></i>
                <p>Panel de solicitudes</p>
              </a>
            </li>

            {if $_layoutParams.infousr.idrole == 1 || $_layoutParams.infousr.usuario == "argos"}

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-list"></i>
                  <p>
                    Catálogos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="{$_layoutParams.root}espacios/" class="nav-link ">
                      <i class="fa-regular fa-building nav-icon"></i>
                      <p>Espacios</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{$_layoutParams.root}edificios/" class="nav-link ">
                      <i class="fa-regular fa-building nav-icon"></i>
                      <p>Edificios</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{$_layoutParams.root}areas/" class="nav-link ">
                      <i class="fa-regular fa-building nav-icon"></i>
                      <p>Áreas</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{$_layoutParams.root}servicios/" class="nav-link ">
                      <i class="fa-solid fa-layer-group nav-icon"></i>
                      <p>Servicios</p>
                    </a>
                  </li>

                  <li class="nav-item d-none">
                    <a href="{$_layoutParams.root}tutoriales/" class="nav-link ">
                      <i class="fa-solid fa-book-open-reader nav-icon"></i>
                      <p>Tutoriales</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="{$_layoutParams.root}reportes/" class="nav-link ">
                  <i class="fa-solid fa-chart-line nav-icon"></i>
                  <p>Reportes</p>
                </a>
              </li> 

           

              <li class="nav-item">
                <a href="{$_layoutParams.root}usr/" class="nav-link ">
                  <i class="fa-solid fa-key nav-icon"></i>
                  <p>Usuarios y permisos</p>
                </a>
              </li>
            {/if}



          {/if}

             {if $_layoutParams.infousr.idrole == 1 || $_layoutParams.infousr.usuario == "argos"}
             
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-list"></i>
                  <p>
                    Evaluaciones
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="{$_layoutParams.root}evaluaciones/" class="nav-link ">
                      <i class="bi bi-card-checklist"></i>
                      <p>Panel de evaluaciones</p>
                    </a>
                  </li>

                  <li class="nav-item d-none">
                    <a href="{$_layoutParams.root}tutoriales/" class="nav-link ">
                      <i class="fa-solid fa-book-open-reader nav-icon"></i>
                      <p>Tutoriales</p>
                    </a>
                  </li>

                -->
                </ul>
              </li>
            {/if}

          

        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>