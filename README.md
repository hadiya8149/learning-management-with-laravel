Quiz Management System (README)
A comprehensive Laravel-based application for managing quizzes, users, and roles with robust authentication and authorization mechanisms.
Table of Contents
Features
Installation
Usage
Authentication
Roles and Permissions
Quiz Management
Student Submissions
API Endpoints
Seeded Users
Contributing
License

Features
Role-Based Access Control (RBAC): Manage users with roles such as Admin, Manager, and Student using Spatie Laravel Permission package.
JWT Authentication: Secure login system for all users using JSON Web Tokens.
Quiz Assignment and Scheduling: Assign quizzes to students with scheduling and expiration logic.
Email Notifications: Automated emails for password setup, password resets, and submission status updates.
Student Submissions: Public form for students to submit applications with file uploads (CVs).
Real-Time Result Calculation: Immediate feedback and score calculation upon quiz submission.
Video Recording: Students can record and upload videos during quiz attempts for integrity checks.
Admin and Manager Dashboards: Filter and manage students and quizzes efficiently.

Installation
Prerequisites
PHP >= 8.0
Composer
MySQL
Git
Steps
Clone the Repository
bash
Copy code

cd quiz_management
Install Dependencies
bash
Copy code
composer install
Copy .env File
bash
cp .env.example .env
Generate Application Key
bash
Copy code
php artisan key:generate
Configure .env File
Update database credentials:
env
DB_DATABASE=quiz_management
Configure mail settings for email notifications.
Run Migrations and Seeders
php artisan migrate --seed
Set Up Storage Link
php artisan storage:link
Start the Development Server
php artisan serve
Usage
Authentication
Login using the seeded users or create new accounts.
JWT Tokens are used for authenticated routes.
Roles and Permissions
Admin: Full access to manage users, quizzes, and submissions.
Manager: Can assign quizzes and view students.
Student: Can view and attempt assigned quizzes.
Quiz Management
Create Quizzes: Admins and Managers can create quizzes.
Assign Quizzes: Assign quizzes to students with scheduling.
Attempt Quizzes: Students can attempt quizzes during the active period.
Results: Immediate feedback after quiz submission.
Student Submissions
Public Form: Accessible without authentication.
File Uploads: Supports CV uploads in PDF, DOC, DOCX formats.
Admin Review: Admins can accept or reject submissions.

API Endpoints
Authentication Routes
POST /login - User login.
POST /logout - User logout.
POST /password/forgot - Request password reset.
POST /password/reset - Reset password.
POST /password/resend-link - Resend password setup link.
User Management Routes
POST /admin/add-manager - Admin adds a manager.
POST /admin/add-student - Admin adds a student.
POST /manager/add-student - Manager adds a student.
Student Submission Routes
POST /student-submission - Submit student application.
GET /student-submission/{id}/download-cv - Download student's CV.
GET /submissions/pending - Get pending submissions.
Quiz Routes
POST /quizzes - Create a quiz.
GET /quizzes - Get all quizzes.
POST /assign-quiz - Assign quiz to student.
GET /student/{id}/quizzes - Get assigned quizzes.
POST /quiz-attempts - Store quiz attempt.
POST /quiz-results - Calculate and store quiz result.
Seeded Users
After running the seeders, you can use the following credentials:
