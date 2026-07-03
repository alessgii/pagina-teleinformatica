    <link rel="stylesheet" href="public/css/pages/malla_curricular.css">
  

    <section class="hero">
      <h1>Malla <span>Curricular</span></h1>
      <p class="hero-sub">Explora nuestro programa educativo especializado en redes, telecomunicaciones y programación.
        Ocho semestres de formación profesional de alto nivel.</p>

      <div class="sem-wrapper">
        <button class="sem-btn" onclick="toggleSemDd()">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.35-4.35" />
          </svg>
          Buscar por semestre
          <svg id="sem-chev" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2.5" style="transition:.25s;margin-left:.2rem">
            <path d="m6 9 6 6 6-6" />
          </svg>
        </button>
        <div class="sem-dropdown" id="sem-dd">
          <a href="#sem1" onclick="goTo('sem1')"><span>1er Semestre</span></a>
          <a href="#sem2" onclick="goTo('sem2')"><span>2do Semestre</span></a>
          <a href="#sem3" onclick="goTo('sem3')"><span>3er Semestre</span></a>
          <a href="#sem4" onclick="goTo('sem4')"><span>4to Semestre</span></a>
          <a href="#sem5" onclick="goTo('sem5')"><span>5to Semestre</span></a>
          <a href="#sem6" onclick="goTo('sem6')"><span>6to Semestre</span></a>
          <a href="#sem7" onclick="goTo('sem7')"><span>7mo Semestre</span></a>
          <a href="#sem8" onclick="goTo('sem8')"><span>8vo Semestre</span></a>
        </div>
      </div>
    </section>

    <main class="curriculum">

      <div class="legend">
        <span>Tipos de materia:</span>
        <span class="legend-item"><span class="badge badge-oblig">EO</span> Especializante Obligatoria</span>
        <span class="legend-item"><span class="badge badge-opt">OA</span> Optativa Abierta</span>
        <span class="legend-item"><span class="badge badge-electiva">BPA</span> Basica Particular Obligatoria</span>
        <span class="legend-item"><span class="badge badge-comun">BCO</span> Basica Comun Obligatoria</span>
      </div>

      <div class="semester-block" id="sem1">
        <div class="sem-header">
          <div class="sem-number">01</div>
          <div class="sem-info">
            <h2>Primer Semestre</h2>
            <p>Introducción a la teleinformática y ciencias básicas · 6 materias</p>
          </div>
        </div>
        <div class="cards-grid">

          <div class="course-card">
            <div class="card-top"><span class="badge badge-comun">BCO</span><span class="code-chip">TU173</span></div>
            <h3>Seminario de Comunicación Oral y Escrita</h3>
            <p>Estudio y aplicación de técnicas de expresión, redacción académica y comunicación asertiva profesional.
            </p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BCO</span><span class="code-chip">TU169</span></div>
            <h3>Inglés Técnico I</h3>
            <p>Desarrollo de habilidades de lectura y comprensión de manuales, documentación y textos técnicos en
              inglés.</p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BPO</span><span class="code-chip">IN238</span></div>
            <h3>Programación Imperativa</h3>
            <p>Fundamentos de lógica algorítmica, estructuras de control lineales y programación estructurada en C o
              lenguajes base.</p>
            <div class="card-footer"><span class="credits">◴ 7 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BCO</span><span class="code-chip">IN222</span></div>
            <h3>Álgebra y Geometría</h3>
            <p>Modelado matemático elemental, vectores, matrices, sistemas de ecuaciones lineales y geometría analítica.
            </p>
            <div class="card-footer"><span class="credits">◴ 8 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN282</span></div>
            <h3>Matemáticas Discretas para Teleinformática</h3>
            <p>Conjuntos, lógica proposicional, teoría de grafos, árboles y estructuras matemáticas clave para redes de
              datos.</p>
            <div class="card-footer"><span class="credits">◴ 11 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BCO</span><span class="code-chip">IN223</span></div>
            <h3>Teoría del Cálculo I</h3>
            <p>Límites, continuidad, derivadas, optimización de funciones y aplicaciones fundamentales del cálculo
              diferencial.</p>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

        </div>
      </div>

      <div class="semester-block" id="sem2">
        <div class="sem-header">
          <div class="sem-number">02</div>
          <div class="sem-info">
            <h2>Segundo Semestre</h2>
            <p>Profundización en lenguajes, instrumentación y cálculo avanzado · 6 materias</p>
          </div>
        </div>
        <div class="cards-grid">

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BCO</span><span class="code-chip">TU170</span></div>
            <h3>Inglés Técnico II</h3>
            <p>Inglés enfocado en la redacción técnica, traducción y terminología avanzada de telecomunicaciones.</p>
            <div class="prereq"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                <line x1="12" y1="9" x2="12" y2="13" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
              </svg>Requiere Inglés Técnico I</div>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BPO</span><span class="code-chip">IN250</span></div>
            <h3>Taller de Instrumentación</h3>
            <p>Uso de multímetros, osciloscopios, generadores de señales y medición de parámetros eléctricos básicos.
            </p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">CA</span><span class="code-chip">IN244</span></div>
            <h3>Introducción a los Lenguajes Visuales</h3>
            <p>Desarrollo de software con interfaces gráficas de usuario (GUI), eventos y programación orientada a
              objetos visual.</p>
            <div class="card-footer"><span class="credits">◴ 9 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BCO</span><span class="code-chip">IN224</span></div>
            <h3>Teoría del Cálculo II</h3>
            <p>Cálculo integral, métodos de integración, series, sucesiones y aplicaciones geométricas de la integral.
            </p>
            <div class="prereq"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                <line x1="12" y1="9" x2="12" y2="13" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
              </svg>Requiere Cálculo I</div>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">EO</span><span class="code-chip">IN227</span></div>
            <h3>Fundamentos de Computación</h3>
            <p>Arquitectura básica del computador, sistemas numéricos, hardware esencial y conceptos operativos raíz.
            </p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN248</span></div>
            <h3>Curso de Internet</h3>
            <p>Historia de la red, servicios web globales, uso de protocolos iniciales y navegación segura avanzada.</p>
            <div class="card-footer"><span class="credits">◴ 3 créditos</span></div>
          </div>

        </div>
      </div>

      <div class="semester-block" id="sem3">
        <div class="sem-header">
          <div class="sem-number">03</div>
          <div class="sem-info">
            <h2>Tercer Semestre</h2>
            <p>Redes esenciales, electrónica analógica y cálculo multivariado · 5 materias</p>
          </div>
        </div>
        <div class="cards-grid">

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">ED</span><span class="code-chip">IN236</span></div>
            <h3>Redes de Cómputo I</h3>
            <p>Conceptos clave de comunicación de datos, Modelo OSI, capas físicas, medios de transmisión y
              direccionamiento IP básico.</p>
            <div class="card-footer"><span class="credits">◴ 11 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BPO</span><span class="code-chip">IN249</span></div>
            <h3>Taller de Electrónica Analógica</h3>
            <p>Análisis de circuitos con diodos, transistores, amplificadores operacionales y fuentes de alimentación
              continuas.</p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BCO</span><span class="code-chip">IN225</span></div>
            <h3>Teoría del Cálculo III</h3>
            <p>Cálculo multivariable, derivadas parciales, integrales múltiples, campos vectoriales y teoremas de Green,
              Stokes y Gauss.</p>
            <div class="prereq"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                <line x1="12" y1="9" x2="12" y2="13" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
              </svg>Requiere Cálculo II</div>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BPO</span><span class="code-chip">IN245</span></div>
            <h3>Fundamentos de Creatividad y Desarrollo</h3>
            <p>Dinámicas de innovación, metodologías creativas y formulación de ideas orientadas a soluciones
              tecnológicas disruptivas.</p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BCO</span><span class="code-chip">TU172</span></div>
            <h3>Cultura Deportiva</h3>
            <p>Promoción de la salud integral, actividades recreativas, acondicionamiento físico y trabajo en equipo
              disciplinar.</p>
            <div class="card-footer"><span class="credits">◴ 3 créditos</span></div>
          </div>

        </div>
      </div>

      <div class="semester-block" id="sem4">
        <div class="sem-header">
          <div class="sem-number">04</div>
          <div class="sem-info">
            <h2>Cuarto Semestre</h2>
            <p>Enrutamiento intermedio, lógica digital y física avanzada · 5 materias</p>
          </div>
        </div>
        <div class="cards-grid">

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">ED</span><span class="code-chip">IN237</span></div>
            <h3>Redes de Cómputo II</h3>
            <p>Protocolos de enrutamiento estático y dinámico, conmutación (switching), VLANs, STP y seguridad en
              puertos.</p>
            <div class="prereq"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                <line x1="12" y1="9" x2="12" y2="13" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
              </svg>Requiere Redes de Cómputo I</div>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BPO</span><span class="code-chip">IN251</span></div>
            <h3>Taller de Electrónica Digital</h3>
            <p>Sistemas numéricos binarios, álgebra de Boole, diseño de circuitos lógicos combinacionales y
              secuenciales, memorias.</p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BCO</span><span class="code-chip">IN261</span></div>
            <h3>Matemática Avanzada</h3>
            <p>Transformadas de Laplace, series de Fourier, variables complejas y ecuaciones diferenciales para
              ingeniería.</p>
            <div class="prereq"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                <line x1="12" y1="9" x2="12" y2="13" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
              </svg>Requiere Cálculo III</div>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN274</span></div>
            <h3>Fundamentos de Internet</h3>
            <p>Arquitectura global de la gran red, asignación regional de IPs (RIRs), DNS raíz y servicios troncales de
              Internet.</p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BCO</span><span class="code-chip">TU175</span></div>
            <h3>Arte y Cultura</h3>
            <p>Apreciación e historia de las manifestaciones culturales y su impacto social en el entorno humano global.
            </p>
            <div class="card-footer"><span class="credits">◴ 3 créditos</span></div>
          </div>

        </div>
      </div>

      <div class="semester-block" id="sem5">
        <div class="sem-header">
          <div class="sem-number">05</div>
          <div class="sem-info">
            <h2>Quinto Semestre</h2>
            <p>Redes WAN, microcontroladores y fundamentos de sistemas operativos · 5 materias</p>
          </div>
        </div>
        <div class="cards-grid">

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">EQ</span><span class="code-chip">IN285</span></div>
            <h3>Redes de Cómputo III</h3>
            <p>Redes corporativas complejas, enlaces WAN, Frame Relay, encapsulamientos PPP y seguridad perimetral de
              red básica.</p>
            <div class="prereq"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                <line x1="12" y1="9" x2="12" y2="13" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
              </svg>Requiere Redes de Cómputo II</div>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BPO</span><span class="code-chip">IN252</span></div>
            <h3>Taller de Arquitectura de Microprocesadores</h3>
            <p>Programación de sistemas embebidos, arquitectura interna de CPUs, registros y código ensamblador directo
              de microcontroladores.</p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN235</span></div>
            <h3>Fundamentos de Sistemas Operativos</h3>
            <p>Estructura de kernels, administración de procesos, hilos de ejecución, gestión de memoria interna y
              sistemas de archivos.</p>
            <div class="card-footer"><span class="credits">◴ 4 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">EQ</span><span class="code-chip">IN262</span></div>
            <h3>Análisis de Señales y Sistemas</h3>
            <p>Teoría matemática de señales continuas y discretas, muestreo, distorsión, convolución y transformaciones
              de frecuencia.</p>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN242</span></div>
            <h3>Seguridad y Legislación</h3>
            <p>Leyes informáticas de protección de datos, delitos cibernéticos, marcos normativos, confidencialidad y
              políticas de seguridad.</p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

        </div>
      </div>

      <div class="semester-block" id="sem6">
        <div class="sem-header">
          <div class="sem-number">06</div>
          <div class="sem-info">
            <h2>Sexto Semestre</h2>
            <p>Administración avanzada de SO, enrutamiento avanzado y microondas · 4 materias</p>
          </div>
        </div>
        <div class="cards-grid">

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">BPO</span><span class="code-chip">IN253</span></div>
            <h3>Taller de Sistemas Operativos Avanzados</h3>
            <p>Configuración integral y despliegue de servidores corporativos en plataformas Unix/Linux y Windows
              Server.</p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN266</span></div>
            <h3>Teoría y Tecnología de Rutas</h3>
            <p>Arquitecturas de enrutamiento empresarial avanzado, BGP, OSPF multinárea, balanceo de cargas y políticas
              de ruteo.</p>
            <div class="prereq"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                <line x1="12" y1="9" x2="12" y2="13" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
              </svg>Requiere Redes de Cómputo III</div>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">EQ</span><span class="code-chip">IN264</span></div>
            <h3>Líneas de Transmisión y Microondas</h3>
            <p>Estudio de guías de onda, propagación electromagnética de alta frecuencia, acoplamiento de antenas y
              enlaces satelitales.</p>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN263</span></div>
            <h3>Diseño e Implementación de Sistemas Informáticos</h3>
            <p>Ciclos de vida del software, diseño arquitectónico, diagramado estructural y desarrollo modular enfocado
              a soluciones de red.</p>
            <div class="card-footer"><span class="credits">◴ 8 créditos</span></div>
          </div>

        </div>
      </div>

      <div class="semester-block" id="sem7">
        <div class="sem-header">
          <div class="sem-number">07</div>
          <div class="sem-info">
            <h2>Séptimo Semestre</h2>
            <p>Gestión de redes, telefonía IP e ingeniería de proyectos · 4 materias</p>
          </div>
        </div>
        <div class="cards-grid">

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN268</span></div>
            <h3>Administración de Redes</h3>
            <p>Marcos de gobernanza informática, protocolos de monitoreo (SNMP), aprovisionamiento, SLA y auditoría de
              tráfico activo.</p>
            <div class="card-footer"><span class="credits">◴ 8 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">EQ</span><span class="code-chip">IN265</span></div>
            <h3>Sistemas de Telefonía y Conmutación</h3>
            <p>Redes telefónicas tradicionales (PSTN), protocolos de señalización, arquitecturas de conmutación y bases
              troncales.</p>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN240</span></div>
            <h3>Ingeniería de Proyectos</h3>
            <p>Planeación metodológica, estimación financiera, viabilidad técnica y dirección integral de obras e
              infraestructura en TI.</p>
            <div class="card-footer"><span class="credits">◴ 8 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN241</span></div>
            <h3>Seminario de Investigación</h3>
            <p>Metodología científica, estructuración del protocolo de tesis o diseño inicial del proyecto terminal de
              titulación.</p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

        </div>
      </div>

      <div class="semester-block" id="sem8">
        <div class="sem-header">
          <div class="sem-number">08</div>
          <div class="sem-info">
            <h2>Octavo Semestre</h2>
            <p>Convergencia tecnológica e innovación en proyectos integradores · 3 materias</p>
          </div>
        </div>
        <div class="cards-grid">

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">EQ</span><span class="code-chip">IN267</span></div>
            <h3>Redes de Nueva Generación</h3>
            <p>Convergencia total de datos, voz y video. Redes definidas por software (SDN), IPv6 nativo y arquitecturas
              elásticas multimedia.</p>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">EQ</span><span class="code-chip">IN269</span></div>
            <h3>Sistemas de Telecomunicaciones Integradas</h3>
            <p>Integración de centrales telefónicas de Voz sobre IP (VoIP), troncales SIP, redes de fibra óptica de
              última milla y seguridad unificada.</p>
            <div class="card-footer"><span class="credits">◴ 13 créditos</span></div>
          </div>

          <div class="course-card">
            <div class="card-top"><span class="badge badge-oblig">DA</span><span class="code-chip">IN244</span></div>
            <h3>Aprendizaje de Proyectos Básicos</h3>
            <p>Fase final integradora. Desarrollo técnico práctico del prototipo de ingeniería o validación final de
              sistemas instalados.</p>
            <div class="card-footer"><span class="credits">◴ 5 créditos</span></div>
          </div>

        </div>
      </div>

    </main>