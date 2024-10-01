# Quiz Management System

This document provides a comprehensive overview of the Quiz Management System, detailing the implementation of various features such as role-based access control, email notifications, quiz assignment logic, authentication mechanisms, and more. The system is built using the Laravel framework and leverages several packages and services to enhance functionality.

## Table of Contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Project Description](#project-description)
- [Requirements](#requirements)
- [Database Design](#database-design)
- [API Routes](#api-routes)
- [Packages](#packages)
- [Services](#services)
- [Controllers](#controllers)
- [Middleware](#middleware)
- [Events](#events)
- [Listeners](#listeners)
- [Jobs](#jobs)
- [Helper Functions](#helper-functions)
- [Request Validation](#request-validation)
- [Database Migration and Seeder](#database-migration-and-seeder)

## Introduction

The Quiz Management System is a backend system for students that allows them to take assigned quizzes and view real-time results. Students can retake quizzes to improve their scores, and the admin can review quiz attempts. The system is role-based, with specific functionalities for Admin, Manager, and Student roles.
## Integration
integrate with mailtrap and include email testing integration credentials in .env file


## Installation

To set up the project, follow these steps:

```bash
git clone https://github.com/hadiya8149/learning-management-with-laravel.git
cd learning-management-with-laravel
composer install


Project Description
This project provides a learning management system backend where:

Students can take quizzes and see real-time results.
Admins can review quiz recordings, approve or reject student registrations, and manage users.
Admins, Managers, and Supervisors can assign quizzes to students.
The system tracks quiz attempts and allows students to retake quizzes to improve scores.
Requirements
Admin and Manager Roles Setup:
Create a Seeder for the Admin role.
Implement role-based user management for Admin, Manager, and Student roles.
Allow Admin to add Managers via the back office.
Email Notifications:
Send an email to Managers and Students to set up passwords (valid for 24 hours) after Admin actions.
Handle logic for resending password setup emails if the link expires.
Send rejection emails for rejected student registration requests.
Quiz Management:
Allow Admin and Managers to assign quizzes to Students.
Implement quiz scheduling logic (activation 2 days after assignment).
Handle quiz expiration if not attempted within a defined time frame.
Manage video recording during quiz attempts for Admin review.
Permission System:
Admin: Manage users, accept/reject student requests, assign quizzes, and view students.
Manager: Assign quizzes and view students.
Student: View assigned quizzes and results.
JWT-Based Authentication:
Implement JWT authentication for Admin, Manager, and Student roles.
After password setup, users log in using JWT tokens to access their dashboards.
Student Public Form Submission:
Develop a public route for student registrations.
Handle file uploads (CVs in doc, pdf, csv, docx formats).
Send confirmation emails upon form submission.
Admin interface to accept/reject student requests.
Database Design
The database used is learning_management_system.

API Routes
Authentication
POST /login
Request body: