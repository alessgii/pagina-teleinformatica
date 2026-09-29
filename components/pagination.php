<?php

if (isset($totalPaginas) && $totalPaginas > 1): 
    $ordenParam = isset($orden) ? '&orden=' . urlencode($orden) : '';
?>
<nav class="flex items-center justify-center gap-2 mt-12 mb-6" aria-label="Navegación de páginas">
    
    <!-- Botón Anterior -->
    <?php if ($paginaActual > 1): ?>
        <a 
            href="<?php echo $baseUrl; ?>index.php?page=noticias<?php echo $ordenParam; ?>&p=<?php echo $paginaActual - 1; ?>"
            class="px-3.5 py-2 rounded-full border border-border-main text-text-mid hover:border-navy hover:text-navy text-sm font-semibold transition-colors no-underline flex items-center gap-1"
        >
            ‹ Anterior
        </a>
    <?php else: ?>
        <span class="px-3.5 py-2 rounded-full border border-border-lt text-text-muted text-sm font-semibold opacity-50 cursor-not-allowed">
            ‹ Anterior
        </span>
    <?php endif; ?>

    <!-- Números de Página -->
    <div class="flex items-center gap-1.5 px-2">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <?php if ($i == $paginaActual): ?>
                <span class="w-9 h-9 flex items-center justify-center rounded-full bg-navy text-white font-bold text-sm shadow-sm">
                    <?php echo $i; ?>
                </span>
            <?php else: ?>
                <a 
                    href="<?php echo $baseUrl; ?>index.php?page=noticias<?php echo $ordenParam; ?>&p=<?php echo $i; ?>"
                    class="w-9 h-9 flex items-center justify-center rounded-full border border-border-main text-text-mid hover:border-navy hover:text-navy font-semibold text-sm transition-colors no-underline"
                >
                    <?php echo $i; ?>
                </a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>

    <!-- Botón Siguiente -->
    <?php if ($paginaActual < $totalPaginas): ?>
        <a 
            href="<?php echo $baseUrl; ?>index.php?page=noticias<?php echo $ordenParam; ?>&p=<?php echo $paginaActual + 1; ?>"
            class="px-3.5 py-2 rounded-full border border-border-main text-text-mid hover:border-navy hover:text-navy text-sm font-semibold transition-colors no-underline flex items-center gap-1"
        >
            Siguiente ›
        </a>
    <?php else: ?>
        <span class="px-3.5 py-2 rounded-full border border-border-lt text-text-muted text-sm font-semibold opacity-50 cursor-not-allowed">
            Siguiente ›
        </span>
    <?php endif; ?>

</nav>
<?php endif; ?>