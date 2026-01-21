document.addEventListener("contextmenu", e => e.preventDefault());
document.addEventListener("copy", e => e.preventDefault());
document.addEventListener("paste", e => e.preventDefault());
document.addEventListener("selectstart", e => e.preventDefault());

document.addEventListener("visibilitychange", () => {
  if (document.hidden) {
    alert("Cheating detected!");
    document.getElementById("quizForm").submit();
  }
});

document.addEventListener("DOMContentLoaded", () => {

    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(() => {});
    }

    document.addEventListener("fullscreenchange", () => {
        if (!document.fullscreenElement) {
            alert("Fullscreen exited. Quiz will be submitted.");
            document.getElementById("quizForm")?.submit();
        }
    });

});


setInterval(() => {
  if (window.outerWidth - window.innerWidth > 200) {
    alert("DevTools detected!");
    document.getElementById("quizForm").submit();
  }
}, 1000);
