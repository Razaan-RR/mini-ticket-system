🎫 MINI TICKET SYSTEM

This is a beginner-friendly PHP-based support ticketing system built without any framework. It allows agents and admins to manage tickets in a simple and minimal way.

-------------------------------------------------------
🔧 FEATURES

- ✅ User Registration (with role: agent or admin)
- ✅ Simple login system (planned)
- ✅ Agents can:
    - Create support tickets
    - View and update their own tickets
- ✅ Admins can:
    - View all tickets
    - Assign tickets to agents (planned)
- ✅ Role-based access control
- ✅ Secure password hashing using PHP

-------------------------------------------------------
📁 FOLDER STRUCTURE (MVC STYLE)

mini-ticket-system/
│
├── config/           # Database connection
├── models/           # Database interaction (UserModel.php, TicketModel.php)
├── controllers/      # Business logic
├── public/           # Public access (index.php, form handlers)
├── views/            # HTML files (optional)
└── README.txt        # This file

-------------------------------------------------------
🛠️ TECH USED

- PHP (vanilla, no framework)
- MySQL (phpMyAdmin)
- PDO for database interaction
- XAMPP for local development

-------------------------------------------------------
🗄️ DATABASE SCHEMA (MySQL)

Database: mini_ticket_system

Create table users (
    id int auto_increment primary key, 
    name varchar(100), 
    email varchar(100) unique, 
    password_hash text, 
    role enum('admin', 'agent') default 'agent'
);

Create table department( 
    id integer auto_increment primary key, 
    name text 
);

Create table ticket(
    id int auto_increment primary key,
    title varchar(255) not null,
    description text not null,
    status enum('open', 'in_progress', 'closed') default 'open',
    user_id int not null,
    department_id int not null,
    created_at datetime default current_timestamp,
    foreign key (user_id) references users(id),
    foreign key (department_id) references department(id)
);

-------------------------------------------------------
🚀 HOW TO RUN LOCALLY

1. Install XAMPP
2. Create the database in phpMyAdmin: mini_ticket_system
3. Import the SQL tables using the above schema
4. Place your project folder in htdocs (e.g. C:\xampp\htdocs\mini-ticket-system)
5. Open browser and run: http://localhost/mini-ticket-system/public/

-------------------------------------------------------
👨‍💻 AUTHOR

Razaan  
GitHub: https://github.com/Razaan-RR

-------------------------------------------------------

