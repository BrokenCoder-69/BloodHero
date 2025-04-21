// Show Scroll Button
window.onscroll = function () {
    const btn = document.querySelector('.scroll-top-btn');
    if (window.scrollY > 300) {
      btn.style.display = 'block';
    } else {
      btn.style.display = 'none';
    }
  };
  
  // Scroll to Top
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
  