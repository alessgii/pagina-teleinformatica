<?php
// pages/feedback.php
// Encuesta de opinión sobre el portal - Ingeniería en Teleinformática, CUCSur
if (!defined('BASE_URL')) {
    @include_once __DIR__ . '/../config/config.php';
}
$portalBaseUrl = defined('BASE_URL') ? BASE_URL : '/pagina-teleinformatica/';

$roles = [
    'Estudiante'              => 'Estudiante',
    'Docente'                 => 'Docente',
    'Coordinador / Directivo' => 'Coordinación',
    'Aspirante / Externo'     => 'Aspirante o visitante',
];
$aspects = [
    'navigation'  => ['Navegación',       'Encontrar lo que buscas sin perderte en los menús.'],
    'visual'      => ['Diseño y lectura', 'Textos legibles, buen contraste y orden en la página.'],
    'performance' => ['Velocidad',        'Qué tan rápido cargan las páginas y los horarios.'],
    'mobile'      => ['Uso en celular',   'Comodidad al usar el portal desde teléfono o tableta.'],
];
$features = [
    'Horarios'    => 'Horarios',
    'Foros'       => 'Foros',
    'Noticias y avisos'    => 'Avisos y convocatorias',
    'Malla curricular'     => 'Malla curricular',
];
?>
<style>
.fb{--fb-navy:var(--color-navy,#0a3d6b);--fb-navy-mid:#0f4f8a;--fb-line:#d8e1ec;--fb-soft:#eef3f9;--fb-muted:#64748b;--fb-accent:#0891b2;
    max-width:680px;margin:0 auto;padding:2.5rem 1rem 4rem;color:var(--fb-navy)}
.fb *,.fb *::before,.fb *::after{box-sizing:border-box}
.fb :where(fieldset){border:0;margin:0;padding:0;min-width:0}
.fb legend{float:left;width:100%;padding:0}
.fb legend+*{clear:both}
.fb h1{font-size:clamp(1.9rem,5vw,2.6rem);line-height:1.1;font-weight:800;letter-spacing:-.02em;margin:0}
.fb-bar{width:48px;height:5px;border-radius:99px;background:linear-gradient(90deg,var(--fb-accent),#10b981);margin-bottom:1.1rem}
.fb-lead{margin:.9rem 0 0;font-size:1.05rem;line-height:1.6;color:#334e68;max-width:52ch}
.fb-progress{margin:1.75rem 0 1rem;display:flex;align-items:center;gap:.75rem;font-size:.85rem;color:var(--fb-muted)}
.fb-track{flex:1;height:6px;border-radius:99px;background:var(--fb-line);overflow:hidden}
.fb-fill{height:100%;width:0;background:linear-gradient(90deg,var(--fb-accent),#10b981);border-radius:99px;transition:width .35s ease}
.fb-card{background:#fff;border:1px solid var(--fb-line);border-radius:18px;padding:1.75rem;box-shadow:0 1px 2px rgba(10,61,107,.04),0 8px 24px -12px rgba(10,61,107,.12)}
.fb .fb-sec+.fb-sec{margin-top:2.75rem;padding-top:2.75rem;border-top:1px solid var(--fb-line)}
.fb .fb-q{font-size:1.4rem;line-height:1.2;font-weight:800;letter-spacing:-.015em;margin:0 0 .35rem;padding-left:.8rem;border-left:4px solid var(--fb-accent)}
.fb-hint{font-size:.92rem;color:#6b7f96;margin:0 0 1.1rem;line-height:1.45}
.fb .fb-q+.fb-hint{padding-left:calc(.8rem + 4px)}
.fb-item{font-size:1rem;font-weight:600;color:#1e3a5f}
.fb-rates{background:var(--fb-soft);border-radius:14px;padding:.25rem 1.25rem}
.fb-chips{display:flex;flex-wrap:wrap;gap:.5rem}
.fb-opt{position:relative;cursor:pointer;display:block}
.fb-opt input{position:absolute;opacity:0;width:1px;height:1px;margin:0}
.fb-opt span{display:block;padding:.65rem 1rem;border:1.5px solid var(--fb-line);border-radius:10px;background:#fff;font-size:.95rem;font-weight:500;color:#23415f;transition:background .15s,border-color .15s,color .15s,transform .1s}
.fb-opt:hover span{border-color:var(--fb-navy);background:var(--fb-soft)}
.fb-opt input:checked+span{background:var(--fb-navy);border-color:var(--fb-navy);color:#fff;font-weight:700}
.fb-opt input:active+span{transform:scale(.97)}
.fb-opt input:focus-visible+span{outline:3px solid var(--fb-accent);outline-offset:2px}
.fb .fb-rate{padding:1.35rem 0}
.fb .fb-rate+.fb-rate{border-top:1px solid #dbe5f0}
.fb-scale{display:grid;grid-template-columns:repeat(5,1fr);gap:.4rem;max-width:340px}
.fb-scale .fb-opt span{text-align:center;padding:.7rem 0;font-weight:600}
.fb-ends{display:flex;justify-content:space-between;max-width:340px;margin-top:.45rem;font-size:.75rem;color:#7a8ea6}
.fb textarea{display:block;width:100%;border:1.5px solid var(--fb-line);border-radius:12px;padding:.85rem 1rem;font:inherit;font-size:1rem;line-height:1.5;color:var(--fb-navy);background:#fff;resize:vertical}
.fb textarea:focus{outline:3px solid rgba(8,145,178,.25);border-color:var(--fb-accent)}
.fb-count{font-size:.8rem;color:var(--fb-muted);text-align:right;margin-top:.35rem}
.fb-error{margin-top:1.25rem;padding:.8rem 1rem;border-radius:10px;background:#fff1f2;border:1px solid #fecdd3;color:#9f1239;font-size:.95rem;font-weight:600}
.fb-error[hidden],.fb [hidden]{display:none}
.fb-actions{display:flex;align-items:center;gap:.75rem;margin-top:1.75rem;flex-wrap:wrap}
.fb-btn{font:inherit;font-weight:700;font-size:1rem;border-radius:10px;padding:.85rem 1.5rem;cursor:pointer;border:1.5px solid transparent;text-decoration:none;display:inline-block;transition:background .15s,border-color .15s}
.fb-btn-primary{background:var(--fb-navy);color:#fff}
.fb-btn-primary:hover{background:var(--fb-navy-mid)}
.fb-btn-primary:disabled{opacity:.55;cursor:default}
.fb-btn-ghost{background:transparent;color:#475f7b}
.fb-btn-ghost:hover{color:var(--fb-navy)}
.fb-btn-line{background:#fff;color:var(--fb-navy);border-color:var(--fb-line)}
.fb-btn-line:hover{border-color:var(--fb-navy)}
.fb-btn:focus-visible{outline:3px solid var(--fb-accent);outline-offset:2px}
.fb-done-icon{width:52px;height:52px;border-radius:50%;background:#d1fae5;color:#047857;display:flex;align-items:center;justify-content:center;margin-bottom:1.1rem}
@media (max-width:520px){.fb-card{padding:1.25rem}.fb-btn-primary{width:100%}}
@media (prefers-reduced-motion:reduce){.fb *{transition:none!important}}
</style>

<div class="fb">
    <header>
        <div class="fb-bar"></div>
        <h1>Ayúdanos a mejorar el portal</h1>
        <p class="fb-lead">Son cuatro calificaciones y algunas preguntas opcionales. Toma unos 2 minutos y es anónima: no guardamos tu nombre ni tu IP.</p>
    </header>

    <form id="ux-feedback-form" novalidate>
        <div class="fb-progress" aria-live="polite">
            <span id="progress-text">0 de 5 respondidas</span>
            <div class="fb-track"><div id="progress-bar" class="fb-fill"></div></div>
        </div>

        <div class="fb-card">
            <fieldset class="fb-sec">
                <legend class="fb-q">¿Cómo usas el portal?</legend>
                <div class="fb-chips">
                    <?php foreach ($roles as $value => $label): ?>
                        <label class="fb-opt">
                            <input type="radio" name="role" value="<?php echo htmlspecialchars($value); ?>">
                            <span><?php echo htmlspecialchars($label); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <section class="fb-sec">
                <h2 class="fb-q">Califica del 1 al 5</h2>
                <p class="fb-hint">Elige un número en cada aspecto.</p>
                <div class="fb-rates">
                <?php foreach ($aspects as $key => [$title, $hint]): ?>
                    <fieldset class="fb-rate">
                        <legend class="fb-item"><?php echo $title; ?></legend>
                        <p class="fb-hint" style="margin:.15rem 0 .8rem"><?php echo $hint; ?></p>
                        <div class="fb-scale">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <label class="fb-opt">
                                    <input type="radio" name="<?php echo $key; ?>" value="<?php echo $i; ?>" aria-label="<?php echo "$i de 5 en $title"; ?>">
                                    <span><?php echo $i; ?></span>
                                </label>
                            <?php endfor; ?>
                        </div>
                        <div class="fb-ends"><span>Deficiente</span><span>Excelente</span></div>
                    </fieldset>
                <?php endforeach; ?>
                </div>
            </section>

            <fieldset class="fb-sec">
                <legend class="fb-q">¿Qué deberíamos mejorar primero?</legend>
                <p class="fb-hint">Opcional. Elige todo lo que quieras.</p>
                <div class="fb-chips">
                    <?php foreach ($features as $value => $label): ?>
                        <label class="fb-opt">
                            <input type="checkbox" name="priorities" value="<?php echo htmlspecialchars($value); ?>">
                            <span><?php echo htmlspecialchars($label); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </fieldset>

            <div class="fb-sec">
                <label for="feedback-comments" class="fb-q" style="display:block">¿Algo más que quieras decirnos?</label>
                <p class="fb-hint">Opcional. Un problema que viste, algo confuso o una idea.</p>
                <textarea id="feedback-comments" rows="4" maxlength="450" placeholder="Por ejemplo: en el celular, la tabla de horarios se corta a la derecha."></textarea>
                <div class="fb-count" id="char-counter">0 / 450</div>
            </div>
        </div>

        <p id="form-error" class="fb-error" role="alert" hidden></p>

        <div class="fb-actions">
            <button type="submit" id="submit-btn" class="fb-btn fb-btn-primary"><span id="submit-btn-text">Enviar opinión</span></button>
            <button type="button" id="reset-btn" class="fb-btn fb-btn-ghost">Borrar respuestas</button>
        </div>
    </form>

    <section id="success-view" hidden aria-live="polite" style="margin-top:2rem">
        <div class="fb-card">
            <div class="fb-done-icon">
                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            </div>
            <h2 style="font-size:1.8rem;font-weight:800;letter-spacing:-.01em;margin:0">Gracias, recibimos tu opinión</h2>
            <p class="fb-lead">Usaremos los resultados de todas las respuestas para decidir qué mejorar primero en el portal.</p>
            <div class="fb-actions">
                <a href="<?php echo $portalBaseUrl; ?>inicio" class="fb-btn fb-btn-primary">Volver al inicio</a>
                <button type="button" id="again-btn" class="fb-btn fb-btn-line">Enviar otra respuesta</button>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    const baseUrl = "<?php echo $portalBaseUrl; ?>";
    const form = document.getElementById('ux-feedback-form');
    const successView = document.getElementById('success-view');
    const errorBox = document.getElementById('form-error');
    const comments = document.getElementById('feedback-comments');
    const counter = document.getElementById('char-counter');
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-btn-text');
    const aspects = ['navigation', 'visual', 'performance', 'mobile'];
    const required = ['role', ...aspects];

    const checked = (name) => form.querySelector(`input[name="${name}"]:checked`);

    function updateProgress() {
        const done = required.filter((n) => checked(n)).length;
        document.getElementById('progress-text').textContent = `${done} de ${required.length} respondidas`;
        document.getElementById('progress-bar').style.width = `${(done / required.length) * 100}%`;
    }
    function showError(message) {
        errorBox.textContent = message;
        errorBox.hidden = false;
        errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    function clearError() { errorBox.hidden = true; }

    comments.addEventListener('input', () => { counter.textContent = `${comments.value.length} / 450`; });
    form.addEventListener('change', () => { clearError(); updateProgress(); });
    form.addEventListener('reset', () => { counter.textContent = '0 / 450'; clearError(); setTimeout(updateProgress, 0); });
    document.getElementById('reset-btn').addEventListener('click', () => form.reset());

    document.getElementById('again-btn').addEventListener('click', () => {
        form.reset();
        successView.hidden = true;
        form.hidden = false;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        clearError();

        const role = checked('role');
        if (!role) return showError('Elige cómo usas el portal.');

        const ratings = {};
        let missing = 0;
        aspects.forEach((key) => {
            const input = checked(key);
            ratings[key] = input ? Number(input.value) : null;
            if (!input) missing++;
        });
        if (missing) return showError(`Falta calificar ${missing === 1 ? '1 aspecto' : missing + ' aspectos'}.`);

        const payload = {
            role: role.value,
            ratings,
            priorities: Array.from(form.querySelectorAll('input[name="priorities"]:checked')).map((i) => i.value),
            comments: comments.value.trim() || null
        };

        submitBtn.disabled = true;
        submitText.textContent = 'Enviando…';
        try {
            const response = await fetch(`${baseUrl}api/feedback`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json; charset=utf-8' },
                credentials: 'same-origin',
                body: JSON.stringify(payload)
            });
            const result = await response.json();
            if (response.ok && result.success) {
                form.hidden = true;
                successView.hidden = false;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                showError(result.message || 'No pudimos guardar tu respuesta. Inténtalo de nuevo.');
            }
        } catch (err) {
            showError('No hay conexión con el servidor. Revisa tu internet e inténtalo de nuevo.');
        } finally {
            submitBtn.disabled = false;
            submitText.textContent = 'Enviar opinión';
        }
    });

    updateProgress();
})();
</script>