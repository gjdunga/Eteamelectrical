(function() {
  var btn = document.querySelector('.nav-toggle');
  var nav = document.querySelector('#primary-menu');
  if (!btn || !nav) return;

  btn.addEventListener('click', function() {
    var expanded = btn.getAttribute('aria-expanded') === 'true';
    btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
    nav.classList.toggle('open');
  });

  // Close nav when a link is clicked (mobile)
  nav.querySelectorAll('a').forEach(function(link) {
    link.addEventListener('click', function() {
      nav.classList.remove('open');
      btn.setAttribute('aria-expanded', 'false');
    });
  });
})();
