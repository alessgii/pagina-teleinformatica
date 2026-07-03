<link rel="stylesheet" href="public/css/pages/blog-global.css">
<link rel="stylesheet" href="public/css/pages/foro.css">


<div class="wrap">

  <div class="toolbar">
    <div class="toolbar-left">
      <h1>Foro Estudiantil</h1>

    </div>
    <div class="filters">
      <button class="f-btn active">Recientes</button>
      <button class="f-btn">Popular</button>
      <button class="f-btn">Sin respuesta</button>
      <button class="f-btn">Docentes</button>
    </div>
  </div>

  <main>
    <div class="compose" onclick="openModal()">
      <div class="av av1">YO</div>
      <div class="compose-placeholder">¿Qué quieres compartir?</div>
      <div class="compose-actions">
        <button class="c-btn">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" />
            <circle cx="8.5" cy="8.5" r="1.5" />
            <polyline points="21 15 16 10 5 21" />
          </svg>
          Imagen
        </button>
        <button class="c-btn">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
          </svg>
          Link
        </button>
      </div>
    </div>

    <div class="posts">

      <article class="post pinned">
        <div class="post-head">
          <div class="av av3">DR</div>
          <div class="post-meta">
            <div class="post-author-row">Dr. Ramírez Torres <span class="badge b-doc">Docente</span></div>
            <div class="post-time">Hace 2 h · Ing. Software · 📌 Fijado</div>
          </div>
        </div>
        <div class="post-title">Calendario de entregas — Proyecto Final 2do Semestre 2026</div>
        <div class="post-body">Cronograma definitivo de entregas para el proyecto integrador. Primera revisión el
          viernes 10 de mayo. Lean los criterios de evaluación actualizados adjuntos.</div>
        <div class="tags">
          <span class="tag tb">Anuncio Oficial</span>
          <span class="tag tg">Proyecto Final</span>
        </div>
        <div class="post-foot">
          <button class="act liked">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" stroke="none">
              <path
                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
            48
          </button>
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
            </svg>
            12
          </button>
          <div class="sep"></div>
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="18" cy="5" r="3" />
              <circle cx="6" cy="12" r="3" />
              <circle cx="18" cy="19" r="3" />
              <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
              <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
            </svg>
            Compartir
          </button>
        </div>
      </article>

      <article class="post">
        <div class="post-head">
          <div class="av av2">VL</div>
          <div class="post-meta">
            <div class="post-author-row">Valentina López <span class="badge b-alu">Alumna</span></div>
            <div class="post-time">Hace 5 h · Sistemas Computacionales</div>
          </div>
        </div>
        <div class="thumb">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="3" y="3" width="18" height="18" rx="2" />
            <circle cx="8.5" cy="8.5" r="1.5" />
            <polyline points="21 15 16 10 5 21" />
          </svg>
          <span class="thumb-label">📷 Mapa conceptual</span>
        </div>
        <div class="post-title">Mapa conceptual — Patrones de Diseño GoF</div>
        <div class="post-body">23 patrones con pseudocódigo y cuándo usarlos. Útil para el parcial del jueves.</div>
        <div class="tags">
          <span class="tag tg">Apuntes</span>
          <span class="tag tb">Patrones de Diseño</span>
        </div>
        <div class="post-foot">
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path
                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
            31
          </button>
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
            </svg>
            8
          </button>
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
              <polyline points="7 10 12 15 17 10" />
              <line x1="12" y1="15" x2="12" y2="3" />
            </svg>
            Descargar
          </button>
          <div class="sep"></div>
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="18" cy="5" r="3" />
              <circle cx="6" cy="12" r="3" />
              <circle cx="18" cy="19" r="3" />
              <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
              <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
            </svg>
            Compartir
          </button>
        </div>
      </article>

      <article class="post">
        <div class="post-head">
          <div class="av av5">CM</div>
          <div class="post-meta">
            <div class="post-author-row">Carlos Mendoza <span class="badge b-alu">Alumno</span></div>
            <div class="post-time">Hace 1 día · Bases de Datos</div>
          </div>
        </div>
        <div class="post-title">¿Cómo hacer migraciones en BD sin tiempo de inactividad?</div>
        <div class="post-body">Proyecto final requiere ALTER TABLE en producción. ¿Alguien ha probado Flyway o
          Liquibase? Busco estrategia para cero downtime.</div>
        <div class="tags">
          <span class="tag tb">Pregunta</span>
          <span class="tag tg">MySQL</span>
          <span class="tag to">DevOps</span>
        </div>
        <div class="post-foot">
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path
                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
            14
          </button>
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
            </svg>
            5
          </button>
          <div class="sep"></div>
          <button class="act act-hi">✓ Responder</button>
        </div>
      </article>

      <article class="post">
        <div class="post-head">
          <div class="av av1">AD</div>
          <div class="post-meta">
            <div class="post-author-row">Administración Académica <span class="badge b-admin">Admin</span></div>
            <div class="post-time">Hace 2 días · Avisos</div>
          </div>
        </div>
        <div class="post-title">Mantenimiento — Sábado 10 mayo, 2:00–6:00 am</div>
        <div class="post-body">Mantenimiento preventivo en servidores. Portales de calificaciones, correo y foro estarán
          fuera de servicio ese horario.</div>
        <div class="tags">
          <span class="tag tb">Aviso</span>
          <span class="tag tg">Plataforma</span>
        </div>
        <div class="post-foot">
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path
                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
            22
          </button>
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
            </svg>
            3
          </button>
          <div class="sep"></div>
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="18" cy="5" r="3" />
              <circle cx="6" cy="12" r="3" />
              <circle cx="18" cy="19" r="3" />
              <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
              <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
            </svg>
            Compartir
          </button>
        </div>
      </article>

      <article class="post">
        <div class="post-head">
          <div class="av av4">MF</div>
          <div class="post-meta">
            <div class="post-author-row">Mía Fuentes <span class="badge b-alu">Alumna</span></div>
            <div class="post-time">Hace 3 días · Redes y Comunicaciones</div>
          </div>
        </div>
        <div class="post-title">Grupo de estudio para Redes — ¿quién se apunta?</div>
        <div class="post-body">Sesión de estudio para el examen del miércoles. OSI, subnetting CIDR y Wireshark.
          Biblioteca, sala B-204, 4 pm.</div>
        <div class="tags">
          <span class="tag tg">Grupo de Estudio</span>
          <span class="tag tb">Redes</span>
          <span class="tag to">Presencial</span>
        </div>
        <div class="post-foot">
          <button class="act liked">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" stroke="none">
              <path
                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
            </svg>
            37
          </button>
          <button class="act">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
            </svg>
            19
          </button>
          <div class="sep"></div>
          <button class="act act-hi">✓ Me uno</button>
        </div>
      </article>

    </div>

    <div class="pagination">
      <button class="pg">‹</button>
      <button class="pg active">1</button>
      <button class="pg">2</button>
      <button class="pg">3</button>
      <span style="color:var(--tx3);font-size:12px;padding:0 4px;">…</span>
      <button class="pg">12</button>
      <button class="pg">›</button>
    </div>
  </main>

  <aside class="sidebar">

    <div class="sc">
      <div class="sc-title">Actividad</div>
      <div class="stats-row">
        <div class="stat">
          <div class="stat-n">1,248</div>
          <div class="stat-l">Posts</div>
        </div>
        <div class="stat">
          <div class="stat-n">342</div>
          <div class="stat-l">Miembros</div>
        </div>
        <div class="stat">
          <div class="stat-n">58</div>
          <div class="stat-l">En línea</div>
        </div>
        <div class="stat">
          <div class="stat-n">4.8k</div>
          <div class="stat-l">Respuestas</div>
        </div>
      </div>
    </div>

    <div class="sc">
      <div class="sc-title">Categorías</div>
      <div class="cat-row">Apuntes y Recursos <span class="cat-n">204</span></div>
      <div class="cat-row">Preguntas <span class="cat-n">178</span></div>
      <div class="cat-row">Avisos Oficiales <span class="cat-n">52</span></div>
      <div class="cat-row">Grupos de Estudio <span class="cat-n">89</span></div>
      <div class="cat-row">Proyectos <span class="cat-n">67</span></div>
      <div class="cat-row">Prácticas <span class="cat-n">41</span></div>
    </div>

    <div class="sc">
      <div class="sc-title">Trending</div>
      <div class="trend-row"><span class="trend-i">1</span>
        <div>
          <div class="trend-name">#ProyectoFinal</div>
          <div class="trend-c">128 esta semana</div>
        </div>
      </div>
      <div class="trend-row"><span class="trend-i">2</span>
        <div>
          <div class="trend-name">#BasesDeDatos</div>
          <div class="trend-c">94 publicaciones</div>
        </div>
      </div>
      <div class="trend-row"><span class="trend-i">3</span>
        <div>
          <div class="trend-name">#ExamenParcial</div>
          <div class="trend-c">81 publicaciones</div>
        </div>
      </div>
      <div class="trend-row"><span class="trend-i">4</span>
        <div>
          <div class="trend-name">#GrupoEstudio</div>
          <div class="trend-c">66 publicaciones</div>
        </div>
      </div>
    </div>

    <div class="sc">
      <div class="sc-title">Activos ahora</div>
      <div class="u-row">
        <div class="av av3" style="width:28px;height:28px;font-size:10px;">DR</div>
        <div>
          <div class="u-name">Dr. Ramírez</div>
          <div class="u-sub">Docente</div>
        </div>
        <div class="sep"></div>
        <div class="dot"></div>
      </div>
      <div class="u-row">
        <div class="av av2" style="width:28px;height:28px;font-size:10px;">VL</div>
        <div>
          <div class="u-name">Valentina L.</div>
          <div class="u-sub">6to sem.</div>
        </div>
        <div class="sep"></div>
        <div class="dot"></div>
      </div>
      <div class="u-row">
        <div class="av av4" style="width:28px;height:28px;font-size:10px;">MF</div>
        <div>
          <div class="u-name">Mía Fuentes</div>
          <div class="u-sub">4to sem.</div>
        </div>
        <div class="sep"></div>
        <div class="dot"></div>
      </div>
      <div class="u-row">
        <div class="av av5" style="width:28px;height:28px;font-size:10px;">CM</div>
        <div>
          <div class="u-name">Carlos M.</div>
          <div class="u-sub">6to sem.</div>
        </div>
        <div class="sep"></div>
        <div class="dot off"></div>
      </div>
    </div>

  </aside>
</div>

<div class="overlay" id="overlay" onclick="closeOut(event)">
  <div class="modal">
    <div class="m-head">
      <h2>Nueva Publicación</h2>
      <button class="m-close" onclick="closeModal()">×</button>
    </div>
    <div class="fg">
      <label class="fl">Título *</label>
      <input class="fi" type="text" placeholder="Ej: Apuntes de Estructuras de Datos">
    </div>
    <div class="fg">
      <label class="fl">Contenido *</label>
      <textarea class="fta" placeholder="Escribe tu publicación…"></textarea>
    </div>
    <div class="frow">
      <div class="fg">
        <label class="fl">Tipo</label>
        <select class="fsel">
          <option>Texto</option>
          <option>Imagen</option>
          <option>Video</option>
          <option>Link</option>
        </select>
      </div>
      <div class="fg">
        <label class="fl">Categoría</label>
        <select class="fsel">
          <option>Apuntes</option>
          <option>Pregunta</option>
          <option>Aviso</option>
          <option>Grupo</option>
          <option>Proyecto</option>
        </select>
      </div>
    </div>
    <div class="m-foot">
      <button class="btn-s" onclick="closeModal()">Cancelar</button>
      <button class="btn-p" onclick="closeModal()">Publicar</button>
    </div>
  </div>
</div>
