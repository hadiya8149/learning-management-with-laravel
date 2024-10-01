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


