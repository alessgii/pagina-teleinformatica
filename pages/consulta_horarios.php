<?php
//cargar coneccion con la base de datos
require_once("config/conn.php");

//revisar si hay una busqueda activa para decidir lo que se mostrara al cargar la pagina
$busqueda_activa = false;

//guardar el horario
$resultado = [];
$dias_semana = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"];
$horas_formateadas = ["1:00 PM", "2:00 PM", "3:00 PM", "4:00 PM", "5:00 PM", "6:00 PM", "7:00 PM", "8:00 PM", "9:00 PM"];

// Cuadrícula del horario: $grid[dia][indice_de_hora] = datos de la clase
// Se construye a partir de $resultado para poder pintar la tabla como
// días (columnas) x franjas horarias (filas).
$grid = [];

if (isset($_GET["semestre"]) && isset($_GET["grupo"])) {
    $busqueda_activa = true;
    $semestre = $_GET["semestre"];
    $grupo = $_GET["grupo"];

    try {

        $query = "SELECT 
                    h.dia, 
                    m.nombre AS materia, 
                    prof.nombre AS maestro, 
                    s.nombre AS salon, 
                    h.hora_inicio, 
                    h.hora_fin
                  FROM horario h
                  INNER JOIN grupo g ON h.grupo_id = g.id
                  INNER JOIN materia m ON h.materia_id = m.id
                  INNER JOIN maestro prof ON h.maestro_id = prof.id
                  INNER JOIN salon s ON h.salon_id = s.id
                  WHERE g.semester = :semestre AND g.letter = :grupo
                  ORDER BY h.dia, h.hora_inicio";

        $stmt = $pdo->prepare($query);


        $stmt->bindParam(':semestre', $semestre);
        $stmt->bindParam(':grupo', $grupo);

        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        // Construcción de la cuadrícula (días x franjas horarias) ---
        // Por cada clase calculamos en qué franja empieza y cuántas franjas
        // ocupa (rowspan), para soportar tanto clases de una hora como de
        // varias horas seguidas, y dejar en blanco los espacios sin clase.
        // Nota: se asume que hora_inicio/hora_fin caen en horas exactas
        // (1:00, 2:00, etc.), igual que $horas_formateadas.
        foreach ($resultado as $clase) {
            $dia = $clase['dia'];

            $inicio_ts = strtotime($clase['hora_inicio']);
            $fin_ts = strtotime($clase['hora_fin']);

            if ($inicio_ts === false || $fin_ts === false) {
                continue;
            }

            $duracion_horas = (int) round(($fin_ts - $inicio_ts) / 3600);
            $duracion_horas = max(1, $duracion_horas);

            $indice_inicio = ((int) date('G', $inicio_ts)) - 13;

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
                <option value="" disabled selected>Selecciona</option>
                <option value="1">Primero</option>
                <option value="2">Segundo</option>
                <option value="3">Tercero</option>
                <option value="4">Cuarto</option>
                <option value="5">Quinto</option>
                <option value="6">Sexto</option>
                <option value="7">Septimo</option>
                <option value="8">Octavo</option>
            </select>
            <label for="grupo">Grupo</label>
            <select name="grupo" id="grupo">
                <option value="" disabled selected>Selecciona</option>
                <option value="A">A</option>
                <option value="B">B</option>
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