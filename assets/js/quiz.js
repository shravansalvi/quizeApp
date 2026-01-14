
import { initializeApp } from
"https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";

import { getDatabase, ref, get } from
"https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js";

// 🔹 Firebase Config (same as upload)
const firebaseConfig = {
  apiKey: "AIzaSyAiWIIPynr1ro_J16GKWOKQCIuQ8jAvy6c",
  authDomain: "quiz-app-c39c3.firebaseapp.com",
  databaseURL: "https://quiz-app-c39c3-default-rtdb.firebaseio.com",
  projectId: "quiz-app-c39c3"
};
// 🔥 Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

// ===============================
// Quiz Variables
// ===============================
let questions = [];
let currentIndex = 0;
let userAnswers = [];

// ===============================
// Get HTML Elements
// ===============================
const questionNo = document.querySelector(".question-no");
const questionText = document.querySelector(".question-text");
const optionsBox = document.querySelector(".options");
const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");
const submitBtn = document.querySelector(".submit");

// ===============================
// Load Questions from Firebase
// ===============================
async function loadQuestionsFromFirebase() {
  const snapshot = await get(ref(db, "questions"));

  if (!snapshot.exists()) {
    alert("❌ No questions found in database");
    return;
  }

  let allQuestions = Object.values(snapshot.val());

  // 🔀 Shuffle questions
  allQuestions.sort(() => Math.random() - 0.5);

  // 🎯 Pick 10 questions
  questions = allQuestions.slice(0, 10);

  userAnswers = new Array(questions.length).fill(null);

  loadQuestion();
}

// ===============================
// Load Question
// ===============================
function loadQuestion() {
  const q = questions[currentIndex];

  questionNo.textContent =
    `Question ${currentIndex + 1} of ${questions.length}`;
  questionText.textContent = q.question;

  optionsBox.innerHTML = "";

  q.options.forEach((opt, i) => {
    const checked = userAnswers[currentIndex] === i ? "checked" : "";
    optionsBox.innerHTML += `
      <input type="radio" name="option" id="opt${i}" ${checked}>
      <label for="opt${i}" onclick="selectOption(${i})">${opt}</label>
    `;
  });
}

// ===============================
// Select Option
// ===============================
window.selectOption = function (index) {
  userAnswers[currentIndex] = index;
};

// ===============================
// Navigation Buttons
// ===============================
nextBtn.onclick = () => {
  if (currentIndex < questions.length - 1) {
    currentIndex++;
    loadQuestion();
  }
};

prevBtn.onclick = () => {
  if (currentIndex > 0) {
    currentIndex--;
    loadQuestion();
  }
};

// ===============================
// Submit Exam
// ===============================
submitBtn.onclick = () => submitExam();

function calculateScore() {
  let score = 0;
  questions.forEach((q, i) => {
    if (userAnswers[i] === q.correct) score++;
  });
  return score;
}

function submitExam() {
  const score = calculateScore();
  sessionStorage.setItem("score", score);
  sessionStorage.setItem("total", questions.length);
  window.location.href = "result.html";
}

// 🚀 Start Quiz
loadQuestionsFromFirebase();
