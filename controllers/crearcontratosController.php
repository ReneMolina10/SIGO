<?php

class crearcontratosController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->_contratos = $this->loadModel('crearcontratos');
    }

    public function index(){

        $this->forzarLogin();
        $anioActual             = date('Y');
        $departamentos          = $this->_contratos->getDepartamentos();
        $plantillaConpensatorio = $this->_contratos->getTipoPlantillaConpensatorio();
        $plantillaPrivado       = $this->_contratos->getTipoPlantillaPrivada();
        $fechasPeriodo          = $this->_contratos->getFechasPeriodo($anioActual);
       
        $this->_view->assign('fechasPeriodo', $fechasPeriodo);
        $this->_view->assign('plantillaConpensatorio', $plantillaConpensatorio);
        $this->_view->assign('plantillaPrivado', $plantillaPrivado);
        $this->_view->assign('departamentos', $departamentos);
        $this->_view->renderizar('index');
    }

    public function getDepartamentos(){
        $ureDepartamento = $_POST['departamento'] ?? null;
        return $ureDepartamento;
    }

    /**
     * *Esta función obtendra la ure del departamento y construira la tabla de acuerdo a las solicitudes de contratos
     * 
     * @method getSolicitudesContratos
     * 
     * @return array
     * 
     */
    public function getSolicitudesContratos(){
        $serialize = [];
        $ureDepartamento = $_POST['departamento'] ?? null;
        if (!$ureDepartamento) {
            return [];
        }
        
        $getSolicitudes = $this->_contratos->getSolicitudesContratos($ureDepartamento);
       
        if (!is_array($getSolicitudes) || count($getSolicitudes) === 0) {
            return []; // Retorna un array vacío si no hay datos
        }
        foreach($getSolicitudes as $key => $solicitudes){
           $serialize[] = [
                'ureDepartamento'   => $ureDepartamento,
                'idSolicitud'       => $solicitudes['ID'],
                'nombramiento'      => $solicitudes['NOMBRAMIENTO'],
                'tipoContrato'      => $solicitudes['TIPOCONTRATO'],
                'horasMaterias'     => $solicitudes['HORASMATERIA'],
                'totalHoras'        => $solicitudes['TOT_HRS'],
                'gradoEstudios'     => $solicitudes['NIVEL_ACA'],
                'asignaturas'       => $solicitudes['ASIGNATURAS'],
                'numeroEmpleado'    => $solicitudes['NUMEMPL'],
                'nombreEmpleado'    => $solicitudes['EMPLEADO'],
                'estatusSolicitud'  => $solicitudes['STATUS'],
                'periodo'           => $solicitudes['PERIODO'],
                'oficioSolicita'    => $solicitudes['OFICIO SOLICITA'],
           ];
        }

        usort($serialize, function($a, $b) {
            return strcmp($a['nombreEmpleado'], $b['nombreEmpleado']);
        });

        $this->_view->assign('serialize', $serialize);
        $this->_view->renderizar('lista_contratos', null, true);

    }

    public function formatMaterias($idSolicitud)
    {
        // 1) Obtengo las filas y extraigo solo la clave 'MATERIA'
        $filas      = $this->_contratos->getAsignaturasByIdSol($idSolicitud);
        $materias   = array_column($filas, 'MATERIA');

        // 2) Quito duplicados y reindexo
        $materias   = array_unique($materias);
        $materias   = array_values($materias);

        // 3) Envuelvo cada materia en comillas
        $lista = array_map(function($m) {
            return '"' . $m . '"';
        }, $materias);

        $total = count($lista);
        if ($total === 0) {
            return '—';
        }
        if ($total === 1) {
            return $lista[0];
        }

        // 4) Separo la última materia y uno las primeras con coma
        $ultima      = array_pop($lista);
        $principales = implode(', ', $lista);

        // 5) Decido “e” vs “y” según la última materia (sin comillas)
        $rawUltima = trim($ultima, '"');
        $letra1    = mb_strtoupper(mb_substr($rawUltima, 0, 1));
        $letra2    = mb_strtoupper(mb_substr($rawUltima, 1, 1));
        $conj      = (
            $letra1 === 'I'
            || $letra1 === 'Í'
            || ($letra1 === 'H' && in_array($letra2, ['I','Í'], true))
        ) ? ' e ' : ' y ';

        // 6) Devuelvo el texto formateado sin duplicados
        return $principales . $conj . $ultima;
    }

        

    public function procesarContrato($idSolicitud) {
        // 1. Obtener los datos enviados desde el formulario
        $formData = $_POST;
        
        // 2. Obtener la información de la solicitud mediante su ID
        $solicitud = $this->_contratos->getSolicitudById($idSolicitud);
        $materias = $this->formatMaterias($idSolicitud);

        if (!$solicitud) {
            echo json_encode([
                'idSolicitud' => $idSolicitud,
                'status'      => 'Error: Solicitud no encontrada',
                'link'        => ''
            ]);
            return;
        }
        
        // 3. Obtener la clave del período
        $periodoId   = isset($formData["periodo"]) ? trim($formData["periodo"]) : "";
        $clavePeriodo = "";
        if (!empty($periodoId)) {
            $clavePeriodo = $this->_contratos->getClavePeriodo($periodoId);
        }
        
        // 4. Obtener la División Académica a partir del URE de la solicitud
        $ureChild = isset($solicitud["SOL_FK_URE"]) ? $solicitud["SOL_FK_URE"] : "";
        $divisionAcademica = "";
        if (!empty($ureChild)) {
            $divisionAcademica = $this->_contratos->getDivisionAcademica($ureChild);
        }
        
        // 5. Armar el arreglo de datos para crear el contrato
        $datosContrato = [];
        
        // Datos provenientes del formulario
        $datosContrato["fecha_firma"]       = isset($formData["ffirma"])          ? trim($formData["ffirma"])          : "";
        $datosContrato["inicio"]            = isset($formData["finicio"])         ? trim($formData["finicio"])         : "";
        $datosContrato["fin"]               = isset($formData["ffin"])            ? trim($formData["ffin"])            : "";
        $datosContrato["quincenas"]         = isset($formData["quincenas"])       ? trim($formData["quincenas"])       : "";
        //$datosContrato["monto"]             = isset($formData["monto"])           ? trim($formData["monto"])           : "";
        //$datosContrato["monto_quincenal"]   = isset($formData["monto_quincenal"]) ? trim($formData["monto_quincenal"]) : "";
        //$datosContrato["monto_mensual"]     = isset($formData["monto_mensual"])   ? trim($formData["monto_mensual"])   : "";
        //$datosContrato["monto_final"]       = isset($formData["monto_final"])     ? trim($formData["monto_final"])     : "";
        $datosContrato["ure"]               = isset($formData["ure"])             ? trim($formData["ure"])             : "";
        $datosContrato["semanas"]           = isset($formData["semanas"])             ? trim($formData["semanas"])             : "";
        
        // Datos provenientes de la solicitud
        $datosContrato["numempl"]   = isset($solicitud["SOL_NUMEMPL"])            ? $solicitud["SOL_NUMEMPL"]            : "";
        $datosContrato["funciones"] = isset($materias)                            ? trim($materias)                      : "";
        $datosContrato["horas"]     = isset($solicitud["TOTALHORASSOLICITUD"])    ? $solicitud["TOTALHORASSOLICITUD"]    : "";
        $datosContrato["ua"]        = isset($solicitud["SOL_LUGAR_ADSC"])         ? $solicitud["SOL_LUGAR_ADSC"]         : "";
        $datosContrato["uf"]        = isset($solicitud["SOL_LUGAR_ADSC"])         ? $solicitud["SOL_LUGAR_ADSC"]         : "";
        
        // Datos adicionales obtenidos
        $datosContrato["per"] = $clavePeriodo;
        $datosContrato["da"]  = $divisionAcademica;
        
        // 6. Determinar el tipo de contrato (COMPENSATORIO o PRIVADO) y asignar la plantilla
        $tipoContrato = isset($formData["tipo_profesor"]) ? strtoupper(trim($formData["tipo_profesor"])) : "";
        
        if ($tipoContrato === "PRIVADO") {
            $datosContrato["plantilla"] = isset($formData["pprivada"]) ? trim($formData["pprivada"]) : "";
        } elseif ($tipoContrato === "COMPENSATORIO") {
            $datosContrato["plantilla"] = isset($formData["pcompensa"]) ? trim($formData["pcompensa"]) : "";
        } else {
            $datosContrato["plantilla"] = "";
        }

        
        // 7. Obtener el grado académico 
        $grado = isset($formData["gradoestudios"]) ? $formData["gradoestudios"] : "";
        
        // 8. Obtener y limitar las horas y semanas (convertidas a números)
        $horas  =  $datosContrato["horas"];
        $semanas  =  $datosContrato["semanas"];
        //$horas   = isset($formData["horasSemana"]) ? (float)$formData["horasSemana"] : 0;        
        //$semanas = isset($formData["semanas"])     ? (float)$formData["semanas"]     : 0;
        
        if ($tipoContrato === "COMPENSATORIO") {
            if ($horas > 8) { 
                $horas = 8; 
            }
        } else {
            if ($horas > 18) { 
                $horas = 18; 
            }
        }
        
        // **Aquí calculamos el total de horas del contrato**  
        $totalHoras = $horas * $semanas;

        // 9. Calcular montos según el grado académico
        // Utilizamos el select "tipo_cont": si es 2 (deportes/cultura) se usan los datos de 'culde'
        $tipo_cont = isset($formData["tipo_cont"]) ? (int)$formData["tipo_cont"] : 0;
        $montoTotal   = 0;
        $categoria    = 40;
        $montoporhora = 0;
        
        if ($tipo_cont === 2) {
            // Para profesores de deportes/cultura, se utiliza el valor de "culde"
            $montoTotal   = $formData["culde"] * $horas * $semanas;
            $categoria    = 40;
            $montoporhora = $formData["culde"];
        } else {
            // Para profesores de asignatura se determina según el grado académico
            if ($grado == "DOCTORADO") {
                $montoTotal   = $formData["dr"] * $horas * $semanas;
                $categoria    = 41;
                $montoporhora = $formData["dr"];
            } elseif ($grado == "MAESTRÍA") {
                $montoTotal   = $formData["mtro"] * $horas * $semanas;
                $categoria    = 42;
                $montoporhora = $formData["mtro"];
            } elseif ($grado == "ESPECIALIDAD MÉDICA (CIFRHS)" || $grado == "ESPECIALIDAD") {
                $montoTotal   = $formData["mtro"] * $horas * $semanas;
                $categoria    = 42;
                $montoporhora = $formData["mtro"];
            } elseif ($grado == "LICENCIATURA") {
                $montoTotal   = $formData["lic"] * $horas * $semanas;
                $categoria    = 43;
                $montoporhora = $formData["lic"];
            } else {
                $montoTotal   = $formData["culde"] * $horas * $semanas;
                $categoria    = 40;
                $montoporhora = $formData["culde"];
            }
        }
        
        $datosContrato["monto_hora"]        = $montoporhora;
        $datosContrato["monto_total"]       = $montoTotal;
        $datosContrato["categoria"]         = $categoria; //¿?
        $datosContrato["horas_semana"]      = $horas;
        $datosContrato["monto_quincenal"]   = $montoTotal / $datosContrato["quincenas"];
        $datosContrato["monto_mensual"]     = $datosContrato["monto_quincenal"] * 2;
        $datosContrato["horas"]             = $totalHoras;
        
        // 10. Determinar el valor de "tipoc" según el tipo de profesor y modalidad del contrato
        // "tipo_cont": 1 => Profesor Asignatura, 2 => Profesor Cultura/Deporte
        $tipoc = 0;
        if ($tipo_cont === 1) { // Profesor Asignatura
            if ($tipoContrato === "COMPENSATORIO") {
                $tipoc = 2;
            } elseif ($tipoContrato === "PRIVADO") {
                $tipoc = 3;
            }
        } elseif ($tipo_cont === 2) { // Profesor Cultura/Deporte
            if ($tipoContrato === "COMPENSATORIO") {
                $tipoc = 4;
            } elseif ($tipoContrato === "PRIVADO") {
                $tipoc = 5;
            }
        }

        $datosContrato["tipoc"] = $tipoc;
        
        // 11. Asignar campos adicionales que no provienen del formulario o la solicitud
        $datosContrato["contenido"] = "";
        $datosContrato["deptosae"]  = "";
        
        // 12. Insertar el contrato masivo y obtener identificadores
        $resultado = $this->_contratos->crearContratoMasivo($datosContrato);
        $claveContrato = $resultado["uat"] . "-" . $resultado["anio"] . "-" . $resultado["id"];
        
        // 13. Actualizar $_POST para compatibilidad con la lógica heredada
        $_POST["clavenum"]  = $datosContrato["ua"]; // UA se usa como clave
        $_POST["anio"]     = $resultado["anio"];
        $_POST["numc"]     = $resultado["id"];
        $_POST["plantilla"] = $datosContrato["plantilla"];
        $_POST["numempl"]  = $solicitud["SOL_NUMEMPL"];
        // Capturamos el valor de la plantilla desde $datosContrato:
        $plantillaValor = $datosContrato["plantilla"];
        
        
        // 14. Procesar y actualizar el contenido en una función aparte
        $contenidoProcesado = $this->procesarYActualizarContenido(
            $plantillaValor,
            $_POST["clavenum"],
            $_POST["anio"],
            $_POST["numc"],
            $_POST["numempl"]
        );
        
        // 15. Retornar la respuesta: según el flujo, o bien se envía JSON o se retorna un link
        // Ejemplo de respuesta:
        $claveUA = $this->_contratos->getURE($_POST["clavenum"]);
        $clave = $claveUA["CLAVE"] . "-" . $_POST["anio"] . "-" . $_POST["numc"];
        $link = '<div>' . $clave . '</div>
                <a href="' . BASE_URL . 'contrato/editar/' . $clave . '/" target="_blank">[Editar]</a>
                <a href="' . BASE_URL . 'crearcontratos/pdf/' . $clave . '/" target="_blank">[Imprimir]</a><br/>';
        
        echo json_encode([
            'idSolicitud' => $idSolicitud,
            'status'      => 'Creado',
            'link'        => $link
        ]);
    }
    
    
    
    /**
     * Función que procesa el contenido del contrato:
     * - Obtiene la plantilla de texto.
     * - Reemplaza los placeholders según la lógica de negocio.
     * - Actualiza la columna CNT_TEXTO en la base de datos.
     * - Retorna el contenido procesado.
     */
    private function procesarYActualizarContenido($plantilla, $clavenum, $anio, $numc, $numempl) {
        // 1. Obtener la plantilla de texto
        $row = $this->_contratos->getPlantillaTexto($plantilla);
    
        // 2. Definir la expresión regular para detectar placeholders en formato {xx.yy.zz}
        $re1 = '(\\{)';    // abre llave
        $re2 = '((?:[a-z][a-z0-9_]*))';    // Variable Name 1 (ej. "my", "tt", etc.)
        $re3 = '(\\.)';    // punto separador
        $re4 = '((?:[a-z][a-z0-9_]*))';    // Variable Name 2 (ej. "trab", "contrato", etc.)
        $re5 = '(\\.)';    // otro punto
        $re6 = '((?:[a-z][a-z0-9_]*))';    // Variable Name 3 (ej. "nombres", "funciones", etc.)
        $re7 = '(\\})';    // cierra llave
    
        if ($c = preg_match_all("/" . $re1 . $re2 . $re3 . $re4 . $re5 . $re6 . $re7 . "/is", $row["TEXTO"], $coincidencias)) {
            $c = 0;
            foreach ($coincidencias[0] as $fila) {
                $info = "";
                // Caso para placeholders relacionados al trabajador
                if ($coincidencias[4][$c] == "trab") {
                    if ($coincidencias[6][$c] == "funciones") {
                        $infoA = $this->_contratos->getInfoContrato($_POST["clavenum"], $_POST["anio"], $_POST["numc"], $coincidencias[6][$c]);
                        $infoA = $this->elementos($infoA);
                        $info = "<ul>";
                        foreach ($infoA as $filaF) {
                            $info .= "<li>" . $filaF . "</li>";
                        }
                        $info .= "</ul>";
                    } elseif ($coincidencias[6][$c] == "escuela") {
                        $info = $this->_contratos->getInfoTrabajador($_POST["numempl"], $coincidencias[6][$c]);
                        if (strpos($info, "UNIVERSIDAD") !== false || strpos($info, "ESCUELA") !== false) {
                            $info = "la " . $info;
                        } else if (strpos($info, "ESCUELA") !== false || strpos($info, "INSTITUTO") !== false) {
                            $info = "el " . $info;
                        } else {
                            $info = "el/la " . $info;
                        }
                    } elseif ($coincidencias[6][$c] == "estudiostextocompleto") {
                        $numCedula = $this->_contratos->getInfoTrabajador($_POST["numempl"], "numerocedula");
                        $gradoAcademico = $this->_contratos->getInfoTrabajador($_POST["numempl"], "gradoacademico");
                        $escuela = $this->_contratos->getInfoTrabajador($_POST["numempl"], "escuela");
                        if (strpos($escuela, "UNIVERSIDAD") !== false || strpos($escuela, "ESCUELA") !== false ||
                            strpos($escuela, "DIRECCIÓN") !== false || strpos($escuela, "ACADEMIA") !== false) { 
                            $escuela = "la " . $escuela;
                        } else if (strpos($escuela, "COLEGIO") !== false || strpos($escuela, "INSTITUTO") !== false ||
                                  strpos($escuela, "CENTRO") !== false) {
                            $escuela = "el " . $escuela;
                        } else {
                            $escuela = " la escuela  " . $escuela . " "; 
                        }
                        $carrera = $this->_contratos->getInfoTrabajador($_POST["numempl"], "carrera");
                        $fechatitulo = $this->_contratos->getInfoTrabajador($_POST["numempl"], "fechatitulo");
                        if ($numCedula != "") {
                            $fechaCedula = $this->_contratos->getInfoTrabajador($_POST["numempl"], "fechacedula");
                            if (strpos($carrera, "QUÍMICO") !== false || strpos($carrera, "MÉDICO") !== false ||
                                strpos($carrera, "TRABAJADOR") !== false || strpos($carrera, "INGENIERO") !== false) {
                                $carrera = "como $carrera";
                            } else {
                                $carrera = "en $carrera";
                            }
                            if ($numCedula !== 'E') {
                                $info = " título de $gradoAcademico $carrera expedido por $escuela el día $fechatitulo y cédula profesional $numCedula, de fecha $fechaCedula";
                            } else {
                                $info = " título de $gradoAcademico $carrera expedido por $escuela ( EXTRANJERO )";
                            }
                        } else {
                            if ($carrera == "SECUNDARIA" || $carrera == "EDUCACIÓN SECUNDARIA" || $carrera == "BACHILLER")
                                $carrera = "";
                            if ($carrera != "") $carrera = " ( " . $carrera . " ) ";
                            if ($escuela != "") $escuela = "expedido por " . $escuela . " ";
                            if ($fechatitulo != "") $fechatitulo = " el día  " . $fechatitulo . " ";
                            $info = " estudios de $gradoAcademico $carrera $escuela $fechatitulo";
                        }
                        $infoAptitudes = $this->_contratos->getInfoTrabajador($_POST["numempl"], "aptitudes");
                        if ($infoAptitudes != "" && $info != "") {
                            $info = $info . ". Tiene " . $infoAptitudes;
                        } else if ($infoAptitudes != "" && $info == "") {
                            $info = $info . " " . $infoAptitudes;
                        }
                    } elseif ($coincidencias[6][$c] == "estudios") {
                        $info = $this->_contratos->getInfoTrabajador($_POST["numempl"], $coincidencias[6][$c]);
                        if ($info == "") $info = "C.";
                    } elseif ($coincidencias[6][$c] == "prefijo") {
                        $info = $this->_contratos->getInfoTrabajador($_POST["numempl"], $coincidencias[6][$c]);
                        if ($info == "") $info = "C.";
                    } else {
                        $info = $this->_contratos->getInfoTrabajador($_POST["numempl"], $coincidencias[6][$c]);
                    }
                }
                // Caso para datos del contrato
                if ($coincidencias[4][$c] == "contrato") {
                    $info = $this->_contratos->getInfoContrato($_POST["clavenum"], $_POST["anio"], $_POST["numc"], $coincidencias[6][$c]);
                    if ($coincidencias[6][$c] == "sueldoquincenatexto" || $coincidencias[6][$c] == "sueldototaltexto" || $coincidencias[6][$c] == "sueldomensualtexto") {
                        $info = $this->num2letras(number_format($info, 2, '.', ''));
                    }
                    if ($coincidencias[6][$c] == "sueldoquincenanum" || $coincidencias[6][$c] == "sueldototalnum" || $coincidencias[6][$c] == "sueldomensual") {
                        $info = number_format($info, 2, '.', ',');
                    }
                    if ($coincidencias[6][$c] == "fechainicio" || $coincidencias[6][$c] == "fechafin" || $coincidencias[6][$c] == "fechafirmatexto") {
                        $info = $this->getFechaTexto($info);
                    }
                    if ($coincidencias[6][$c] == "ures") {
                        if (strpos($info, "DIRECCI") !== false || strpos($info, "DIVISI") !== false ||
                            strpos($info, "RECTOR") !== false || strpos($info, "COORDINACI") !== false ||
                            strpos($info, "AUDITORÍA") !== false) {
                            $info = "a la " . $info;
                        } else if (strpos($info, "DEPARTAMENTO") !== false || strpos($info, "ÁREA") !== false ||
                                   strpos($info, "CENTRO") !== false) {
                            $info = "al " . $info;
                        } else {
                            $info = "al " . $info;
                        }
                    }
                    if ($coincidencias[6][$c] == "ures_del_dela") {
                        if (strpos($info, "DIRECCI") !== false || strpos($info, "DIVISI") !== false ||
                            strpos($info, "RECTOR") !== false || strpos($info, "COORDINACI") !== false ||
                            strpos($info, "AUDITORÍA") !== false) {
                            $info = "de la " . $info;
                        } else if (strpos($info, "DEPARTAMENTO") !== false || strpos($info, "ÁREA") !== false ||
                                   strpos($info, "CENTRO") !== false) {
                            $info = "del " . $info;
                        } else {
                            $info = "del " . $info;
                        }
                    }
                    if ($coincidencias[6][$c] == "montofinal") {
                        if (!($info == '0' || $info == 0 || $info == "")) {
                            $info = ' y un último pago por la cantidad de $' . number_format($info, 2, '.', ',') . ' (' . $this->num2letras(number_format($info, 2, '.', '')) . ')';
                        } else {
                            $info = "x";
                        }
                    }
                }
                $idURE = $this->_contratos->getInfoContrato($_POST["clavenum"], $_POST["anio"], $_POST["numc"], "idure");
                
                // Caso para datos de la plantilla
                if ($coincidencias[4][$c] == "plantilla") {
                    $info = $this->_contratos->getInfoPlantilla($coincidencias[6][$c], $_POST["numempl"]);
                    if ($coincidencias[6][$c] == "ure") {
                        if (strpos($info, "DIRECCI") !== false || strpos($info, "DIVISI") !== false ||
                            strpos($info, "RECTOR") !== false || strpos($info, "COORDINACI") !== false ||
                            strpos($info, "AUDITORÍA") !== false) {
                            $info = " la " . $info;
                        } else if (strpos($info, "DEPARTAMENTO") !== false || strpos($info, "ÁREA") !== false ||
                                   strpos($info, "CENTRO") !== false) {
                            $info = "el " . $info;
                        } else {
                            $info = "el " . $info;
                        }
                    }
                    if ($coincidencias[6][$c] == "ures_del_dela") {
                        if (strpos($info, "DIRECCI") !== false || strpos($info, "DIVISI") !== false ||
                            strpos($info, "RECTOR") !== false || strpos($info, "COORDINACI") !== false ||
                            strpos($info, "AUDITORÍA") !== false) {
                            $info = "de la " . $info;
                        } else if (strpos($info, "DEPARTAMENTO") !== false || strpos($info, "ÁREA") !== false ||
                                   strpos($info, "CENTRO") !== false) {
                            $info = "del " . $info;
                        } else {
                            $info = "del " . $info;
                        }
                    }
                }
                if ($coincidencias[4][$c] == "jefdepto") {
                    $info = $this->_contratos->getInfoJefeDepto($coincidencias[6][$c], $idURE);
                }
                if ($coincidencias[4][$c] == "director") {
                    $info = $this->_contratos->getInfoDirector($coincidencias[6][$c], $idURE);
                }
                if ($coincidencias[4][$c] == "administrador") {
                    $info = $this->_contratos->getInfoAdministrador($coincidencias[6][$c]);
                }
                if ($coincidencias[4][$c] == "rector") {
                    $info = $this->_contratos->getInfoRector($coincidencias[6][$c]);
                }
                if ($coincidencias[4][$c] == "admin") {
                    $info = $this->_contratos->getInfoAdmin($coincidencias[6][$c]);
                }
                if ($info != "") {
                    if (is_array($info)) {
                        $info = isset($info['INFO']) ? $info['INFO'] : "";
                    }
                    if ($info == "x") $info = "";
                    if ($coincidencias[2][$c] == "my") $info = mb_strtoupper($info);
                    if ($coincidencias[2][$c] == "mn") $info = mb_strtolower($info);
                    if ($coincidencias[2][$c] == "tt") $info = $this->art(ucwords(mb_strtolower($info)));
                    if ($coincidencias[2][$c] == "or") $info = ucfirst($info);
                    $row["TEXTO"] = str_replace($fila, $info, $row["TEXTO"]);
                }
                $c++;
            }
        }
        $res = $this->_contratos->putTextoContratos($row["TEXTO"], $_POST["clavenum"], $_POST["anio"], $_POST["numc"]);
    }
    
    
    

    public function num2letras($num, $fem = false, $dec = true,$moneda=true) { 
        $matuni[2]  = "dos"; 
        $matuni[3]  = "tres"; 
        $matuni[4]  = "cuatro"; 
        $matuni[5]  = "cinco"; 
        $matuni[6]  = "seis"; 
        $matuni[7]  = "siete"; 
        $matuni[8]  = "ocho"; 
        $matuni[9]  = "nueve"; 
        $matuni[10] = "diez"; 
        $matuni[11] = "once"; 
        $matuni[12] = "doce"; 
        $matuni[13] = "trece"; 
        $matuni[14] = "catorce"; 
        $matuni[15] = "quince"; 
        $matuni[16] = "dieciseis"; 
        $matuni[17] = "diecisiete"; 
        $matuni[18] = "dieciocho"; 
        $matuni[19] = "diecinueve"; 
        $matuni[20] = "veinte"; 
        $matunisub[2] = "dos"; 
        $matunisub[3] = "tres"; 
        $matunisub[4] = "cuatro"; 
        $matunisub[5] = "quin"; 
        $matunisub[6] = "seis"; 
        $matunisub[7] = "sete"; 
        $matunisub[8] = "ocho"; 
        $matunisub[9] = "nove"; 
        $matdec[2] = "veint"; 
        $matdec[3] = "treinta"; 
        $matdec[4] = "cuarenta"; 
        $matdec[5] = "cincuenta"; 
        $matdec[6] = "sesenta"; 
        $matdec[7] = "setenta"; 
        $matdec[8] = "ochenta"; 
        $matdec[9] = "noventa"; 
        $matsub[3]  = 'mill'; 
        $matsub[5]  = 'bill'; 
        $matsub[7]  = 'mill'; 
        $matsub[9]  = 'trill'; 
        $matsub[11] = 'mill'; 
        $matsub[13] = 'bill'; 
        $matsub[15] = 'mill'; 
        $matmil[4]  = 'millones'; 
        $matmil[6]  = 'billones'; 
        $matmil[7]  = 'de billones'; 
        $matmil[8]  = 'millones de billones'; 
        $matmil[10] = 'trillones'; 
        $matmil[11] = 'de trillones'; 
        $matmil[12] = 'millones de trillones'; 
        $matmil[13] = 'de trillones'; 
        $matmil[14] = 'billones de trillones'; 
        $matmil[15] = 'de billones de trillones'; 
        $matmil[16] = 'millones de billones de trillones'; 
        
        //Zi hack
        $float=explode('.',$num);
        $num=$float[0];
        $num = trim((string)@$num); 
        // Inicializar si está vacío
        if ($num === '') {
        $num = '0';
        }
        // Detectar signo
        if ($num[0] == '-') { 
        $neg = 'menos '; 
        $num = substr($num, 1); 
        }else 
        $neg = ''; 
        //while ($num[0] == '0') $num = substr($num, 1); 
        // Eliminar ceros a la izquierda, dejando al menos uno
        while (strlen($num) > 1 && $num[0] === '0') {
        $num = substr($num, 1);
        }
        //if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
        // Asegurar primer carácter válido
        if (!isset($num[0]) || $num[0] < '1' || $num[0] > '9') {
        $num = '0' . $num;
        }
        $zeros = true; 
        $punt = false; 
        $ent = ''; 
        $fra = ''; 
        for ($c = 0; $c < strlen($num); $c++) { 
        $n = $num[$c]; 
        if (! (strpos(".,'''", $n) === false)) { 
            if ($punt) break; 
            else{ 
                $punt = true; 
                continue; 
            } 
        }elseif (! (strpos('0123456789', $n) === false)) { 
            if ($punt) { 
                if ($n != '0') $zeros = false; 
                $fra .= $n; 
            }else 
                $ent .= $n; 
        }else 
            break; 
        } 
        $ent = '     ' . $ent; 
        if ($dec and $fra and ! $zeros) { 
        $fin = ' coma'; 
        for ($n = 0; $n < strlen($fra); $n++) { 
            if (($s = $fra[$n]) == '0') 
                $fin .= ' cero'; 
            elseif ($s == '1') 
                $fin .= $fem ? ' una' : ' un'; 
            else 
                $fin .= ' ' . $matuni[$s]; 
        } 
        }else 
        $fin = ''; 
        if ((int)$ent === 0) return 'Cero ' . $fin; 
        $tex = ''; 
        $sub = 0; 
        $mils = 0; 
        $neutro = false; 
        while ( ($num = substr($ent, -3)) != '   ') { 
        $ent = substr($ent, 0, -3); 
        if (++$sub < 3 and $fem) { 
            $matuni[1] = 'una'; 
            $subcent = 'as'; 
        }else{ 
            $matuni[1] = $neutro ? 'un' : 'uno'; 
            $subcent = 'os'; 
        } 
        $t = ''; 
        $n2 = substr($num, 1); 
        if ($n2 == '00') { 
        }elseif ($n2 < 21) 
            $t = ' ' . $matuni[(int)$n2]; 
        elseif ($n2 < 30) { 
            $n3 = $num[2]; 
            if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
            $n2 = $num[1]; 
            $t = ' ' . $matdec[$n2] . $t; 
        }else{ 
            $n3 = $num[2]; 
            if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
            $n2 = $num[1]; 
            $t = ' ' . $matdec[$n2] . $t; 
        } 
        $n = $num[0]; 
        if ($n == 1) { 
            $t = ' ciento' . $t; 
        }elseif ($n == 5){ 
            $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
        }elseif ($n != 0){ 
            $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
        } 
        if ($sub == 1) { 
        }elseif (! isset($matsub[$sub])) { 
            if ($num == 1) { 
                $t = ' mil'; 
            }elseif ($num > 1){ 
                $t .= ' mil'; 
            } 
        }elseif ($num == 1) { 
            $t .= ' ' . $matsub[$sub] . '?n'; 
        }elseif ($num > 1){ 
            $t .= ' ' . $matsub[$sub] . 'ones'; 
        }   
        if ($num == '000') $mils ++; 
        elseif ($mils != 0) { 
            if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
            $mils = 0; 
        } 
        $neutro = true; 
        $tex = $t . $tex; 
        } 
        $tex = $neg . substr($tex, 1) . $fin; 
        //Zi hack --> return ucfirst($tex);
        if($moneda)
        $end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
        else
        $end_num=ucfirst($tex);
        return $end_num; 
    } 
      
    
    private function elementos($texto){
        return array_filter(explode(PHP_EOL,htmlspecialchars($texto)),function($k) { return trim($k) != '';});
    }
    
    public function getFechaTexto($fecha) {
        $dias = [
            1 => "primero", 2 => "dos", 3 => "tres", 4 => "cuatro", 5 => "cinco",
            6 => "seis", 7 => "siete", 8 => "ocho", 9 => "nueve", 10 => "diez",
            11 => "once", 12 => "doce", 13 => "trece", 14 => "catorce", 15 => "quince",
            16 => "dieciséis", 17 => "diecisiete", 18 => "dieciocho", 19 => "diecinueve", 20 => "veinte",
            21 => "veintiuno", 22 => "veintidós", 23 => "veintitrés", 24 => "veinticuatro", 25 => "veinticinco",
            26 => "veintiséis", 27 => "veintisiete", 28 => "veintiocho", 29 => "veintinueve", 30 => "treinta",
            31 => "treinta y uno"
        ];
    
        $meses = [
            '1' => "enero", '2' => "febrero", '3' => "marzo", '4' => "abril", '5' => "mayo",
            '6' => "junio", '7' => "julio", '8' => "agosto", '9' => "septiembre", '10' => "octubre",
            '11' => "noviembre", '12' => "diciembre"
        ];
    
        $partes = explode("-", $fecha);
        $dia = $dias[(int)$partes[0]] ?? "--";
        $mes = $meses[(int)$partes[1]] ?? "--";
        $anio = $this->num2letras($partes[2], false, false, false);
    
        return "$dia de $mes de $anio";
    }

    public function art($cadena = "") {
        $reemplazos = [
            " Para " => " para ", " Con " => " con ", "Expedido" => "expedido",
            "Metódos " => "Métodos ", "Día" => "día", ". tiene " => ". Tiene ",
            " De " => " de ", " con " => " con ", "A La " => "a la ", " Del " => " del ",
            "Del " => "del ", " La " => " la ", " Como " => " como ", " Y " => " y ",
            " E " => " e ", " Ii" => " II", " Iii" => " III", " IIi" => " III", " Vi" => " VI",
            "La " => "la ", "Al " => "al ", "A " => "a ", " Las " => " las ", " Los " => " los ",
            "El " => "el ", " En " => " en ", " Por " => " por ", " Fecha " => " fecha ",
            "( " => "(", " )" => ")", '" ' => '"', ' "' => '"', '  ' => ' '
        ];
        
        return str_replace(array_keys($reemplazos), array_values($reemplazos), $cadena);
    }
    

    public function pdf($id = "") {
        // Limpiar todos los buffers de salida
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        $this->_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->creapdf($id);
        
        // Enviar el PDF y detener la ejecución
        $this->_pdf->Output($id . '_contrato.pdf', 'I');
        exit();
    }
    
    
    private function creapdf($id = "") {
        if ($id == "") {
            exit();
        }
        
        $partes = explode("-", $id);
        $clave = $partes[0];
        $anio = $partes[1];
        $numC = $partes[2];
        $idImprime = $clave . "-" . $numC . "-" . $anio;
        
        if (!is_numeric($anio) || !is_numeric($numC)) {
            exit();
        }
        
        $infoC = $this->_contratos->getContratoTexto($clave, $anio, $numC);
        
        if (method_exists($infoC['TEXTO'], 'load')) {
            $infoC["TEXTO"] = $infoC['TEXTO']->load();
        }
        $texto=  html_entity_decode($infoC["TEXTO"]);
        $texto = html_entity_decode($infoC["TEXTO"]);

        // Configuración del PDF
        $this->_pdf->SetCreator(PDF_CREATOR);
        $this->_pdf->SetAuthor('Departamento de Recursos Humanos');
        $this->_pdf->SetTitle('UNIVERSIDAD AUTÓNOMA DEL ESTADO DE QUINTANA ROO');
        $this->_pdf->SetSubject('Contrato');
        $this->_pdf->SetKeywords('contrato');
        
        $tituloDoc = "";
        $logo = "";
        $sizeLogo = "10";
        $subtituloDoc = "CONTRATO NÚMERO: " . $infoC["CLAVE"] . $idImprime;
        $this->_pdf->SetHeaderData($logo, $sizeLogo, $tituloDoc, $subtituloDoc);
        
        $this->_pdf->setHeaderFont([PDF_FONT_NAME_MAIN, 'B', PDF_FONT_SIZE_MAIN]);
        $this->_pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        
        $this->_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        $margenes = explode(",", $infoC["MARGENES"]);
        $this->_pdf->SetMargins($margenes[3], $margenes[0], $margenes[1]);
        $this->_pdf->SetHeaderMargin($margenes[4]);
        $this->_pdf->SetFooterMargin($margenes[5]);
        $this->_pdf->SetAutoPageBreak(true, $margenes[2]);
        
        $this->_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $this->_pdf->setLanguageArray($l);
        }
        
        // Creación del documento PDF
        $this->_pdf->startPageGroup();
        $this->_pdf->AddPage('P', 'LEGAL');
        $this->_pdf->SetFont('helvetica', '', 9.5);
        $this->_pdf->writeHTML($texto, true, 0, true, true);
        $this->_pdf->resetHeaderTemplate();
        
    }


    public function sesion() {
        echo "---";
        print_r($_SESSION);
        exit;

    }
    

}

?>