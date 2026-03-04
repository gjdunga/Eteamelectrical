(function(){
  var btn = document.querySelector('.nav-toggle');
  var nav = document.querySelector('#primary-menu');
  if(!btn || !nav) return;

  btn.addEventListener('click', function() {
    var expanded = btn.getAttribute('aria-expanded') === 'true';
    btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
    nav.style.display = expanded ? 'none' : 'block';
  });
})();
