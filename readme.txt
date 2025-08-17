Step-by-step setup ===>>

1) Start the servers
Open XAMPP Control Panel.
Click Start for Apache and MySQL (both should turn green).

2) Create the database & tables
Open your browser → go to http://localhost/phpmyadmin.
Click Databases → create a DB named "student_dashboard".
Select the new DB → click SQL → paste and run:

-- Create tables
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    student_id VARCHAR(20) UNIQUE NOT NULL,
    phone VARCHAR(15),
    cgpa DECIMAL(3,2),
    batch VARCHAR(20)
);
-- Create default admin user (username: admin, password: admin123)
INSERT INTO users (username, password) 
VALUES ('hellofirstlove', MD5('iloveyou'));


3) Create the project folder
Go to your XAMPP web root:  C:\xampp\htdocs\
Create a folder: student_dashboard

Your structure should look like this when you’re done:
C:\xampp\htdocs\student_dashboard\
│── db.php
│── login.php
│── dashboard.php
│── add_student.php
│── delete_student.php
│── logout.php
│── style.css
│── uploads\
      └── profile.png   (your profile logo image)


4) Add the files 
If your MySQL credentials differ, open db.php and set:

$host = "localhost";
$user = "root";
$pass = ""; // default XAMPP MySQL password is empty
$dbname = "student_dashboard";

5) Run the app

In your browser go to: http://localhost/student_dashboard/login.php

Log in with:
Username: hellofirstlove
Password: iloveyou

You’ll land on the Dashboard:
See the profile logo in the top bar
See the student list (empty at first)
Click + Add Student to add records (Name, ID, Phone, CGPA, Batch)
Use Delete to remove a student

6) Move profile logo to left / right

Open style.css and tweak the top bar:

For right (default):

.top-bar { display:flex; align-items:center; gap:12px; }
.profile-logo { margin-left: 0; }
.logout-btn { margin-left: auto; }   /* pushes logout (and welcome) to right */


For left: swap the order in dashboard.php or add:

.top-bar { justify-content: flex-start; }


(or place <img> first/last in the .top-bar markup to choose which side).

7) Common issues & quick fixes

Blank page / errors hidden
In php.ini, set display_errors = On and restart Apache. Or add to top of a PHP file (for development only):

ini_set('display_errors',1); error_reporting(E_ALL);

“Access denied” DB error
Check db.php credentials, ensure DB name is exactly student_dashboard.

Login always fails
Ensure you ran the INSERT INTO users... query and that the password is MD5 in DB.
(Better later: migrate to password_hash().)

Delete not working
Make sure the URL shows ?id=NUMBER and that the students table has data.

(Optional) Quick security upgrades (when you’re ready)
Replace MD5 with password_hash()/password_verify() for users.
Use prepared statements to prevent SQL injection.
Add CSRF tokens for POST actions (add/delete).
Validate input (e.g., CGPA between 0.00–4.00).
