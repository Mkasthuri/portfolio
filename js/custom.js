const typed = new Typed('#typed-output', {
    strings: ["Web Designer", "UI/UX Designer"],
    typeSpeed: 50,
    backSpeed: 50,
    backDelay: 1000,
    startDelay: 100,
    loop: true,
    showCursor: true,
    cursorChar: '|',
  });

window.onscroll = function() {
  const btn = document.getElementById("scrollTopBtn");
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    btn.style.display = "block";
  } else {
    btn.style.display = "none";
  }
};

// Scroll to top smoothly on click
document.getElementById("scrollTopBtn").addEventListener("click", function(){
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

