<?php
//cargar coneccion con la base de datos
require_once("config/conn.php");

//revisar si hay una busqueda activa para decidir lo que se mostrara al cargar la pagina
$busqueda_activa = false;

//guardar el horario
$resultado = [];
$dias_semana = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"];

// Franja por defecto: vespertino (1:00 PM a 9:00 PM)
$hora_base_min = 13; // 1:00 PM
$hora_base_max = 21; // 9:00 PM
$horas_formateadas = [];

// Cuadrícula del horario: $grid[dia][indice_de_hora] = datos de la clase
$grid = [];

if (isset($_GET["semestre"]) && isset($_GET["grupo"])) {
    $busqueda_activa = true;
    $semestre = $_GET["semestre"];
    $grupo = $_GET["grupo"];

    try {

        $query = "SELECT 
                    h.day_of_week AS dia, 
                    m.subject_name AS materia, 
                    prof.full_name AS maestro, 
                    s.room_number AS salon, 
                    h.start_time AS hora_inicio, 
                    h.end_time AS hora_fin
                  FROM schedules h
                  INNER JOIN student_groups g ON h.group_id = g.group_id
                  INNER JOIN semesters sem ON g.semester_id = sem.semester_id
                  INNER JOIN subjects m ON h.subject_id = m.subject_id
                  INNER JOIN teachers prof ON h.teacher_id = prof.teacher_id
                  INNER JOIN classrooms s ON h.classroom_id = s.classroom_id
                  WHERE sem.semester_number = :semestre AND g.letter = :grupo
                  ORDER BY h.day_of_week, h.start_time";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':semestre', $semestre);
        $stmt->bindParam(':grupo', $grupo);

        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Si hay materias antes de la 1:00 PM o después de las 9:00 PM, ajustamos el rango
        foreach ($resultado as $c) {
            $h_ini = (int) date('G', strtotime($c['hora_inicio']));
            $h_fin = (int) ceil(strtotime($c['hora_fin']) / 3600);
            $fin_hour = (int) date('G', strtotime($c['hora_fin']));
            // Si termina en punto (ej. 10:00), la última franja iniciada es 9:00
            $minutos_fin = (int) date('i', strtotime($c['hora_fin']));
            $h_fin_slot = ($minutos_fin > 0) ? $fin_hour : max($h_ini, $fin_hour - 1);

            if ($h_ini < $hora_base_min) {
                $hora_base_min = $h_ini;
            }
            if ($h_fin_slot > $hora_base_max) {
                $hora_base_max = $h_fin_slot;
            }
        }

        // Generar etiquetas de horas dinámicamente según el rango calculado
        for ($h = $hora_base_min; $h <= $hora_base_max; $h++) {
            $horas_formateadas[] = date("g:00 A", strtotime("$h:00:00"));
        }

        foreach ($resultado as &$clase) {
            switch ($clase['dia']) {
                case 1:
                    $clase['dia'] = "Lunes";
                    break;
                case 2:
                    $clase['dia'] = "Martes";
                    break;
                case 3:
                    $clase['dia'] = "Miercoles";
                    break;
                case 4:
                    $clase['dia'] = "Jueves";
                    break;
                case 5:
                    $clase['dia'] = "Viernes";
                    break;
                default:
                    break;
            }
        }
        unset($clase);

        // Construcción de la cuadrícula (días x franjas horarias)
        foreach ($resultado as $clase) {
            $dia = $clase['dia'];

            $inicio_ts = strtotime($clase['hora_inicio']);
            $fin_ts = strtotime($clase['hora_fin']);

            if ($inicio_ts === false || $fin_ts === false) {
                continue;
            }

            $duracion_horas = (int) round(($fin_ts - $inicio_ts) / 3600);
            $duracion_horas = max(1, $duracion_horas);

            $indice_inicio = ((int) date('G', $inicio_ts)) - $hora_base_min;

            if ($indice_inicio < 0 || $indice_inicio >= count($horas_formateadas)) {
                continue;
            }

            $grid[$dia][$indice_inicio] = [
                'tipo' => 'inicio',
                'materia' => $clase['materia'],
                'salon' => $clase['salon'],
                'maestro' => $clase['maestro'],
                'rowspan' => $duracion_horas,
            ];

            for ($i = 1; $i < $duracion_horas; $i++) {
                $idx = $indice_inicio + $i;
                if ($idx < count($horas_formateadas)) {
                    $grid[$dia][$idx] = ['tipo' => 'ocupado'];
                }
            }
        }

    } catch (PDOException $e) {
        die("Error en la consulta SQL: " . $e->getCode());
    }
} else {
    // Si no hay búsqueda, mostramos el rango estándar de la tarde
    for ($h = $hora_base_min; $h <= $hora_base_max; $h++) {
        $horas_formateadas[] = date("g:00 A", strtotime("$h:00:00"));
    }
}

?>

<!-- Estilos de esta pagina -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/pages/consulta_horarios.css">
<section class="main">
    <h1>Consulta tu horario de clases</h1>
    <h3>Selecciona tu semestre y grupo para poder ver tu horario.</h3>

    <!-- Filtro por grupos -->
    <div class="filtro">
        <form method="GET">
            <input type="hidden" name="page" value="consulta_de_horarios">
            <label for="semestre">Semestre:</label>
            <select name="semestre" id="semestre">
                <option value="" disabled <?php echo !isset($_GET['semestre']) ? 'selected' : ''; ?>>Selecciona</option>
                <?php
                $nombres_semestres = [
                    1 => "Primero", 2 => "Segundo", 3 => "Tercero", 4 => "Cuarto",
                    5 => "Quinto", 6 => "Sexto", 7 => "Septimo", 8 => "Octavo"
                ];
                foreach ($nombres_semestres as $num => $nombre): ?>
                    <option value="<?php echo $num; ?>" <?php echo (isset($_GET['semestre']) && $_GET['semestre'] == $num) ? 'selected' : ''; ?>>
                        <?php echo $nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="grupo">Grupo</label>
            <select name="grupo" id="grupo">
                <option value="" disabled <?php echo !isset($_GET['grupo']) ? 'selected' : ''; ?>>Selecciona</option>
                <option value="A" <?php echo (isset($_GET['grupo']) && $_GET['grupo'] === 'A') ? 'selected' : ''; ?>>A</option>
                <option value="B" <?php echo (isset($_GET['grupo']) && $_GET['grupo'] === 'B') ? 'selected' : ''; ?>>B</option>
            </select>
            <button>Consultar</button>
        </form>

    </div>


    <!-- Tabla del horario  -->
    <div class="horario">
        <?php if ($busqueda_activa): ?>
            <?php if (!empty($resultado)): ?>
                <!-- Cuadrícula semanal: columnas = días, filas = franjas horarias -->
                <div class="tabla-scroll">
                    <table class="tabla-horario">
                        <thead>
                            <tr>
                                <th class="celda-hora">Hora</th>
                                <?php foreach ($dias_semana as $dia): ?>
                                    <th><?php echo $dia; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($horas_formateadas as $idx => $hora_label): ?>
                                <tr>
                                    <td class="celda-hora"><?php echo $hora_label; ?></td>
                                    <?php foreach ($dias_semana as $dia): ?>
                                        <?php if (isset($grid[$dia][$idx])): ?>
                                            <?php $celda = $grid[$dia][$idx]; ?>
                                            <?php if ($celda['tipo'] === 'inicio'): ?>
                                                <td class="celda-clase" rowspan="<?php echo $celda['rowspan']; ?>">
                                                    <span
                                                        class="clase-materia"><?php echo htmlspecialchars($celda['materia']); ?></span>
                                                    <span class="clase-salon">
                                                        <?php echo htmlspecialchars($celda['salon']); ?></span>
                                                </td>
                                            <?php endif; ?>
                                        
                                        <?php else: ?>
                                            <td class="celda-vacia" aria-hidden="true"></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="aviso">No existe horario registrado para ese grupo</p>
            <?php endif; ?>
        <?php else: ?>
            <p class="aviso">Selecciona un semestre y un grupo para consultar su horario.</p>
        <?php endif; ?>
    </div>
</section>