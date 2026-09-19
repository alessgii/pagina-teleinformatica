
(function () {
  'use strict';

  var toggle = document.querySelector('[data-menu-toggle]');
  var panel = document.querySelector('[data-menu-panel]');
  if (!toggle || !panel) return;

  var accordionBtns = Array.prototype.slice.call(
    panel.querySelectorAll('[data-accordion-btn]')
  );
  var desktopQuery = window.matchMedia('(min-width: 768px)');

  function setAccordion(btn, open) {
    var target = document.getElementById(btn.getAttribute('aria-controls'));
    if (!target) return;
    btn.setAttribute('aria-expanded', String(open));
    target.classList.toggle('hidden', !open);
  }

  function closeAccordions(except) {
    accordionBtns.forEach(function (btn) {
      if (btn !== except) setAccordion(btn, false);
    });
  }

  function setMenu(open) {
    toggle.setAttribute('aria-expanded', String(open));
    toggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
    panel.classList.toggle('hidden', !open);
    if (!open) closeAccordions(null);
  }

  function isOpen() {
    return toggle.getAttribute('aria-expanded') === 'true';
  }

  // Abrir / cerrar menú
  toggle.addEventListener('click', function () {
    setMenu(!isOpen());
  });

  // Acordeón: una sección abierta a la vez
  accordionBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var willOpen = btn.getAttribute('aria-expanded') !== 'true';
      closeAccordions(btn);
      setAccordion(btn, willOpen);
    });
  });

  // Cerrar al elegir un enlace
  panel.addEventListener('click', function (e) {
    if (e.target.closest('a')) setMenu(false);
  });

  // Cerrar al tocar fuera del navbar
  document.addEventListener('click', function (e) {
    if (isOpen() && !e.target.closest('nav')) setMenu(false);
  });

  // Cerrar con Escape y devolver el foco al botón
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && isOpen()) {
      setMenu(false);
      toggle.focus();
    }
  });

  // Cerrar al pasar a vista de escritorio
  var onBreakpointChange = function (e) {
    if (e.matches) setMenu(false);
  };
  if (desktopQuery.addEventListener) {
    desktopQuery.addEventListener('change', onBreakpointChange);
  } else {
    desktopQuery.addListener(onBreakpointChange); // Safari antiguo
  }
})();