(() => {
    'use strict';

    const DAYS = [
        { number: 1, name: 'Lunes', short: 'Lun' },
        { number: 2, name: 'Martes', short: 'Mar' },
        { number: 3, name: 'Miércoles', short: 'Mié' },
        { number: 4, name: 'Jueves', short: 'Jue' },
        { number: 5, name: 'Viernes', short: 'Vie' },
    ];

    const SEMESTER_NAMES = {
        '1': 'Primero',
        '2': 'Segundo',
        '3': 'Tercero',
        '4': 'Cuarto',
        '5': 'Quinto',
        '6': 'Sexto',
        '7': 'Séptimo',
        '8': 'Octavo',
    };

    const TIMEZONE = 'America/Mexico_City';
    const STORAGE_KEY = 'horario:seleccion';
    const DEFAULT_FIRST_HOUR = 13; // 1:00 PM
    const DEFAULT_LAST_HOUR = 20;  // 8:00 PM
    const MIN_GAP = 30;
    const SWIPE_MIN_PX = 50;

    const SUBJECT_STYLES = [
        'border-l-navy bg-navy/10',
        'border-l-turq-acc bg-turq-pale',
        'border-l-green-lt bg-green-pale',
        'border-l-text-muted bg-border-lt',
    ];

    const PIN_ICON =
        '<svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-3.5">' +
        '<path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd"/>' +
        '</svg>';

    /* ---------------------------------------------------------------
     * Elementos del DOM
     * ------------------------------------------------------------- */
    const root = document.getElementById('schedule-app');
    if (!root) return;

    const form = document.getElementById('schedule-form');
    const semesterInput = document.getElementById('semestre');
    const groupInput = document.getElementById('grupo');
    const resultBox = document.getElementById('schedule-result');
    const statusBox = document.getElementById('schedule-status');
    const selectionLabel = document.getElementById('current-selection-label');

    // Elementos del Bottom Sheet Modal
    const sheetModal = document.getElementById('sheet-modal');
    const sheetBackdrop = document.getElementById('sheet-backdrop');
    const sheetPanel = document.getElementById('sheet-panel');
    const openSheetBtn = document.getElementById('open-sheet-btn');
    const closeSheetBtn = document.getElementById('close-sheet-btn');
    const cancelSheetBtn = document.getElementById('sheet-cancel-btn');
    const confirmSheetBtn = document.getElementById('sheet-confirm-btn');
    const sheetSemesterBtns = document.querySelectorAll('.sheet-semester-btn');
    const sheetGroupBtns = document.querySelectorAll('.sheet-group-btn');

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const apiUrl = root.dataset.apiUrl;

    // Estado temporal dentro del Bottom Sheet
    let tempSemester = '';
    let tempGroup = 'A';
    let isSheetOpen = false;

    /* ---------------------------------------------------------------
     * Utilidades
     * ------------------------------------------------------------- */
    function el(tag, className, text) {
        const node = document.createElement(tag);
        if (className) node.className = className;
        if (text !== undefined) node.textContent = text;
        return node;
    }

    function formatTime(minutes) {
        const h = Math.floor(minutes / 60);
        const m = minutes % 60;
        return `${h % 12 || 12}:${String(m).padStart(2, '0')} ${h >= 12 ? 'PM' : 'AM'}`;
    }

    function formatGap(minutes) {
        const h = Math.floor(minutes / 60);
        const m = minutes % 60;
        const parts = [];
        if (h > 0) parts.push(`${h} h`);
        if (m > 0) parts.push(`${m} min`);
        return parts.join(' ') + (minutes === 60 ? ' libre' : ' libres');
    }

    function nowInMexico() {
        const parts = new Intl.DateTimeFormat('en-US', {
            timeZone: TIMEZONE,
            weekday: 'short',
            hour: 'numeric',
            minute: 'numeric',
            hourCycle: 'h23',
        }).formatToParts(new Date());
        const get = (type) => parts.find((p) => p.type === type).value;
        const dayMap = { Mon: 1, Tue: 2, Wed: 3, Thu: 4, Fri: 5, Sat: 6, Sun: 7 };
        return {
            day: dayMap[get('weekday')],
            minutes: (parseInt(get('hour'), 10) % 24) * 60 + parseInt(get('minute'), 10),
        };
    }

    function roomChip(room) {
        const chip = el('span', 'inline-flex items-center gap-1 rounded-md bg-navy px-2 py-0.5 text-xs font-semibold text-white-custom');
        const icon = el('span', 'inline-flex');
        icon.innerHTML = PIN_ICON;
        chip.append(icon, document.createTextNode(room));
        return chip;
    }

    /* ---------------------------------------------------------------
     * Gestión del Bottom Sheet Modal
     * ------------------------------------------------------------- */
    function renderSheetOptionStyles() {
        sheetSemesterBtns.forEach((btn) => {
            const isSelected = btn.dataset.semester === tempSemester;
            const numberSpan = btn.children[0];
            const nameSpan = btn.children[1];

            if (isSelected) {
                btn.className = 'sheet-semester-btn group flex flex-col items-center justify-center rounded-custom border border-navy bg-navy p-2.5 text-center shadow-custom transition-all duration-150 active:scale-95';
                numberSpan.className = 'text-base font-bold text-white-custom';
                nameSpan.className = 'text-[10px] text-white-custom/80';
            } else {
                btn.className = 'sheet-semester-btn group flex flex-col items-center justify-center rounded-custom border border-border-main bg-bg-card p-2.5 text-center shadow-xs transition-all duration-150 hover:border-turq-acc hover:bg-turq-pale/40 focus-visible:outline-2 focus-visible:outline-turq-acc active:scale-95';
                numberSpan.className = 'text-base font-bold text-text-main';
                nameSpan.className = 'text-[10px] text-text-muted';
            }
        });

        sheetGroupBtns.forEach((btn) => {
            const isSelected = btn.dataset.group === tempGroup;
            if (isSelected) {
                btn.className = 'sheet-group-btn flex items-center justify-center rounded-custom border border-navy bg-navy py-3 text-sm font-bold text-white-custom shadow-custom transition-all duration-150 active:scale-95';
            } else {
                btn.className = 'sheet-group-btn flex items-center justify-center rounded-custom border border-border-main bg-bg-card py-3 text-sm font-bold text-text-main shadow-xs transition-all duration-150 hover:border-turq-acc hover:bg-turq-pale/40 focus-visible:outline-2 focus-visible:outline-turq-acc active:scale-95';
            }
        });
    }

    function updateSummaryCard() {
        if (!semesterInput.value) {
            selectionLabel.textContent = 'Sin seleccionar';
            return;
        }
        const name = SEMESTER_NAMES[semesterInput.value] || `${semesterInput.value}°`;
        selectionLabel.textContent = `${name} — Grupo ${groupInput.value}`;
    }

    function openSheet() {
        tempSemester = semesterInput.value || '';
        tempGroup = groupInput.value || 'A';
        renderSheetOptionStyles();

        isSheetOpen = true;
        sheetModal.classList.remove('pointer-events-none');
        sheetModal.setAttribute('aria-hidden', 'false');
        openSheetBtn.setAttribute('aria-expanded', 'true');
        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(() => {
            sheetBackdrop.classList.remove('opacity-0');
            sheetBackdrop.classList.add('opacity-100');

            sheetPanel.classList.remove('translate-y-full', 'opacity-0', 'sm:scale-95', 'sm:translate-y-4');
            sheetPanel.classList.add('translate-y-0', 'opacity-100', 'sm:scale-100', 'sm:translate-y-0');
        });
    }

    function closeSheet() {
        isSheetOpen = false;
        sheetModal.setAttribute('aria-hidden', 'true');
        openSheetBtn.setAttribute('aria-expanded', 'false');

        sheetBackdrop.classList.remove('opacity-100');
        sheetBackdrop.classList.add('opacity-0');

        sheetPanel.classList.remove('translate-y-0', 'opacity-100', 'sm:scale-100', 'sm:translate-y-0');
        sheetPanel.classList.add('translate-y-full', 'opacity-0', 'sm:scale-95', 'sm:translate-y-4');

        setTimeout(() => {
            if (!isSheetOpen) {
                sheetModal.classList.add('pointer-events-none');
                document.body.classList.remove('overflow-hidden');
            }
        }, 300);

        openSheetBtn.focus();
    }

    /* ---------------------------------------------------------------
     * Vistas de Horario (Móvil y Escritorio)
     * ------------------------------------------------------------- */
    function groupByDay(classes) {
        const byDay = {};
        DAYS.forEach((d) => { byDay[d.number] = []; });
        classes.forEach((c) => {
            if (byDay[c.day]) byDay[c.day].push(c);
        });
        return byDay;
    }

    function assignStyles(classes) {
        const styles = new Map();
        classes.forEach((c) => {
            if (!styles.has(c.subject)) {
                styles.set(c.subject, SUBJECT_STYLES[styles.size % SUBJECT_STYLES.length]);
            }
        });
        return styles;
    }

    function buildDayList(list, styles, nowMinutes) {
        const ol = el('ol', 'm-0 w-full min-w-0 max-w-full list-none p-0 space-y-2.5');
        let previousEnd = null;

        list.forEach((c) => {
            if (previousEnd !== null && c.start - previousEnd >= MIN_GAP) {
                const gap = el('li', 'flex w-full min-w-0 items-center gap-2 overflow-hidden text-xs text-text-mid');
                gap.append(
                    el('span', 'w-14 sm:w-16 shrink-0'),
                    el('span', 'h-px flex-1 min-w-2 bg-border-main'),
                    el('span', 'shrink-0 text-[11px] sm:text-xs font-medium text-text-muted', formatGap(c.start - previousEnd)),
                    el('span', 'h-px flex-1 min-w-2 bg-border-main')
                );
                ol.appendChild(gap);
            }

            const inProgress = nowMinutes !== null && nowMinutes >= c.start && nowMinutes < c.end_effective;
            const item = el('li', 'flex w-full min-w-0 gap-2 sm:gap-2.5 items-start');

            const time = el('div', 'w-14 sm:w-16 shrink-0 pt-3 text-right leading-tight min-w-0');
            time.append(
                el('p', 'text-xs sm:text-sm font-semibold text-text-main', formatTime(c.start)),
                el('p', 'text-[11px] sm:text-xs text-text-mid', formatTime(c.end))
            );

            const card = el(
                'div',
                'min-w-0 max-w-full flex-1 overflow-hidden rounded-custom border border-l-4 border-border-main p-2.5 sm:p-3 shadow-xs transition-shadow ' +
                styles.get(c.subject) +
                (inProgress ? ' ring-2 ring-inset ring-green' : '')
            );
            card.append(
                el('p', 'text-sm sm:text-base font-semibold leading-snug text-text-main [overflow-wrap:anywhere]', c.subject),
                el('p', 'mt-0.5 text-xs sm:text-sm text-text-mid [overflow-wrap:anywhere]', c.teacher)
            );

            const meta = el('div', 'mt-2 flex flex-wrap items-center gap-1.5 sm:gap-2');
            meta.appendChild(roomChip(c.room));
            if (inProgress) {
                meta.appendChild(el('span', 'inline-flex rounded-full bg-green px-2 py-0.5 text-xs font-bold text-navy-mid', 'En curso'));
            }
            card.appendChild(meta);

            item.append(time, card);
            ol.appendChild(item);
            previousEnd = c.end_effective;
        });

        return ol;
    }

    function buildMobileView(byDay, styles, now) {
        const wrap = el('div', 'w-full min-w-0 max-w-full overflow-x-clip touch-pan-y md:hidden');
        wrap.style.touchAction = 'pan-y';

        const tablist = el('div', 'flex min-w-0 items-stretch gap-1 rounded-custom border border-border-main/80 bg-border-lt/70 p-1 shadow-xs box-border');
        tablist.setAttribute('role', 'tablist');
        tablist.setAttribute('aria-label', 'Días de la semana');
        wrap.appendChild(tablist);

        const isWeekday = now.day >= 1 && now.day <= 5;
        const initial = isWeekday ? now.day - 1 : 0;
        const tabs = [];
        const panels = [];

        const select = (index, focus) => {
            tabs.forEach((tab, i) => {
                const active = i === index;
                tab.setAttribute('aria-selected', active ? 'true' : 'false');
                tab.tabIndex = active ? 0 : -1;
                panels[i].classList.toggle('hidden', !active);
            });
            if (focus) tabs[index].focus();
        };

        DAYS.forEach((day, i) => {
            const isToday = day.number === now.day;
            const list = byDay[day.number];

            const tab = el(
                'button',
                'relative flex h-10 w-0 min-w-0 flex-1 items-center justify-center rounded-xl border border-transparent px-1 py-1 text-xs font-semibold text-text-mid transition-all duration-200 select-none hover:bg-bg-card/80 hover:text-navy focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-turq-acc aria-selected:border-navy aria-selected:bg-navy aria-selected:text-white-custom aria-selected:shadow-custom'
            );
            tab.type = 'button';
            tab.id = `schedule-tab-${day.number}`;
            tab.setAttribute('role', 'tab');
            tab.setAttribute('aria-controls', `schedule-panel-${day.number}`);
            tab.setAttribute('aria-label', isToday ? `${day.name} (hoy)` : day.name);

            tab.append(
                el('span', 'block w-full truncate text-center sm:hidden', day.short),
                el('span', 'hidden w-full truncate text-center sm:block', day.name)
            );

            if (isToday) {
                tab.appendChild(el('span', 'absolute right-1 top-1 size-1.5 rounded-full bg-green ring-1 ring-white-custom/60 sm:right-1.5 sm:top-1.5'));
            }

            tab.addEventListener('click', () => select(i, false));
            tab.addEventListener('keydown', (ev) => {
                let target = null;
                if (ev.key === 'ArrowRight') target = (i + 1) % DAYS.length;
                else if (ev.key === 'ArrowLeft') target = (i - 1 + DAYS.length) % DAYS.length;
                else if (ev.key === 'Home') target = 0;
                else if (ev.key === 'End') target = DAYS.length - 1;
                if (target === null) return;
                ev.preventDefault();
                select(target, true);
            });
            tabs.push(tab);
            tablist.appendChild(tab);

            const panel = el('div', 'mt-4 w-full min-w-0 animate-fade-in motion-reduce:animate-none');
            panel.id = `schedule-panel-${day.number}`;
            panel.setAttribute('role', 'tabpanel');
            panel.setAttribute('aria-labelledby', tab.id);
            panel.tabIndex = 0;

            if (list.length === 0) {
                panel.appendChild(
                    el('p', 'rounded-custom border border-dashed border-border-main bg-bg-card px-4 py-8 text-center text-sm text-text-mid', 'No tienes clases este día.')
                );
            } else {
                const last = list[list.length - 1];
                const count = `${list.length} ${list.length === 1 ? 'clase' : 'clases'}`;
                panel.append(
                    el('p', 'mb-3 text-sm text-text-mid font-medium', `${count}, de ${formatTime(list[0].start)} a ${formatTime(last.end)}`),
                    buildDayList(list, styles, isToday ? now.minutes : null)
                );
            }

            panels.push(panel);
            wrap.appendChild(panel);
        });

        select(initial, false);

        // Soporte Swipe en móvil
        let startX = 0;
        let startY = 0;
        wrap.addEventListener('touchstart', (ev) => {
            startX = ev.changedTouches[0].clientX;
            startY = ev.changedTouches[0].clientY;
        }, { passive: true });

        wrap.addEventListener('touchend', (ev) => {
            const dx = ev.changedTouches[0].clientX - startX;
            const dy = ev.changedTouches[0].clientY - startY;
            if (Math.abs(dx) < SWIPE_MIN_PX || Math.abs(dx) < Math.abs(dy) * 1.5) return;
            const current = tabs.findIndex((t) => t.getAttribute('aria-selected') === 'true');
            const next = current + (dx < 0 ? 1 : -1);
            if (next >= 0 && next < DAYS.length) select(next, false);
        }, { passive: true });

        return wrap;
    }

    function buildDesktopView(classes, byDay, styles, now, title) {
        let firstHour = DEFAULT_FIRST_HOUR;
        let lastHour = DEFAULT_LAST_HOUR;
        classes.forEach((c) => {
            firstHour = Math.min(firstHour, Math.floor(c.start / 60));
            lastHour = Math.max(lastHour, Math.ceil(c.end_effective / 60) - 1);
        });
        const totalRows = lastHour - firstHour + 1;

        const grid = {};
        DAYS.forEach((d) => {
            grid[d.number] = {};
            byDay[d.number].forEach((c) => {
                const startHour = Math.floor(c.start / 60);
                const index = startHour - firstHour;
                const rows = Math.max(1, Math.ceil(c.end_effective / 60) - startHour);
                grid[d.number][index] = { type: 'start', cls: c, rowspan: rows };
                for (let i = 1; i < rows; i++) {
                    if (index + i < totalRows) grid[d.number][index + i] = { type: 'busy' };
                }
            });
        });

        const wrap = el('div', 'hidden w-full max-w-full md:block');
        const scroller = el('div', 'max-h-[80vh] overflow-auto rounded-custom border border-border-main bg-bg-card shadow-custom');
        const table = el('table', 'w-full table-fixed border-separate border-spacing-0 text-left');
        table.appendChild(el('caption', 'sr-only', `Horario semanal de ${title}`));

        const headRow = el('tr');
        headRow.appendChild(
            el('th', 'sticky left-0 top-0 z-30 w-24 border-b border-r border-border-main bg-bg-main px-2 py-3 text-right text-xs font-semibold text-text-mid', 'Hora')
        ).scope = 'col';

        DAYS.forEach((day, i) => {
            const th = el(
                'th',
                'sticky top-0 z-20 border-b border-border-main px-2 py-3 text-center text-sm font-semibold ' +
                (i < DAYS.length - 1 ? 'border-r ' : '') +
                (day.number === now.day ? 'bg-navy text-white-custom' : 'bg-bg-main text-text-main'),
                day.name
            );
            th.scope = 'col';
            headRow.appendChild(th);
        });
        table.appendChild(el('thead')).appendChild(headRow);

        const tbody = el('tbody');
        for (let f = 0; f < totalRows; f++) {
            const tr = el('tr');

            const rowHead = el(
                'th',
                'sticky left-0 z-10 whitespace-nowrap border-b border-r border-border-main bg-bg-main px-2 py-2 text-right align-top text-xs font-medium text-text-mid',
                formatTime((firstHour + f) * 60)
            );
            rowHead.scope = 'row';
            tr.appendChild(rowHead);

            DAYS.forEach((day, i) => {
                const cell = grid[day.number][f];
                const edge = i < DAYS.length - 1 ? ' border-r' : '';

                if (!cell) {
                    const td = el('td', 'h-20 border-b border-border-main' + edge);
                    td.setAttribute('aria-hidden', 'true');
                    tr.appendChild(td);
                    return;
                }
                if (cell.type === 'busy') return;

                const c = cell.cls;
                const td = el('td', 'border-b border-l-4 border-border-main p-2 align-top transition-colors' + edge + ' ' + styles.get(c.subject));
                td.rowSpan = cell.rowspan;
                td.title = `${c.subject} - ${c.teacher} (${formatTime(c.start)} a ${formatTime(c.end)})`;

                td.appendChild(el('p', 'break-words text-sm font-semibold leading-snug text-text-main', c.subject));
                if (cell.rowspan >= 2) {
                    td.appendChild(el('p', 'mt-0.5 break-words text-xs text-text-mid', c.teacher));
                }
                const chipWrap = el('div', 'mt-1.5');
                chipWrap.appendChild(roomChip(c.room));
                td.appendChild(chipWrap);
                tr.appendChild(td);
            });

            tbody.appendChild(tr);
        }

        const closingHour = lastHour + 1;
        const closingTr = el('tr', 'border-t-2 border-border-main');
        const closingHead = el(
            'th',
            'sticky left-0 z-10 whitespace-nowrap border-r border-border-main bg-bg-main px-2 py-1.5 text-right align-middle text-xs font-medium text-text-mid',
            formatTime(closingHour * 60)
        );
        closingHead.scope = 'row';
        closingTr.appendChild(closingHead);

        DAYS.forEach((day, i) => {
            const edge = i < DAYS.length - 1 ? ' border-r' : '';
            const td = el('td', 'h-3 bg-bg-main/30' + edge);
            td.setAttribute('aria-hidden', 'true');
            closingTr.appendChild(td);
        });
        tbody.appendChild(closingTr);

        table.appendChild(tbody);
        scroller.appendChild(table);
        wrap.appendChild(scroller);
        return wrap;
    }

    /* ---------------------------------------------------------------
     * Estados de Interfaz
     * ------------------------------------------------------------- */
    function announce(text) {
        statusBox.textContent = text;
    }

    function showMessage(text, retry) {
        resultBox.replaceChildren();
        const box = el('div', 'w-full rounded-custom border border-dashed border-border-main bg-bg-card px-4 py-10 text-center');
        box.appendChild(el('p', 'text-sm text-text-mid', text));
        if (retry) {
            const button = el(
                'button',
                'mt-4 inline-flex min-h-11 items-center justify-center rounded-custom border border-navy bg-navy px-6 py-2.5 text-sm font-semibold text-white-custom shadow-custom transition-all duration-200 hover:bg-navy-mid hover:shadow-custom-lg focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-turq-acc active:scale-[0.98]',
                'Reintentar'
            );
            button.type = 'button';
            button.addEventListener('click', retry);
            box.appendChild(button);
        }
        resultBox.appendChild(box);
    }

    function showSkeleton() {
        resultBox.replaceChildren();
        const box = el('div', 'w-full animate-pulse space-y-3 motion-reduce:animate-none');
        box.setAttribute('aria-hidden', 'true');
        box.appendChild(el('div', 'h-12 rounded-custom bg-border-lt'));
        for (let i = 0; i < 4; i++) {
            box.appendChild(el('div', 'h-24 rounded-custom bg-border-lt'));
        }
        resultBox.appendChild(box);
    }

    function focusSchedule(heading) {
        heading.tabIndex = -1;
        heading.focus({ preventScroll: true });
    }

    function scrollToSchedule() {
        resultBox.style.scrollMarginTop = '5rem';
        resultBox.scrollIntoView({
            behavior: reduceMotion.matches ? 'auto' : 'smooth',
            block: 'start',
        });
    }

    function render(data, title) {
        resultBox.replaceChildren();

        if (data.classes.length === 0) {
            showMessage(`No hay horario registrado para ${title}.`);
            announce(`Sin horario para ${title}.`);
            return;
        }

        const byDay = groupByDay(data.classes);
        const styles = assignStyles(data.classes);
        const now = nowInMexico();

        const container = el('div', 'w-full min-w-0 max-w-full overflow-x-clip animate-fade-in-up motion-reduce:animate-none');
        const heading = el('h2', 'mb-3 text-lg font-semibold text-navy outline-none', `Horario de ${title}`);
        container.append(
            heading,
            buildMobileView(byDay, styles, now),
            buildDesktopView(data.classes, byDay, styles, now, title)
        );
        resultBox.appendChild(container);
        announce(`Horario de ${title} cargado.`);
        if (focusAfterRender) {
            focusAfterRender = false;
            focusSchedule(heading);
        }
    }

    /* ---------------------------------------------------------------
     * Petición de datos
     * ------------------------------------------------------------- */
    let currentRequest = null;
    let focusAfterRender = false;

    async function load() {
        const semester = semesterInput.value;
        const group = groupInput.value;

        if (!semester) {
            showMessage('Elige un semestre para ver su horario.');
            return;
        }

        if (currentRequest) currentRequest.abort();
        const request = new AbortController();
        currentRequest = request;

        const semesterName = SEMESTER_NAMES[semester] || `${semester}°`;
        const title = `${semesterName} ${group}`;
        resultBox.setAttribute('aria-busy', 'true');
        announce('Cargando horario...');
        showSkeleton();

        try {
            const query = new URLSearchParams({ semester: semester, group: group });
            const response = await fetch(`${apiUrl}?${query}`, {
                headers: { Accept: 'application/json' },
                signal: request.signal,
            });
            const body = await response.json().catch(() => null);
            if (!response.ok || !body || !body.success) {
                throw new Error((body && body.message) || 'No se pudo cargar el horario.');
            }
            render(body.data, title);
        } catch (err) {
            if (request.signal.aborted) return;
            const message = err instanceof TypeError
                ? 'No se pudo conectar. Revisa tu conexión e inténtalo de nuevo.'
                : err.message;
            showMessage(message, load);
            announce(message);
        } finally {
            if (currentRequest === request) resultBox.setAttribute('aria-busy', 'false');
        }
    }

    /* ---------------------------------------------------------------
     * Persistencia y Sincronización
     * ------------------------------------------------------------- */
    function restoreSelection() {
        const params = new URLSearchParams(window.location.search);
        let semester = params.get('semestre');
        let group = params.get('grupo');

        if (!semester) {
            try {
                const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || 'null');
                if (saved) {
                    semester = saved.semestre;
                    group = saved.grupo;
                }
            } catch (e) { }
        }

        if (semester && SEMESTER_NAMES[semester]) {
            semesterInput.value = String(semester);
        }
        if (group && (group.toUpperCase() === 'A' || group.toUpperCase() === 'B')) {
            groupInput.value = group.toUpperCase();
        }

        updateSummaryCard();
    }

    function saveSelection() {
        const semester = semesterInput.value;
        const group = groupInput.value;

        const url = new URL(window.location.href);
        if (semester) url.searchParams.set('semestre', semester);
        if (group) url.searchParams.set('grupo', group);
        window.history.replaceState(null, '', url);

        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify({ semestre: semester, grupo: group }));
        } catch (e) { }
    }

    /* ---------------------------------------------------------------
     * Listeners de Eventos
     * ------------------------------------------------------------- */
    form.addEventListener('submit', (ev) => ev.preventDefault());

    // Abrir y Cerrar Sheet
    openSheetBtn.addEventListener('click', openSheet);
    closeSheetBtn.addEventListener('click', closeSheet);
    cancelSheetBtn.addEventListener('click', closeSheet);
    sheetBackdrop.addEventListener('click', closeSheet);

    window.addEventListener('keydown', (ev) => {
        if (ev.key === 'Escape' && isSheetOpen) closeSheet();
    });

    // Selección dentro del Modal
    sheetSemesterBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            tempSemester = btn.dataset.semester;
            renderSheetOptionStyles();
        });
    });

    sheetGroupBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            tempGroup = btn.dataset.group;
            renderSheetOptionStyles();
        });
    });

    // Confirmar cambios
    confirmSheetBtn.addEventListener('click', () => {
        if (!tempSemester) {
            sheetSemesterBtns[0]?.focus();
            return;
        }

        semesterInput.value = tempSemester;
        groupInput.value = tempGroup;

        updateSummaryCard();
        saveSelection();
        closeSheet();

        focusAfterRender = true;
        scrollToSchedule();
        load();
    });

    // Inicialización
    restoreSelection();
    if (semesterInput.value) load();
})();