<?php

class monitor_solicitudesController extends Controller
{
    private $_sol;

    public function __construct()
    {
        parent::__construct();
        $this->forzarLogin();
        $this->_sol = $this->loadModel('monitor_solicitudes');
    }

    public function index()
    {
        $resultados_raw = $this->_sol->getSolicitudes();

        $profesores_data = [];
        foreach ($resultados_raw as $row) {
            $id_sol = $row["ID_SOL"];
            $ubic = $row["UBICACION"];
            $div = $row["DIVISION"];
            $ure = $row["URE"];
            $num_empleado_s = $row["NUMEMPL"];
            $nombre_empleado_s = $row["EMPLEADO"];
            $asignatura_s = $row["ASIGNATURAS"];
            $horas_s = $row["HORAS"];            

            $num_empleado_r = $row["NUMEMPL_SAE"];
            $asignatura_r = $row["ASIGNATURA_SAE"];
            $horas_r = $row["HORAS_SAE"];

            // Procesar la solicitud
            if ($num_empleado_s) {
                if (!isset($profesores_data[$num_empleado_s])) {
                    $profesores_data[$num_empleado_s] = [
                        'id_sol' => $id_sol,
                        'ubic' => $ubic,
                        'div' => $div,
                        'ure' => $ure,
                        'nombre_empleado' => $nombre_empleado_s,
                        'solicitadas' => [],
                        'total_horas_solicitadas' => 0,
                        'asignadas_rrhh' => [],
                        'total_horas_sae' => 0,
                    ];
                }
                if ($asignatura_s) {
                    $solicitud = ["asignatura" => $asignatura_s, "horas" => $horas_s];
                    if (!in_array($solicitud, $profesores_data[$num_empleado_s]['solicitadas'])) {
                        $profesores_data[$num_empleado_s]['solicitadas'][] = $solicitud;
                        $profesores_data[$num_empleado_s]['total_horas_solicitadas'] += $horas_s;
                    }
                }
            }

            // Procesar la asignación de RRHH SOLO SI el maestro ya está en $profesores_data
            if ($num_empleado_r && isset($profesores_data[$num_empleado_r])) {
                if ($asignatura_r) {
                    $asignacion_rrhh = ["asignatura" => $asignatura_r, "horas" => $horas_r];
                    if (!in_array($asignacion_rrhh, $profesores_data[$num_empleado_r]['asignadas_rrhh'])) {
                        $profesores_data[$num_empleado_r]['asignadas_rrhh'][] = $asignacion_rrhh;
                        $profesores_data[$num_empleado_r]['total_horas_sae'] += $horas_r;
                    }
                }
            }
            // Manejar casos donde solo hay solicitud
            else if ($num_empleado_s && $asignatura_s && !isset($profesores_data[$num_empleado_s])) {
                $profesores_data[$num_empleado_s] = [
                    'id_sol' => $id_sol,
                    'ubic' => $ubic,
                    'div' => $div,
                    'ure' => $ure,
                    'solicitadas' => [["asignatura" => $asignatura_s, "horas" => $horas_s]],
                    'total_horas_solicitadas' => $horas_s,
                    'asignadas_rrhh' => [],
                    'total_horas_sae' => 0,
                ];
            }
            // Manejar casos donde hay solicitud y luego se procesa una asignación para el mismo maestro
            else if ($num_empleado_s && $num_empleado_r && $num_empleado_s === $num_empleado_r && isset($profesores_data[$num_empleado_s]) && $asignatura_r) {
                $asignacion_rrhh = ["asignatura" => $asignatura_r, "horas" => $horas_r];
                if (!in_array($asignacion_rrhh, $profesores_data[$num_empleado_s]['asignadas_rrhh'])) {
                    $profesores_data[$num_empleado_s]['asignadas_rrhh'][] = $asignacion_rrhh;
                    $profesores_data[$num_empleado_s]['total_horas_sae'] += $horas_r;
                }
            }
        }

        // echo "<pre>";
        // print_r($profesores_data);
        // echo "</pre>";
        // exit;

        $this->_view->assign('profesores_data', $profesores_data);
        $this->_view->renderizar('index', true);
    }
}



?>