<!-- ========================================== -->
<!-- MÓDULO BECAS -->
<!-- ========================================== -->
<main class="max-w-[1140px] mx-auto px-4 sm:px-6 pb-16 font-sans text-[#0d2b4e] antialiased">

    <!-- SECCIÓN: HERO HEADER (TÍTULO Y DESCRIPCIÓN PRINCIPAL) -->
    <header class="pt-12 px-2 sm:px-6 pb-10 text-center">
        <div class="max-w-[1140px] mx-auto">
            <h1 class="text-[#094074] text-3xl sm:text-4xl md:text-[2.8rem] font-extrabold mb-4 tracking-tight leading-tight">
                Becas y programas de apoyo para estudiantes
            </h1>
            <p class="text-[#3a567a] text-base sm:text-lg max-w-[780px] mx-auto leading-relaxed">
                Conoce los programas disponibles y accede a los sitios oficiales para consultar convocatorias y requisitos.
            </p>
        </div>
    </header>

    <!-- SECCIÓN: AVISO / ENLACE A FACEBOOK -->
    <section class="bg-[#e8f1fb] border border-[#d5e2ef] rounded-[14px] py-2 px-5 sm:px-6 mb-8 flex flex-col md:flex-row items-center justify-between gap-4 shadow-[0_4px_20px_rgba(13,43,78,0.06)]">
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="bg-[#1877f2] text-white w-[40px] h-[40px] sm:w-[44px] sm:h-[44px] rounded-full flex items-center justify-center shrink-0 shadow-sm">
                <svg class="w-[22px] h-[22px] sm:w-[24px] sm:h-[24px] fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </div>
            <div class="min-w-0">
                <h3 class="text-[1rem] sm:text-[1.05rem] font-bold text-[#094074] mb-0.5">Más información</h3>
                <p class="text-[0.85rem] sm:text-[0.92rem] text-[#3a567a] leading-snug">
                    Consulta la página oficial de la <strong class="text-[#042b50] font-bold">Unidad de Becas e Intercambio Académico CU Costa Sur</strong> en Facebook
                </p>
            </div>
        </div>
        
        <!-- Botón Visitar Facebook -->
        <a href="https://www.facebook.com/UBIACUCOSTASUR/" target="_blank" rel="noopener noreferrer" 
           class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-[#094074] hover:bg-[#042b50] text-white px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 hover:shadow-md shrink-0 no-underline">
            Visitar Facebook
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                <polyline points="15 3 21 3 21 9"></polyline>
                <line x1="10" y1="14" x2="21" y2="3"></line>
            </svg>
        </a>
    </section>

    <!-- Separador de línea -->
    <div class="max-w-5xl mx-auto px-4 my-8">
        <div class="w-full border-t border-[#d5e2ef]"></div>
    </div> 

    <!-- SECCIÓN: GRID DE TARJETAS DE BECAS -->
    <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-6 sm:gap-8 items-stretch">

        <!-- TARJETA 1: PEEES -->
        <article class="group bg-white border border-[#d5e2ef] rounded-[14px] p-6 flex flex-col shadow-[0_4px_20px_rgba(13,43,78,0.07)] hover:-translate-y-1 hover:shadow-[0_8px_36px_rgba(13,43,78,0.14)] hover:border-[#00aecc]/40 transition-all duration-200">
            <h2 class="text-[1.2rem] font-bold text-[#094074] mb-2 leading-snug">Programa de Estímulos Económicos para Estudiantes Sobresalientes (PEEES)</h2>
            <p class="text-[0.93rem] text-[#3a567a] leading-relaxed mb-auto pb-4">Programa destinado a reconocer y respaldar el rendimiento académico destacado, fomentando la participación activa en el ámbito universitario.</p>
            <div class="w-full h-[190px] rounded-xl overflow-hidden mb-[1.25rem] bg-[#f4f7fb] border border-[#e8f0f9]">
                <img src="<?= BASE_URL ?>public/img/becas/bpeees.jpg" alt="PEEES" class="w-full h-full object-fill group-hover:scale-[1.02] transition-transform duration-300">
            </div>
            <button onclick="openModal('modal-peees')" class="w-full inline-flex items-center justify-center gap-2 p-[0.75rem] bg-[#40ce02] hover:bg-[#39b803] text-white border-0 rounded-xl text-[0.92rem] font-semibold cursor-pointer transition-all duration-200 shadow-sm hover:shadow-md">
                Ver detalles
            </button>
        </article>

        <!-- TARJETA 2: Beca Alimenticia -->
        <article class="group bg-white border border-[#d5e2ef] rounded-[14px] p-6 flex flex-col shadow-[0_4px_20px_rgba(13,43,78,0.07)] hover:-translate-y-1 hover:shadow-[0_8px_36px_rgba(13,43,78,0.14)] hover:border-[#00aecc]/40 transition-all duration-200">
            <h2 class="text-[1.2rem] font-bold text-[#094074] mb-2 leading-snug">Beca Alimenticia – CUCSUR</h2>
            <p class="text-[0.93rem] text-[#3a567a] leading-relaxed mb-auto pb-4">Programa de asistencia social enfocado en contribuir a la alimentación de los estudiantes para favorecer su permanencia escolar.</p>
            <div class="w-full h-[190px] rounded-xl overflow-hidden mb-[1.25rem] bg-[#f4f7fb] border border-[#e8f0f9]">
                <img src="<?= BASE_URL ?>public/img/becas/balimenticia.jpg" alt="Beca Alimenticia" class="w-full h-full object-fill group-hover:scale-[1.02] transition-transform duration-300">
            </div>
            <button onclick="openModal('modal-alimenticia')" class="w-full inline-flex items-center justify-center gap-2 p-[0.75rem] bg-[#40ce02] hover:bg-[#39b803] text-white border-0 rounded-xl text-[0.92rem] font-semibold cursor-pointer transition-all duration-200 shadow-sm hover:shadow-md">
                Ver detalles
            </button>
        </article>

        <!-- TARJETA 3: PEEEI -->
        <article class="group bg-white border border-[#d5e2ef] rounded-[14px] p-6 flex flex-col shadow-[0_4px_20px_rgba(13,43,78,0.07)] hover:-translate-y-1 hover:shadow-[0_8px_36px_rgba(13,43,78,0.14)] hover:border-[#00aecc]/40 transition-all duration-200">
            <h2 class="text-[1.2rem] font-bold text-[#094074] mb-2 leading-snug">Programa de Estímulos Económicos para Estudiantes Indígenas (PEEEI)</h2>
            <p class="text-[0.93rem] text-[#3a567a] leading-relaxed mb-auto pb-4">Apoyo económico dirigido a impulsar el desarrollo académico y la continuidad escolar de estudiantes de comunidades indígenas.</p>
            <div class="w-full h-[190px] rounded-xl overflow-hidden mb-[1.25rem] bg-[#f4f7fb] border border-[#e8f0f9]">
                <img src="<?= BASE_URL ?>public/img/becas/bpeeei.jpg" alt="PEEEI" class="w-full h-full object-fill group-hover:scale-[1.02] transition-transform duration-300">
            </div>
            <button onclick="openModal('modal-peeei')" class="w-full inline-flex items-center justify-center gap-2 p-[0.75rem] bg-[#40ce02] hover:bg-[#39b803] text-white border-0 rounded-xl text-[0.92rem] font-semibold cursor-pointer transition-all duration-200 shadow-sm hover:shadow-md">
                Ver detalles
            </button>
        </article>

        <!-- TARJETA 4: PEEED -->
        <article class="group bg-white border border-[#d5e2ef] rounded-[14px] p-6 flex flex-col shadow-[0_4px_20px_rgba(13,43,78,0.07)] hover:-translate-y-1 hover:shadow-[0_8px_36px_rgba(13,43,78,0.14)] hover:border-[#00aecc]/40 transition-all duration-200">
            <h2 class="text-[1.2rem] font-bold text-[#094074] mb-2 leading-snug">Programa de Estímulos Económicos para Estudiantes con Discapacidad (PEEED)</h2>
            <p class="text-[0.93rem] text-[#3a567a] leading-relaxed mb-auto pb-4">Iniciativa orientada a respaldar la trayectoria académica de estudiantes con discapacidad mediante la promoción de la equidad e inclusión.</p>
            <div class="w-full h-[190px] rounded-xl overflow-hidden mb-[1.25rem] bg-[#f4f7fb] border border-[#e8f0f9]">
                <img src="<?= BASE_URL ?>public/img/becas/bpeeed.jpg" alt="PEEED" class="w-full h-full object-fill group-hover:scale-[1.02] transition-transform duration-300">
            </div>
            <button onclick="openModal('modal-peeed')" class="w-full inline-flex items-center justify-center gap-2 p-[0.75rem] bg-[#40ce02] hover:bg-[#39b803] text-white border-0 rounded-xl text-[0.92rem] font-semibold cursor-pointer transition-all duration-200 shadow-sm hover:shadow-md">
                Ver detalles
            </button>
        </article>

    </div>

    <!-- ========================================== -->
    <!-- SECCIÓN: VENTANAS MODALES -->
    <!-- ========================================== -->

    <!-- Modal PEEES -->
    <div id="modal-peees" onclick="closeModalOutside(event, 'modal-peees')" 
         class="modal-overlay fixed inset-0 bg-gradient-to-b from-[#042b50]/75 via-[#094074]/90 to-[#042b50]/95 backdrop-blur-sm flex items-center justify-center p-3 sm:p-4 z-[1000] opacity-0 invisible transition-all duration-300">
        <div class="modal-container bg-white w-full max-w-[620px] rounded-[14px] shadow-[0_8px_36px_rgba(13,43,78,0.22)] scale-95 transition-transform duration-300 overflow-hidden max-h-[88vh] flex flex-col border border-[#d5e2ef]">
            
            <div class="flex items-start gap-3 p-3.5 sm:p-5 border-b border-[#d5e2ef] bg-white shrink-0 relative">
                <div class="w-[90px] sm:w-[120px] h-auto shrink-0 rounded-lg overflow-hidden flex items-center justify-center bg-[#f4f7fb] border border-[#e8f0f9] self-center">
                    <img src="<?= BASE_URL ?>public/img/becas/bpeees.jpg" alt="PEEES" class="w-full h-auto object-contain block">
                </div>
                
                <div class="flex flex-col gap-0.5 pr-6 grow">
                    <span class="text-[0.7rem] sm:text-[0.78rem] font-bold uppercase tracking-wider text-[#00aecc]">Detalles del programa</span>
                    <h3 class="text-[0.95rem] sm:text-[1.1rem] font-bold text-[#094074] leading-snug">Estímulos Económicos para Estudiantes Sobresalientes (PEEES)</h3>
                </div>
          
                <button onclick="closeModal('modal-peees')" aria-label="Cerrar modal" class="absolute top-3 right-3 bg-transparent border-0 text-[#7a94b0] hover:bg-[#e8f1fb] hover:text-[#094074] w-7 h-7 rounded-lg flex items-center justify-center transition-colors duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="p-3.5 sm:p-5 text-[0.88rem] sm:text-[0.93rem] text-[#3a567a] leading-relaxed overflow-y-auto grow space-y-3">
                <p class="text-[#0d2b4e]"><strong class="font-bold text-[#094074]">Monto del beneficio:</strong> Asignación mensual de $4,000.00 pesos para alumnos de licenciatura y técnico superior universitario.</p>
                <p class="text-[#0d2b4e]"><strong class="font-bold text-[#094074]">Periodo de cobertura:</strong> 10 meses.</p>
                
                <div class="pt-1">
                    <div class="text-[0.85rem] sm:text-[0.9rem] font-extrabold text-[#094074] mb-1 uppercase tracking-wide">Requisitos académicos</div>
                    <ul class="list-none p-0 m-0 space-y-1.5">
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Estatus de estudiante activo ordinario regular.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Promedio general mínimo de 90 (para la categoría de deporte de alto rendimiento, el promedio mínimo requerido es 85).</li>
                    </ul>
                </div>

                <div class="pt-1">
                    <div class="text-[0.85rem] sm:text-[0.9rem] font-extrabold text-[#094074] mb-1 uppercase tracking-wide">Obligaciones y actividades institucionales</div>
                    <p class="mb-1.5 text-[#0d2b4e] text-[0.85rem] sm:text-[0.9rem]">Los beneficiarios colaborarán en dependencias universitarias dentro de las siguientes modalidades:</p>
                    <ul class="list-none p-0 m-0 space-y-1.5">
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Actividades de investigación, gestión bibliotecaria o sistemas de información.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Programas de protección civil, fomento deportivo o bienestar institucional.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Asistencia a coordinaciones académicas y administrativas.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Observar en todo momento una buena conducta apegada a la normatividad universitaria.</li>
                    </ul>
                </div>

                <div class="mt-3 p-2.5 bg-[#e8f1fb] border-l-4 border-[#094074] text-[0.8rem] sm:text-[0.83rem] text-[#3a567a] rounded-r-lg">
                    * Nota informativa: Para consultar las especificaciones completas, lineamientos y fechas del proceso, favor de revisar la convocatoria oficial.
                </div>
            </div>

            <!-- BOTONES INFERIORES -->
            <div class="bg-[#f4f7fb] border-t border-[#d5e2ef] p-3 px-4 flex flex-row justify-end items-center gap-2 shrink-0">
                <button onclick="closeModal('modal-peees')" class="px-3.5 py-1.5 bg-transparent text-[#3a567a] border border-[#d5e2ef] hover:bg-[#e8f0f9] hover:text-[#094074] rounded-lg text-[0.83rem] font-semibold transition-colors duration-200 cursor-pointer">Cerrar</button>
                <a href="https://udg.mx/node/84713" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-1.5 px-3.5 py-1.5 bg-[#40ce02] hover:bg-[#39b803] text-white rounded-lg text-[0.83rem] font-semibold transition-all duration-200 no-underline shadow-sm">
                    Convocatoria
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Modal Beca Alimenticia -->
    <div id="modal-alimenticia" onclick="closeModalOutside(event, 'modal-alimenticia')" 
         class="modal-overlay fixed inset-0 bg-gradient-to-b from-[#042b50]/75 via-[#094074]/90 to-[#042b50]/95 backdrop-blur-sm flex items-center justify-center p-3 sm:p-4 z-[1000] opacity-0 invisible transition-all duration-300">
        <div class="modal-container bg-white w-full max-w-[620px] rounded-[14px] shadow-[0_8px_36px_rgba(13,43,78,0.22)] scale-95 transition-transform duration-300 overflow-hidden max-h-[88vh] flex flex-col border border-[#d5e2ef]">       
          
            <div class="flex items-start gap-3 p-3.5 sm:p-5 border-b border-[#d5e2ef] bg-white shrink-0 relative">
                <div class="w-[90px] sm:w-[120px] h-auto shrink-0 rounded-lg overflow-hidden flex items-center justify-center bg-[#f4f7fb] border border-[#e8f0f9] self-center">
                    <img src="<?= BASE_URL ?>public/img/becas/balimenticia.jpg" alt="Beca Alimenticia" class="w-full h-auto object-contain block">
                </div>
                
                <div class="flex flex-col gap-0.5 pr-6 grow">
                    <span class="text-[0.7rem] sm:text-[0.78rem] font-bold uppercase tracking-wider text-[#00aecc]">Detalles del programa</span>
                    <h3 class="text-[0.95rem] sm:text-[1.1rem] font-bold text-[#094074] leading-snug">Beca Alimenticia – CUCSUR</h3>
                </div>
           
                <button onclick="closeModal('modal-alimenticia')" aria-label="Cerrar modal" class="absolute top-3 right-3 bg-transparent border-0 text-[#7a94b0] hover:bg-[#e8f1fb] hover:text-[#094074] w-7 h-7 rounded-lg flex items-center justify-center transition-colors duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="p-3.5 sm:p-5 text-[0.88rem] sm:text-[0.93rem] text-[#3a567a] leading-relaxed overflow-y-auto grow space-y-3">
                <p class="text-[#0d2b4e]"><strong class="font-bold text-[#094074]">Descripción del apoyo:</strong> Suministro de desayuno o comida sin costo de lunes a viernes durante el ciclo escolar.</p>
                <p class="text-[#0d2b4e]"><strong class="font-bold text-[#094074]">Horarios de servicio:</strong> Desayunos de 08:30 a 09:30 h o comidas de 13:30 a 15:30 h.</p>
                
                <div class="pt-1">
                    <div class="text-[0.85rem] sm:text-[0.9rem] font-extrabold text-[#094074] mb-1 uppercase tracking-wide">Requisitos</div>
                    <ul class="list-none p-0 m-0 space-y-1.5">
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Estar matriculado en programas de licenciatura o técnico superior universitario en el Centro Universitario de la Costa Sur.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Acreditar situación de vulnerabilidad económica, social o cultural.</li>
                    </ul>
                </div>

                <div class="pt-1">
                    <div class="text-[0.85rem] sm:text-[0.9rem] font-extrabold text-[#094074] mb-1 uppercase tracking-wide">Obligaciones del beneficiario:</div>
                    <ul class="list-none p-0 m-0 space-y-1.5">
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Hacer uso del servicio dentro del horario asignado y cumplir con las normas de higiene del comedor.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Realizar 2 horas de voluntariado por semana en el comedor comunitario.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Participar en las evaluaciones nutricionales y talleres de formación integral establecidos.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Observar en todo momento una buena conducta apegada a la normatividad universitaria.</li>
                    </ul>
                </div>

                <div class="mt-3 p-2.5 bg-[#e8f1fb] border-l-4 border-[#094074] text-[0.8rem] sm:text-[0.83rem] text-[#3a567a] rounded-r-lg">
                    * Nota informativa: Para consultar las especificaciones completas, lineamientos y fechas del proceso, favor de revisar la convocatoria oficial.
                </div>
            </div>

            <!-- BOTONES INFERIORES -->
            <div class="bg-[#f4f7fb] border-t border-[#d5e2ef] p-3 px-4 flex flex-row justify-end items-center gap-2 shrink-0">
                <button onclick="closeModal('modal-alimenticia')" class="px-3.5 py-1.5 bg-transparent text-[#3a567a] border border-[#d5e2ef] hover:bg-[#e8f0f9] hover:text-[#094074] rounded-lg text-[0.83rem] font-semibold transition-colors duration-200 cursor-pointer">Cerrar</button>
                <a href="https://cucsur.udg.mx/sites/default/files/adjuntos/programa-apoyo-para-beca-alimenticia-26b-jun-18-26.pdf" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-1.5 px-3.5 py-1.5 bg-[#40ce02] hover:bg-[#39b803] text-white rounded-lg text-[0.83rem] font-semibold transition-all duration-200 no-underline shadow-sm">
                    Convocatoria
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Modal PEEEI -->
    <div id="modal-peeei" onclick="closeModalOutside(event, 'modal-peeei')" 
         class="modal-overlay fixed inset-0 bg-gradient-to-b from-[#042b50]/75 via-[#094074]/90 to-[#042b50]/95 backdrop-blur-sm flex items-center justify-center p-3 sm:p-4 z-[1000] opacity-0 invisible transition-all duration-300">
        <div class="modal-container bg-white w-full max-w-[620px] rounded-[14px] shadow-[0_8px_36px_rgba(13,43,78,0.22)] scale-95 transition-transform duration-300 overflow-hidden max-h-[88vh] flex flex-col border border-[#d5e2ef]">
                     
            <div class="flex items-start gap-3 p-3.5 sm:p-5 border-b border-[#d5e2ef] bg-white shrink-0 relative">
                <div class="w-[90px] sm:w-[120px] h-auto shrink-0 rounded-lg overflow-hidden flex items-center justify-center bg-[#f4f7fb] border border-[#e8f0f9] self-center">
                    <img src="<?= BASE_URL ?>public/img/becas/bpeeei.jpg" alt="PEEEI" class="w-full h-auto object-contain block">
                </div>
                
                <div class="flex flex-col gap-0.5 pr-6 grow">
                    <span class="text-[0.7rem] sm:text-[0.78rem] font-bold uppercase tracking-wider text-[#00aecc]">Detalles del programa</span>
                    <h3 class="text-[0.95rem] sm:text-[1.1rem] font-bold text-[#094074] leading-snug">Estímulos Económicos para Estudiantes Indígenas (PEEEI)</h3>
                </div>
      
                <button onclick="closeModal('modal-peeei')" aria-label="Cerrar modal" class="absolute top-3 right-3 bg-transparent border-0 text-[#7a94b0] hover:bg-[#e8f1fb] hover:text-[#094074] w-7 h-7 rounded-lg flex items-center justify-center transition-colors duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="p-3.5 sm:p-5 text-[0.88rem] sm:text-[0.93rem] text-[#3a567a] leading-relaxed overflow-y-auto grow space-y-3">
                <p class="text-[#0d2b4e]"><strong class="font-bold text-[#094074]">Asignación económica:</strong> Apoyo monetario único por la cantidad de $7,200.00 pesos netos, otorgado mediante transferencia bancaria a cuenta de débito personal.</p>
                
                <div class="pt-1">
                    <div class="text-[0.85rem] sm:text-[0.9rem] font-extrabold text-[#094074] mb-1 uppercase tracking-wide">Requisitos</div>
                    <ul class="list-none p-0 m-0 space-y-1.5">
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Contar con matrícula vigente y estatus activo durante el ciclo escolar correspondiente en el Centro Universitario de la Costa Sur.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Nacionalidad mexicana.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Pertenencia acreditada a un pueblo originario conforme al Catálogo Nacional de Pueblos y Comunidades Indígenas y Afromexicanas o al Padrón de Comunidades y Localidades Indígenas de Jalisco.</li>
                    </ul>
                </div>

                <div class="pt-1">
                    <div class="text-[0.85rem] sm:text-[0.9rem] font-extrabold text-[#094074] mb-1 uppercase tracking-wide">Obligaciones del beneficiario:</div>
                    <ul class="list-none p-0 m-0 space-y-1.5">
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Mantener el estatus de alumno activo durante el periodo de vigencia del estímulo.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Observar en todo momento una buena conducta apegada a la normatividad universitaria.</li>
                    </ul>
                </div>

                <div class="mt-3 p-2.5 bg-[#e8f1fb] border-l-4 border-[#094074] text-[0.8rem] sm:text-[0.83rem] text-[#3a567a] rounded-r-lg">
                    * Nota informativa: Para consultar las especificaciones completas, lineamientos y fechas del proceso, favor de revisar la convocatoria oficial.
                </div>
            </div>

            <!-- BOTONES INFERIORES -->
            <div class="bg-[#f4f7fb] border-t border-[#d5e2ef] p-3 px-4 flex flex-row justify-end items-center gap-2 shrink-0">
                <button onclick="closeModal('modal-peeei')" class="px-3.5 py-1.5 bg-transparent text-[#3a567a] border border-[#d5e2ef] hover:bg-[#e8f0f9] hover:text-[#094074] rounded-lg text-[0.83rem] font-semibold transition-colors duration-200 cursor-pointer">Cerrar</button>
                <a href="https://udg.mx/node/84782" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-1.5 px-3.5 py-1.5 bg-[#40ce02] hover:bg-[#39b803] text-white rounded-lg text-[0.83rem] font-semibold transition-all duration-200 no-underline shadow-sm">
                    Convocatoria
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Modal PEEED -->
    <div id="modal-peeed" onclick="closeModalOutside(event, 'modal-peeed')" 
         class="modal-overlay fixed inset-0 bg-gradient-to-b from-[#042b50]/75 via-[#094074]/90 to-[#042b50]/95 backdrop-blur-sm flex items-center justify-center p-3 sm:p-4 z-[1000] opacity-0 invisible transition-all duration-300">
        <div class="modal-container bg-white w-full max-w-[620px] rounded-[14px] shadow-[0_8px_36px_rgba(13,43,78,0.22)] scale-95 transition-transform duration-300 overflow-hidden max-h-[88vh] flex flex-col border border-[#d5e2ef]">
                    
            <div class="flex items-start gap-3 p-3.5 sm:p-5 border-b border-[#d5e2ef] bg-white shrink-0 relative">
                <div class="w-[90px] sm:w-[120px] h-auto shrink-0 rounded-lg overflow-hidden flex items-center justify-center bg-[#f4f7fb] border border-[#e8f0f9] self-center">
                    <img src="<?= BASE_URL ?>public/img/becas/bpeeed.jpg" alt="PEEED" class="w-full h-auto object-contain block">
                </div>
                
                <div class="flex flex-col gap-0.5 pr-6 grow">
                    <span class="text-[0.7rem] sm:text-[0.78rem] font-bold uppercase tracking-wider text-[#00aecc]">Detalles del programa</span>
                    <h3 class="text-[0.95rem] sm:text-[1.1rem] font-bold text-[#094074] leading-snug">Estímulos Económicos para Estudiantes con Discapacidad (PEEED)</h3>
                </div>

                <button onclick="closeModal('modal-peeed')" aria-label="Cerrar modal" class="absolute top-3 right-3 bg-transparent border-0 text-[#7a94b0] hover:bg-[#e8f1fb] hover:text-[#094074] w-7 h-7 rounded-lg flex items-center justify-center transition-colors duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="p-3.5 sm:p-5 text-[0.88rem] sm:text-[0.93rem] text-[#3a567a] leading-relaxed overflow-y-auto grow space-y-3">
                <p class="text-[#0d2b4e]"><strong class="font-bold text-[#094074]">Asignación económica:</strong> Apoyo total de $6,000.00 pesos entregados en una sola exhibición bancaria (equivalente a $1,000.00 pesos mensuales durante un semestre).</p>
                
                <div class="pt-1">
                    <div class="text-[0.85rem] sm:text-[0.9rem] font-extrabold text-[#094074] mb-1 uppercase tracking-wide">Requisitos</div>
                    <ul class="list-none p-0 m-0 space-y-1.5">
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Ser estudiante con inscripción activa en la Red Universitaria (Centros Universitarios) y contar con nacionalidad mexicana.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Presentar condición de discapacidad debidamente acreditada.</li>
                    </ul>
                </div>

                <div class="pt-1">
                    <div class="text-[0.85rem] sm:text-[0.9rem] font-extrabold text-[#094074] mb-1 uppercase tracking-wide">Obligaciones del beneficiario:</div>
                    <ul class="list-none p-0 m-0 space-y-1.5">
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Conservar el estatus de alumno activo durante el periodo de asignación del recurso.</li>
                        <li class="relative pl-5 text-[0.85rem] sm:text-[0.9rem] text-[#3a567a] before:content-['•'] before:absolute before:left-1 before:text-[#40ce02] before:font-bold before:text-base">Observar en todo momento una buena conducta apegada a la normatividad universitaria.</li>
                    </ul>
                </div>

                <div class="mt-3 p-2.5 bg-[#e8f1fb] border-l-4 border-[#094074] text-[0.8rem] sm:text-[0.83rem] text-[#3a567a] rounded-r-lg">
                    * Nota informativa: Para consultar las especificaciones completas, lineamientos y fechas del proceso, favor de revisar la convocatoria oficial.
                </div>
            </div>

            <!-- BOTONES INFERIORES -->
            <div class="bg-[#f4f7fb] border-t border-[#d5e2ef] p-3 px-4 flex flex-row justify-end items-center gap-2 shrink-0">
                <button onclick="closeModal('modal-peeed')" class="px-3.5 py-1.5 bg-transparent text-[#3a567a] border border-[#d5e2ef] hover:bg-[#e8f0f9] hover:text-[#094074] rounded-lg text-[0.83rem] font-semibold transition-colors duration-200 cursor-pointer">Cerrar</button>
                <a href="https://www.udg.mx/node/84781" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-1.5 px-3.5 py-1.5 bg-[#40ce02] hover:bg-[#39b803] text-white rounded-lg text-[0.83rem] font-semibold transition-all duration-200 no-underline shadow-sm">
                    Convocatoria
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>
            </div>
        </div>
    </div>
   
</main>

<script src="<?= BASE_URL ?>public/js/becas.js"></script>