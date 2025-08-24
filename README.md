This project is a Campus Event Management System built with PHP and MySQL. 

It allows users to:
Register for an account (register.php)
Login to their account (login.php)
View all campus events (welcome.php)
Add new events (for logged-in users, via partials/_addEvents.php)
Logout (logout.php)

How it works
User registration and login are handled using the users database.
Events are stored in the events database.
After logging in, users can see all events and add new ones.
Navigation is managed by _nav.php.

How to run the project
Set up your environment:
Install XAMPP or any local server with PHP and MySQL.
Place the project folder (e.g., CampusProject-main) in your server's root directory (htdocs for XAMPP).

Create the databases:
Create two MySQL databases: users and events.
In users, create a table named users with columns: Username, Password, Date.
In events, create a table named events with columns: EName, startdate, enddate, venue, coordinatorname, coordinatorcontact.

Start your server:
Start Apache and MySQL from XAMPP.

Access the project:
Open your browser and go to:
http://localhost/MyProject/CampusProject/login.php
Register a new account, then log in to view and add events.

Note:
You may need to adjust the folder path in the form actions if your project folder name or structure is different.
