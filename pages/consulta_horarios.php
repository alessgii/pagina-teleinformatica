<?php
//cargar coneccion con la base de datos
require_once("config/conn.php");

//revisar si hay una busqueda activa para decidir lo que se mostrara al cargar la pagina
$busqueda_activa = false;

//guardar el horario
$resultado = [];
$dias_semana = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"];
$horas_formateadas = ["1:00 PM", "2:00 PM", "3:00 PM", "4:00 PM", "5:00 PM", "6:00 PM", "7:00 PM", "8:00 PM", "9:00 PM"];


if (isset($_GET["semestre"]) && isset($_GET["grupo"])) {
    $busqueda_activa = true;
    $semestre = $_GET["semestre"];
    $grupo = $_GET["grupo"];

    // intentamos hacer la consulta
    try {

        // consulta SQL
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

    } catch (PDOException $e) {
        die("Error en la consulta SQL: " . $e->getCode());

    }
}

?>

<!-- Estilos de esta pagina -->
<link rel="stylesheet" href="public/css/pages/consulta_horarios.css">
<section class="main">
    <h1>Consulta tu horario de clases</h1>
    <h3>Selecciona tu semestre y grupo para poder ver tu horario.</h3>

    <!-- Filtro por grupos -->
    <div class="filtro">
        <form method="GET">
            <input type="hidden" name="page" value="consulta-de-horarios">
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
                <!-- Tabla 2 -->
                <table>
                    <thead>
                        <tr>
                            <th>DIA</th>
                            <th>HORA</th>
                            <th>MATERIA</th>
                            <th>SALON</th>
                            <th>MAESTRO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['dia']); ?> </td>
                                <td><?php echo htmlspecialchars($row['hora_inicio']); ?> </td>
                                <td><?php echo htmlspecialchars($row['materia']); ?> </td>
                                <td><?php echo htmlspecialchars($row['salon']); ?> </td>
                                <td><?php echo htmlspecialchars($row['maestro']); ?> </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php echo ($resultado['dia']); ?>
            <?php else: ?>
                <p class="aviso">No existe horario registrado para ese grupo</p>
            <?php endif; ?>
        <?php else: ?>
            <p class="aviso">Selecciona un semestre y un grupo para consultar su horario.</p>"
        <?php endif; ?>
    </div>
</section>