import { initializeApp } from
"https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";

import { getAuth } from
"https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

import { getDatabase } from
"https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js";

const firebaseConfig = {
  apiKey: "AIzaSyAiWIIPynr1ro_J16GKWOKQCIuQ8jAvy6c",
  authDomain: "quiz-app-c39c3.firebaseapp.com",
  databaseURL: "https://quiz-app-c39c3-default-rtdb.firebaseio.com",
 projectId: "quiz-app-c39c3",
  storageBucket: "quiz-app-c39c3.firebasestorage.app",
  messagingSenderId: "139212464622",
  appId: "1:139212464622:web:6eb6532d5674e41a75aeff",
  measurementId: "G-9BCXQKS7HW"
};

const app = initializeApp(firebaseConfig);

export const auth = getAuth(app);
export const db = getDatabase(app);
