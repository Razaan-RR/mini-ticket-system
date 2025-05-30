🎫 MINI TICKET SYSTEM

This is a PHP-based support ticketing system built without any framework.

-------------------------------------------------------
🔧 FEATURES

- ✅ User Registration (with role: agent or admin)
- ✅ Login system 
- ✅ Agents can:
    - Create support tickets
- ✅ Admins can:
    - Create, Update, and Delete departments
- ✅ Role-based access control
- ✅ Secure password hashing using PHP

-------------------------------------------------------
📁 FOLDER STRUCTURE (MVC STYLE)

mini-ticket-system/
│
├── config/           
├── models/           
├── controllers/     
├── public/           
├── views/           
└── README.txt       

-------------------------------------------------------
🛠️ TECH USED

- PHP (vanilla, no framework)
- MySQL (phpMyAdmin)
- PDO for database interaction
- XAMPP for local development

-------------------------------------------------------
🗄️ DATABASE SCHEMA (MySQL)

Given in the file name sql_schema.txt in the storage folder

-------------------------------------------------------
🚀 HOW TO RUN LOCALLY

1. Install XAMPP
2. Create the database in phpMyAdmin: mini_ticket_system
3. Import the SQL tables using the above schema
4. Place your project folder in htdocs (e.g. C:\xampp\htdocs\mini-ticket-system)
5. Open browser and run: http://localhost/mini-ticket-system/public/

-------------------------------------------------------
👨‍💻 Seeder

The seeder files are in public/seed_data.php

-------------------------------------------------------

