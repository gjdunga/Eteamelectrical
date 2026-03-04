(function() {
  // Sticky header background on scroll
  var header = document.getElementById('site-header');
  if (header) {
    var onScroll = function() {
      if (window.scrollY > 60) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // Mobile nav toggle
  var toggle = document.getElementById('nav-toggle');
  var nav = document.getElementById('primary-menu');
  if (toggle && nav) {
    toggle.addEventListener('click', function() {
      var open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    nav.querySelectorAll('a').forEach(function(a) {
      a.addEventListener('click', function() {
        nav.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  // Scroll reveal
  var reveals = document.querySelectorAll('.reveal');
  if (reveals.length > 0 && 'IntersectionObserver' in window) {
    var revealObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    reveals.forEach(function(el) { revealObserver.observe(el); });
  }

  // Video autoplay on scroll
  var autoVideos = document.querySelectorAll('video[data-autoscroll]');
  if (autoVideos.length > 0 && 'IntersectionObserver' in window) {
    var videoObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        var vid = entry.target;
        var playBtn = vid.parentElement.querySelector('.tile-play');
        if (entry.isIntersecting) {
          vid.play().then(function() {
            if (playBtn) playBtn.classList.add('playing');
          }).catch(function() {});
        } else {
          vid.pause();
          if (playBtn) playBtn.classList.remove('playing');
        }
      });
    }, { threshold: 0.4 });

    autoVideos.forEach(function(v) { videoObserver.observe(v); });
  }
})();
