document.addEventListener('DOMContentLoaded', function () {

  // Revelado progresivo al hacer scroll 
  var singles = document.querySelectorAll('.reveal');
  var groups = document.querySelectorAll('.reveal-stagger');
  var revealItems = Array.prototype.slice.call(singles);
  groups.forEach(function (group) {
    Array.prototype.slice.call(group.children).forEach(function (child, i) {
      child.classList.add('reveal-item');
      child.style.transitionDelay = (Math.min(i, 5) * 70) + 'ms';
      revealItems.push(child);
    });
  });

  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) {
          en.target.classList.add('in');
          io.unobserve(en.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    revealItems.forEach(function (el) { io.observe(el); });
  } else {
    revealItems.forEach(function (el) { el.classList.add('in'); });
  }

});