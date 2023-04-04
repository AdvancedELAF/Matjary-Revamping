var preloadTime;

function preloader() {
  preloadTime = setTimeout(showPage, 30000);
}

function showPage() {
  document.getElementById("preloader").style.display = "none";
}