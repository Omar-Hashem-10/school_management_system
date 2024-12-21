# School Management System

## Project Overview

The **School Management System** is a comprehensive solution designed to streamline school operations by managing users and their roles, class schedules, attendance, and more. The system provides distinct access levels and functionalities for different roles, ensuring an efficient and organized workflow.

---

## Key Roles in the System

- **Admin**: Full access to all sections and functionalities.
- **Manager**: Restricted access; cannot add or remove Admin users.
- **HR**: Access to employee-related functionalities.
- **Academic Affairs**: Access to student and academic-related functionalities.
- **Students**: Limited to personal schedules, tasks, and grades.
- **Teachers**: Can manage exams, tasks, and provide feedback to students.

---

## Features

### **Section: Management**

#### Levels and Subjects
- Define levels taught in the school.
- Assign subjects to specific levels via `level_subjects`.
- Manage subject codes (`course_code`).

#### Classrooms and Scheduling
- Add classrooms per academic year.
- Define school days and time slots.
- Create schedules for each class.

---

### **Section: Users**
- Manage all user types:
  - Admin, Employees, Teachers, Guardians, Students.
- Manage roles and salaries.
- View student grades, attendance, and yearly results.

---

### **Section: Attendance**
- Record attendance for:
  - Students.
  - Employees (including teachers and admins).

---

## Access Levels

- **Admin**: Complete access to all sections.
- **Manager**: Restricted access:
  - Cannot add or remove Admins.
- **HR**: Access to:
  - Section: Users: Manage Teachers, Employees, Salaries.
  - Section: Attendance: Manage attendance for Employees, Teachers, Admins.
- **Academic Affairs**: Access to:
  - Section: Management: Manage Levels, Subjects, Classrooms, etc.
  - Section: Users: Manage Students, Guardians.
  - Section: Attendance: Record student attendance.
- **Students**:
  - View personal schedules and exams.
  - Submit tasks and receive feedback.
  - Access grades and send contact messages to the manager.
  - Restricted access if fees are unpaid.
- **Teachers**:
  - Create exams and questions (MCQs, True/False).
  - Assign tasks to students and provide feedback.
  - Send contact messages to the manager.

---

## Technologies Used

- **Backend Framework**: PHP, Laravel.
- **Payment Integration**.
- **Email Services**: Mailtrap.
- **Localization**: Laravel Localization.
- **API Development**.

---

## Getting Started

### Prerequisites
- Install **Composer**.
- Install **PHP**.

### Installation
1. Clone the repository to your local machine.
2. Run the following command to reset and seed the database:
   ```bash
   php artisan migrate:fresh --seed
3.Install the localization package:
   ```bash
composer require mcamara/laravel-localization
```

## Running the Project
1. Start the local development server:
```bash
php artisan serve
Access the application via http://localhost:8000.
```

## Notes
1. Ensure all environment configurations are set correctly in the .env file.
2. Payment integration and email configurations should be tested before deployment.

## Future Enhancements
1. Add reporting and analytics features.
2. Integrate with third-party educational platforms.
3. Enhance UI/UX for better accessibility.
