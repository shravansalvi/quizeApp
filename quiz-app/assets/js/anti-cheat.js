let quizStarted = false;
let submitted = false;
let visibilityTriggered = false;

/* Disable basic actions */
["contextmenu", "copy", "paste", "selectstart"].forEach(evt => {
    document.addEventListener(evt, e => e.preventDefault());
});

/* Start protection AFTER page load */
window.addEventListener("load", () => {
    setTimeout(() => {
        quizStarted = true;
    }, 1500); // allow page settle
});

/* Visibility change (TAB SWITCH) */
document.addEventListener("visibilitychange", () => {
    if (!quizStarted || submitted) return;

    if (document.hidden && !visibilityTriggered) {
        visibilityTriggered = true;
        autoSubmit("Tab switching detected!");
    }
});

/* Fullscreen enforcement (USER MUST ENTER FULLSCREEN) */
document.addEventListener("fullscreenchange", () => {
    if (!quizStarted || submitted) return;

    if (!document.fullscreenElement) {
        autoSubmit("Fullscreen exited!");
    }
});

/* DevTools detection (SAFE VERSION) */
setInterval(() => {
    if (!quizStarted || submitted) return;

    const threshold = 300;
    if (
        Math.abs(window.outerWidth - window.innerWidth) > threshold ||
        Math.abs(window.outerHeight - window.innerHeight) > threshold
    ) {
        autoSubmit("DevTools detected!");
    }
}, 2000);

/* Auto submit function */
function autoSubmit(reason) {
    if (submitted) return;
    submitted = true;

    alert(reason + " Quiz will be submitted.");

    const form = document.getElementById("quizForm");
    if (form) form.submit();
}
