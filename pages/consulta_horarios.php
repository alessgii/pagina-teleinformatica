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
                <option value="A">B</option>
                <option value="B">A</option>
            </select>
            <button>Consultar</button>
        </form>

    </div>

    <!-- Tabla del horario -->
    <div class="horario">
        <p>Selecciona un semestre y un grupo para consultar su horario.</p>"
    </div>
</section>