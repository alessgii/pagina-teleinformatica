<?php
/**
 * Vista: consulta de horarios.
 */
$semesters = [
    1 => "Primero", 2 => "Segundo", 3 => "Tercero", 4 => "Cuarto",
    5 => "Quinto", 6 => "Sexto", 7 => "Séptimo", 8 => "Octavo",
];
$groups = ["A", "B"];

$e = function ($text) {
    return htmlspecialchars((string) $text, ENT_QUOTES, "UTF-8");
};
?>

<style>#schedule-app,#schedule-app *,#schedule-app *::before,#schedule-app *::after{box-sizing:border-box}</style>

<section id="schedule-app" data-api-url="<?php echo BASE_URL; ?>api/horarios"
    class="box-border mx-auto w-full min-w-0 max-w-[min(72rem,100vw)] overflow-x-clip px-4 pt-6 pb-10 font-poppins text-text-main md:py-10">
    
    <header class="w-full min-w-0">
        <h1 class="text-2xl font-bold tracking-tight text-navy md:text-3xl">Consulta tu horario de clases</h1>
        <p class="mt-1 text-sm text-text-mid md:text-base">Selecciona tu semestre y grupo para visualizar tu carga académica.</p>
    </header>

    <!-- Tarjeta de Control / Trigger del Bottom Sheet -->
    <div class="mt-6 flex flex-col gap-4 rounded-custom border border-border-main bg-bg-card p-4 shadow-custom sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3.5">
            <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-turq-pale text-turq-acc">
                <svg class="size-6 text-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <span class="block text-xs font-semibold uppercase tracking-wider text-text-muted">Horario seleccionado</span>
                <p id="current-selection-label" class="text-base font-bold text-navy">Sin seleccionar</p>
            </div>
        </div>

        <button type="button" id="open-sheet-btn"
            aria-haspopup="dialog" aria-expanded="false" aria-controls="sheet-modal"
            class="inline-flex min-h-11 items-center justify-center gap-2 rounded-custom border-0 bg-navy px-5 py-2.5 text-sm font-semibold text-white-custom shadow-custom transition-all duration-150 hover:bg-navy-mid active:scale-95 focus-visible:outline-2 focus-visible:outline-turq-acc">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
            </svg>
            <span>Seleccionar horario</span>
        </button>
    </div>

    <!-- Formulario con datos sincronizados -->
    <form id="schedule-form" class="sr-only">
        <input type="hidden" name="semester" id="semestre" value="">
        <input type="hidden" name="group" id="grupo" value="A">
    </form>

    <p id="schedule-status" class="sr-only" role="status" aria-live="polite"></p>

    <!-- consulta_horarios.js reemplaza este contenido -->
    <div id="schedule-result" class="mt-6 w-full min-w-0" aria-busy="false">
        <p class="rounded-custom border border-dashed border-border-main bg-bg-card px-4 py-10 text-center text-sm text-text-mid">
            Elige un semestre para ver su horario.
        </p>
        <noscript>
            <p class="mt-3 text-center text-sm text-text-mid">Activa JavaScript para consultar el horario.</p>
        </noscript>
    </div>

    <!-- ===============================================================
         BOTTOM SHEET MODAL
    ================================================================ -->
    <div id="sheet-modal"
        class="fixed inset-0 z-50 pointer-events-none flex items-end justify-center sm:items-center sm:p-4"
        role="dialog" aria-modal="true" aria-labelledby="sheet-title" aria-hidden="true">

        <!-- Telón de fondo con Desenfoque (Backdrop) -->
        <div id="sheet-backdrop"
            class="fixed inset-0 bg-navy-mid/60 backdrop-blur-xs opacity-0 transition-opacity duration-300 ease-out"></div>

        <!-- Panel del Bottom Sheet -->
        <div id="sheet-panel"
            class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-t-3xl border border-border-main bg-bg-card p-6 shadow-custom-lg transition-all duration-300 ease-out translate-y-full opacity-0 sm:rounded-custom sm:translate-y-4 sm:scale-95">
            
            <!-- Barra superior para arrastre (Affordance táctil en móvil) -->
            <div class="mx-auto -mt-2 mb-4 h-1.5 w-12 rounded-full bg-border-main/80 sm:hidden"></div>

            <!-- Encabezado del modal -->
            <div class="flex items-center justify-between border-b border-border-lt pb-3">
                <div>
                    <h2 id="sheet-title" class="text-lg font-bold text-navy">Seleccionar Horario</h2>
                    <p class="text-xs text-text-mid">Elige tu semestre y grupo correspondiente</p>
                </div>
                <button type="button" id="close-sheet-btn"
                    class="flex size-9 items-center justify-center rounded-lg border-0 text-text-muted transition-colors hover:bg-border-lt hover:text-text-main focus-visible:outline-2 focus-visible:outline-turq-acc"
                    aria-label="Cerrar ventana">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Contenido del modal -->
            <div class="mt-5 space-y-5">
                <!-- Selector de Semestres (1° al 8°) -->
                <div>
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-wider text-text-muted">Semestre</span>
                    <div id="sheet-semesters" class="grid grid-cols-4 gap-2">
                        <?php foreach ($semesters as $number => $name): ?>
                            <button type="button"
                                data-semester="<?= $number ?>"
                                data-name="<?= $e($name) ?>"
                                class="sheet-semester-btn group flex flex-col items-center justify-center rounded-custom border border-border-main bg-bg-card p-2.5 text-center shadow-xs transition-all duration-150 hover:border-turq-acc hover:bg-turq-pale/40 focus-visible:outline-2 focus-visible:outline-turq-acc active:scale-95">
                                <span class="text-base font-bold text-text-main"><?= $number ?>°</span>
                                <span class="text-[10px] text-text-muted"><?= $e($name) ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Selector de Grupos (A / B) -->
                <div>
                    <span class="mb-2 block text-xs font-semibold uppercase tracking-wider text-text-muted">Grupo</span>
                    <div id="sheet-groups" class="grid grid-cols-2 gap-3">
                        <?php foreach ($groups as $letter): ?>
                            <button type="button"
                                data-group="<?= $letter ?>"
                                class="sheet-group-btn flex items-center justify-center rounded-custom border border-border-main bg-bg-card py-3 text-sm font-bold text-text-main shadow-xs transition-all duration-150 hover:border-turq-acc hover:bg-turq-pale/40 focus-visible:outline-2 focus-visible:outline-turq-acc active:scale-95">
                                Grupo <?= $letter ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="mt-6 flex gap-3 border-t border-border-lt pt-4">
                <button type="button" id="sheet-cancel-btn"
                    class="w-1/3 rounded-custom border border-border-main bg-bg-card py-3 text-sm font-semibold text-text-mid transition-all hover:bg-border-lt active:scale-95">
                    Cancelar
                </button>
                <button type="button" id="sheet-confirm-btn"
                    class="w-2/3 rounded-custom border border-navy bg-navy py-3 text-sm font-semibold text-white-custom shadow-custom transition-all hover:bg-navy-mid active:scale-95 focus-visible:outline-2 focus-visible:outline-turq-acc">
                    Ver Horario
                </button>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo BASE_URL; ?>public/js/consulta_horarios.js?v=3" defer></script>