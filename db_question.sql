CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    option1 VARCHAR(255),
    option2 VARCHAR(255),
    option3 VARCHAR(255),
    option4 VARCHAR(255),
    correct_option INT
);


//question 

INSERT INTO questions (question, option1, option2, option3, option4, correct_option) VALUES
('What does SQL stand for?',
 'Structured Query Language','Simple Query Language','System Query Language','Sequential Query Language',1),

('Which SQL statement is used to extract data from a database?',
 'GET','EXTRACT','SELECT','OPEN',3),

('Which SQL command is used to create a table?',
 'MAKE','CREATE TABLE','ADD TABLE','NEW TABLE',2),

('Which command removes all records from a table but keeps its structure?',
 'DELETE','DROP','TRUNCATE','REMOVE',3),

('Which SQL clause is used to filter records?',
 'ORDER BY','GROUP BY','WHERE','HAVING',3),

('Which SQL keyword is used to sort the result set?',
 'SORT','ORDER BY','GROUP','FILTER',2),

('Which operator is used to check NULL values?',
 '=','IS NULL','NULL','CHECK',2),

('Which SQL command is used to remove a table permanently?',
 'DELETE','REMOVE','TRUNCATE','DROP TABLE',4),

('Which function returns the total number of rows?',
 'TOTAL()','SUM()','COUNT()','NUMBER()',3),
/////////
('Which SQL clause is used with aggregate functions?',
 'WHERE','GROUP BY','ORDER BY','HAVING',2),

('Which constraint ensures unique values in a column?',
 'NOT NULL','PRIMARY KEY','UNIQUE','CHECK',3),

('A Primary Key can contain:',
 'Duplicate values','NULL values','Both NULL and duplicate values','Neither NULL nor duplicate values',4),

('Which constraint is used to link two tables?',
 'UNIQUE','CHECK','FOREIGN KEY','DEFAULT',3),

('Which SQL command is a DML command?',
 'CREATE','DROP','INSERT','ALTER',3),

('Which command modifies existing data in a table?',
 'UPDATE','MODIFY','CHANGE','ALTER',1),

('Which SQL command adds a new column to a table?',
 'ADD','UPDATE','ALTER TABLE','INSERT',3),

('Which clause is used to filter grouped data?',
 'WHERE','HAVING','GROUP BY','FILTER',2),

('Which data type is used to store text?',
 'INT','CHAR / VARCHAR','FLOAT','DATE',2),

('Which keyword is used to prevent duplicate rows?',
 'UNIQUE','DISTINCT','PRIMARY','CHECK',2),

('Which SQL function returns the highest value?',
 'MAX()','HIGH()','TOP()','UPPER()',1),

('Which SQL function returns the lowest value?',
 'LOW()','MIN()','SMALL()','LESS()',2),

('Which command removes specific rows from a table?',
 'DROP','TRUNCATE','DELETE','REMOVE',3),

('Which SQL command changes table structure?',
 'MODIFY','UPDATE','ALTER','CHANGE',3),

('Which join returns only matching records?',
 'LEFT JOIN','RIGHT JOIN','FULL JOIN','INNER JOIN',4),

('Which join returns all records from the left table?',
 'RIGHT JOIN','LEFT JOIN','FULL JOIN','INNER JOIN',2),

('Which join returns all records from both tables?',
 'LEFT JOIN','RIGHT JOIN','FULL JOIN','INNER JOIN',3),

('Which clause limits the number of rows returned?',
 'LIMIT','TOP','ROW','FETCH',1),

('Which SQL command is used to rename a table?',
 'CHANGE','MODIFY','RENAME TABLE','UPDATE',3),

('Which keyword is used to define default values?',
 'DEFAULT','SET','AUTO','VALUE',1),

('Which SQL function returns the average value?',
 'AVG()','MEAN()','MID()','TOTAL()',1),

('Which clause is executed first in a SELECT query?',
 'SELECT','WHERE','FROM','ORDER BY',3),

('Which SQL statement is used to create a database?',
 'CREATE DATABASE','NEW DATABASE','ADD DATABASE','MAKE DATABASE',1),

('Which constraint ensures a column cannot have NULL?',
 'CHECK','UNIQUE','NOT NULL','DEFAULT',3),

('Which command removes both data and structure?',
 'DELETE','TRUNCATE','DROP','REMOVE',3),

('Which SQL keyword is used to combine result sets?',
 'JOIN','UNION','MERGE','LINK',2),

('Which keyword is used to check a range?',
 'IN','BETWEEN','RANGE','FROM',2),

('Which SQL clause is used to group rows?',
 'ORDER BY','GROUP BY','WHERE','HAVING',2),

('Which operator is used for pattern matching?',
 'LIKE','MATCH','SEARCH','FIND',1),

('Which symbol is used as a wildcard for many characters?',
 '_','*','%','#',3),

('Which SQL command is used to view data?',
 'SHOW','SELECT','VIEW','DISPLAY',2),

('Which query selects all columns from student table?',
 'SELECT * FROM student;','SELECT ALL student;','SELECT student;','GET * student;',1),

('How to fetch names where age > 18?',
 'SELECT name FROM student WHERE age > 18;',
 'SELECT name WHERE age > 18;',
 'SELECT age > 18 FROM student;',
 'GET name FROM student;',1),

('Which query counts total employees?',
 'SELECT TOTAL() FROM employee;',
 'SELECT COUNT() FROM employee;',
 'SELECT NUMBER() FROM employee;',
 'SELECT SUM() FROM employee;',2),

('Which query finds maximum salary?',
 'SELECT HIGH(salary) FROM emp;',
 'SELECT MAX(salary) FROM emp;',
 'SELECT TOP(salary) FROM emp;',
 'SELECT salary MAX FROM emp;',2),

('Which query deletes records where id = 5?',
 'DELETE FROM table WHERE id = 5;',
 'REMOVE id = 5;',
 'DROP WHERE id = 5;',
 'TRUNCATE id = 5;',1),

('Which query updates salary to 50000 for emp_id 10?',
 'UPDATE emp SET salary=50000 WHERE emp_id=10;',
 'MODIFY emp salary=50000;',
 'CHANGE emp salary;',
 'SET salary=50000;',1),

('Which query sorts data by name?',
 'SELECT * FROM emp SORT BY name;',
 'SELECT * FROM emp ORDER BY name;',
 'SELECT name ORDER emp;',
 'SORT name FROM emp;',2),

('Which query selects unique departments?',
 'SELECT UNIQUE dept FROM emp;',
 'SELECT DISTINCT dept FROM emp;',
 'SELECT dept FROM emp GROUP;',
 'SELECT dept ONLY;',2),

('Which query joins two tables using common id?',
 'SELECT * FROM A JOIN B;',
 'SELECT * FROM A INNER JOIN B ON A.id = B.id;',
 'MERGE A AND B;',
 'CONNECT A B;',2),

('Which query finds employees with salary between 20000 and 40000?',
 'SELECT * FROM emp WHERE salary IN 20000 AND 40000;',
 'SELECT * FROM emp WHERE salary BETWEEN 20000 AND 40000;',
 'SELECT salary RANGE 20000 40000;',
 'SELECT * FROM emp WHERE salary > 20000 OR salary < 40000;',2);
