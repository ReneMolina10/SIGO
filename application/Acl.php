<?php

class ACL
{
    private $_registry;
    private $_db;
    private $_id;
    private $_role;
    private $_permisos;

    public function __construct($id = false)
    {
        if ($id) {
            $this->_id = (int)$id;
        } else {
            if (Session::get('id_usuario' . BASE_SESION)) {
                $this->_id = is_numeric(Session::get('id_usuario' . BASE_SESION)) ? (int)Session::get('id_usuario' . BASE_SESION) : 0;
            } else {
                $this->_id = 0;
            }
        }

        $this->_registry = Registry::getInstancia();
        $this->_db = $this->_registry->_db['local']; // <--- MULTI_BD
        $this->_role = $this->getRole();
        //$this->_permisos = $this->getPermisosRole();
        //$this->compilarAcl();
    }

    public function compilarAcl()
    {
        $this->_permisos = array_merge(
            $this->_permisos ?? [],
            $this->getPermisosUsuario()
        );
    }

    public function getRole()
    {
        $roleQuery = $this->_db->query(
            "SELECT ROLE AS \"role\" FROM ".PREFIJO_TABLAS."usuarios WHERE id = {$this->_id}"
        );

        $role = $roleQuery->fetch();
        return $role['role'] ?? null;
    }

    public function getPermisosRoleId()
    {
        $idsQuery = $this->_db->query(
            "SELECT permiso AS \"permiso\" FROM " . PREFIJO_TABLAS . "permisos_role WHERE role = '{$this->_role}'"
        );

        $ids = $idsQuery->fetchAll(PDO::FETCH_ASSOC);
        return array_column($ids, 'permiso');
    }

    public function getPermisosRole()
    {
        $permisosQuery = $this->_db->query(
            "SELECT role AS \"role\", permiso AS \"permiso\", valor AS \"valor\" FROM " . PREFIJO_TABLAS . "permisos_role WHERE role = '{$this->_role}'"
        );

        $permisos = $permisosQuery->fetchAll(PDO::FETCH_ASSOC);
        $data = [];

        foreach ($permisos as $permiso) {
            $key = $this->getPermisoKey($permiso['permiso']);

            if ($key == '') {
                continue;
            }

            $data[$key] = [
                'key' => $key,
                'permiso' => $this->getPermisoNombre($permiso['permiso']),
                'valor' => $permiso['valor'] == 1,
                'heredado' => true,
                'id' => $permiso['permiso']
            ];
        }

        return $data;
    }

    public function getPermisoKey($permisoID)
    {
        $permisoID = (int)$permisoID;
        $keyQuery = $this->_db->query(
            "SELECT p.key AS \"key\" FROM " . PREFIJO_TABLAS . "permisos p WHERE id_permiso = {$permisoID}"
        );

        $key = $keyQuery->fetch();
        return $key['key'] ?? null;
    }

    public function getPermisoNombre($permisoID)
    {
        $permisoID = (int)$permisoID;

        $keyQuery = $this->_db->query(
            "SELECT permiso AS \"permiso\" FROM " . PREFIJO_TABLAS . "permisos WHERE id_permiso = {$permisoID}"
        );

        $key = $keyQuery->fetch();
        return $key['permiso'] ?? null;
    }

    public function getPermisosUsuario()
    {
        $ids = $this->getPermisosRoleId();
        $data = [];

        if (!empty($ids)) {
            $permisosQuery = $this->_db->query(
                "SELECT * FROM " . PREFIJO_TABLAS . "permisos_usuario WHERE usuario = {$this->_id} AND permiso IN (" . implode(",", $ids) . ")"
            );

            $permisos = $permisosQuery->fetchAll(PDO::FETCH_ASSOC);

            foreach ($permisos as $permiso) {
                $key = $this->getPermisoKey($permiso['permiso']);
                if ($key == '') {
                    continue;
                }

                $data[$key] = [
                    'key' => $key,
                    'permiso' => $this->getPermisoNombre($permiso['permiso']),
                    'valor' => $permiso['valor'] == 1,
                    'heredado' => false,
                    'id' => $permiso['permiso']
                ];
            }
        }

        return $data;
    }

    public function getPermisos()
    {
        return $this->_permisos ?? [];
    }

    public function permiso($key)
    {
        // if (array_key_exists($key, $this->_permisos)) {
        //     return $this->_permisos[$key]['valor'] === true || $this->_permisos[$key]['valor'] == 1;
        // }
        return true; // false;
    }

    public function acceso($key)
    {
        if ($this->permiso($key)) {
            Session::tiempo();
            return;
        }

        header("location:" . BASE_URL . "error/access/5050");
        exit;
    }

    public function acceso_generator($permiso, $controlador)
    {
        $limit = (DB_MANAGER == "oracle") ? " AND ROWNUM <= 1 " : " LIMIT 1 ";
        $p = $this->_db->query(
            "SELECT * FROM " . PREFIJO_TABLAS . "permisos_generator_role WHERE role = {$this->_id} AND generator = '{$controlador}' AND permiso = {$permiso} " . $limit
        );

        if ($p->fetch()) {
            Session::tiempo();
        } else {
            header("location:" . BASE_URL . "error/access/5050");
            exit;
        }
    }

    public function permiso_generator($permiso, $controlador)
    {
        $limit = (DB_MANAGER == "oracle") ? " AND ROWNUM <= 1 " : " LIMIT 1 ";
        $p = $this->_db->query(
            "SELECT * FROM " . PREFIJO_TABLAS . "permisos_generator_role WHERE role = {$this->_id} AND generator = '{$controlador}' AND permiso = {$permiso} " . $limit
        );

        return $p->fetch() ? true : false;
    }

    public function accesov($key)
    {
        if ($this->permiso($key)) {
            Session::tiempo();
            return true;
        }
        //header("location:" . BASE_URL . "error/access/5050");
        return false;
    }

    //====================MENÚ DE NAVEGACIÓN=====================

    public function get_opciones_menu_principal($idGrupo, $idIdioma, $id_padre = 0)
    {
        $condicion = ($id_padre == 0) ? "(id_padre IS NULL OR id_padre = 0) " : "id_padre = $id_padre ";
        // Código comentado original sobre la generación del menú
        /*
        $menu = $this->_db->query("SELECT ...");
        */
        return ($id_padre) ? $lista : [];
    }

    public function get_menu_principal($datos_menu = 0, $profundidad = 0)
    {
        $idGrupo = 1;
        $idIdioma = 1;

        if ($datos_menu == 0) {
            $datos_menu = $this->get_opciones_menu_principal($idGrupo, $idIdioma);
        }

        $etiquetas = "";
        foreach ($datos_menu as $menu) {
            if ($menu["activo"] && $this->verifica_permiso_acceder($menu)) {
                $opcion_activada = $this->verifica_opcion_activada($menu);
                $etiquetas .= $this->get_opcion($menu, $idGrupo, $idIdioma, $menu["activo"], $profundidad, $opcion_activada);
                if (isset($menu["submenu"])) {
                    $etiquetas .= '<ul class="nav nav-treeview">';
                    $etiquetas .= $this->get_menu_principal($menu["submenu"], $profundidad + 1);
                    $etiquetas .= '</ul>';
                }
                $etiquetas .= '</li>';
            }
        }

        return $etiquetas;
    }

    public function get_opcion($datos, $idGrupo, $idIdioma, $activo, $profundidad = 0, $opcion_activada = 0)
    {
        $activo = $opcion_activada ? "active" : "";
        $menu_abierto = $opcion_activada ? "menu-open" : "";

        $iconProfun = [0 => 'fas fa-circle', 1 => 'far fa-circle', 2 => 'far fa-dot-circle', 3 => 'fas fa-dot-circle'];
        $icono = isset($datos["class_css_icon"]) && $datos["class_css_icon"] 
            ? '<i class="nav-icon ' . $datos["class_css_icon"] . '"></i>'
            : '<i class="' . $iconProfun[$profundidad] . ' nav-icon"></i>';

        if (isset($datos["submenu"])) {
            $href = "#";
            $nombre = $datos["nombre"] . '<i class="right fas fa-angle-left"></i>';
        } else {
            $href = $this->get_href($datos);
            $nombre = $datos["nombre"];
        }

        $opcion = '<li class="nav-item ' . $menu_abierto . '">
                    <a href="' . htmlspecialchars($href) . '" class="nav-link ' . $activo . '">
                        ' . $icono . '
                        <p>' . htmlspecialchars($nombre) . '</p>
                    </a>';

        return $opcion;
    }

    public function get_href($datos)
    {
        switch ($datos['id_tipo_etiqueta']) {
            case 3: // controlador
            case 4: // generator
                return BASE_URL . $datos['direccion'];
            case 5: // archivo
                return $datos['direccion'];
            default:
                return "";
        }
    }

    public function verifica_permiso_acceder($datos)
    {
        if (isset($datos['controlador'])) {
            return isset($datos['permiso_controlador']) ? $this->permiso($datos['permiso_controlador']) : true;
        } elseif (isset($datos['generator'])) {
            return $this->permiso_generator(1, $datos['generator']);
        }
        return true;
    }

    public function verifica_opcion_activada($datos)
    {
        if (isset($datos["submenu"])) {
            foreach ($datos["submenu"] as $opcion) {
                if ($this->verifica_opcion_activada($opcion)) {
                    return true;
                }
            }
        } else {
            return @$_GET['url'] === $datos['direccion'] && !empty($_GET['url']);
        }
        return false;
    }

    //==========================================================
}

?>
