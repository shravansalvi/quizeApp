🧠 Quiz Battle Application – README
📌 Overview

This project is a Two-Team Quiz Battle Web Application designed for competitions and tech fests.
Two teams compete simultaneously on the same question, answers are timed, scored, and the winner is decided fairly using points and time.

The system supports:

Normal round (15 questions)

Automatic result evaluation

Tie-breaker (Sudden Death – 1 question)

Accurate per-question logging

Time-based tie resolution

🏗️ Tech Stack

Frontend: HTML, CSS, JavaScript

Backend: PHP (Session-based)

Database: MySQL

Server: XAMPP (Apache + PHP)


quiz-app/
│
├── index.php                  # Team entry page
│
├── battle/
│   ├── battle.php             # Main quiz battle screen
│   ├── fetch-question.php     # Fetches questions from DB
│   ├── save-result.php        # Saves per-question result (session)
│   ├── result.php             # Handles result logic + tie-breaker
│   └── final-result.php       # Displays detailed result table
│
├── assets/
│   ├── css/
│   │   └── battle.css
│   └── js/
│       └── quiz-battle.js
│
├── config/
│   └── db.php                 # Database connection
│
└── README.md


🚀 Application Flow (Step by Step)
1️⃣ Team Entry (index.php)

User enters Team A and Team B names.

On clicking Start:

Previous quiz session data is cleared.

Team names are stored in PHP session.

Redirects to battle/battle.php.

2️⃣ Quiz Battle Screen (battle.php)

Displays:

Question

10-second timer

Options for both teams

Live score (Team A vs Team B)

Loads quiz-battle.js for all quiz logic.

3️⃣ Fetching Questions (fetch-question.php)

Fetches only SQL category questions from database.

Logic:

Normal round → 15 questions max

Tie-breaker → only 1 question

Sends JSON response: 🚀 Application Flow (Step by Step)
1️⃣ Team Entry (index.php)

User enters Team A and Team B names.

On clicking Start:

Previous quiz session data is cleared.

Team names are stored in PHP session.

Redirects to battle/battle.php.

2️⃣ Quiz Battle Screen (battle.php)

Displays:

Question

10-second timer

Options for both teams

Live score (Team A vs Team B)

Loads quiz-battle.js for all quiz logic.

3️⃣ Fetching Questions (fetch-question.php)

Fetches only SQL category questions from database.

Logic:

Normal round → 15 questions max

Tie-breaker → only 1 question

Sends JSON response:{
  "count": 1,
  "question": "...",
  "options": {...},
  "correct": "B"
}
{
  "count": 1,
  "question": "...",
  "options": {...},
  "correct": "B"
}
