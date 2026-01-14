// ===============================
// Anti-Cheat Configuration
// ===============================
let violations = 0;
const MAX_VIOLATIONS = 2; // after this → auto submit

// ===============================
// Helper: Handle Violation
// ===============================
function handleViolation(reason) {
    violations++;

    alert(
        `⚠️ Security Alert!\n\n` +
        `Reason: ${reason}\n` +
        `Violation Count: ${violations}/${MAX_VIOLATIONS}`
    );

    // Store violations (useful for backend later)
    sessionStorage.setItem("violations", violations);

    if (violations >= MAX_VIOLATIONS) {
        alert("❌ Exam terminated due to suspicious activity.");
        submitExam();
    }
}

// ===============================
// 1️⃣ Tab Switch Detection
// ===============================
document.addEventListener("visibilitychange", () => {
    if (document.hidden) {
        handleViolation("Tab switching detected");
    }
});

// ===============================
// 2️⃣ Fullscreen Exit Detection
// ===============================
document.addEventListener("fullscreenchange", () => {
    if (!document.fullscreenElement) {
        handleViolation("Exited fullscreen mode");
    }
});

// ===============================
// 3️⃣ Disable Right Click
// ===============================
document.addEventListener("contextmenu", (e) => {
    e.preventDefault();
    handleViolation("Right-click attempt");
});

// ===============================
// 4️⃣ Block Copy / Paste / DevTools Keys
// ===============================
document.addEventListener("keydown", (e) => {

    // Block Ctrl+C, Ctrl+V, Ctrl+X
    if (e.ctrlKey && ["c", "v", "x"].includes(e.key.toLowerCase())) {
        e.preventDefault();
        handleViolation("Copy/Paste attempt");
    }

    // Block F12 (DevTools)
    if (e.key === "F12") {
        e.preventDefault();
        handleViolation("Developer tools attempt");
    }

    // Block Ctrl+Shift+I / J
    if (e.ctrlKey && e.shiftKey && ["i", "j"].includes(e.key.toLowerCase())) {
        e.preventDefault();
        handleViolation("Developer tools attempt");
    }

    // Detect PrintScreen (cannot fully block)
    if (e.key === "PrintScreen") {
        handleViolation("Screenshot attempt");
    }
});

// ===============================
// 5️⃣ Auto Submit Function
// ===============================
function submitExam() {
    // Optional: calculate score here before redirect

    // Save final violation count
    sessionStorage.setItem("finalViolations", violations);

    // Redirect to result page
    window.location.href = "result.html";
}
