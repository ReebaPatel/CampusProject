# 🎓 Campus Event Management System  

A simple **PHP + MySQL web application** for managing campus events.  
Users can register, log in, view events, and add new events.  

---

## 🚀 Features
- 📝 **Register** for an account (`register.php`)  
- 🔑 **Login** to user account (`login.php`)  
- 📅 **View all campus events** (`welcome.php`)  
- ➕ **Add new events** (for logged-in users, via `partials/_addEvents.php`)  
- 🚪 **Logout** (`logout.php`)  

---

## ⚙️ How It Works
- **User Authentication** → Registration & login handled via `users` database  
- **Event Management** → Events stored in `events` database  
- **Dashboard** → Logged-in users can view all events and add new ones  
- **Navigation** → Managed by `partials/_nav.php`  

---

## 🛠️ Installation & Setup

### 1️⃣ Set up Environment
- Install [XAMPP](https://www.apachefriends.org/index.html) or any PHP + MySQL local server.  
- Place the project folder (e.g., `CampusProject-main`) in your server’s root directory (`htdocs` for XAMPP).  

### 2️⃣ Create Databases
In MySQL, create two databases:  
- **users**  
  - Table: `users`  
    - `Username`  
    - `Password`  
    - `Date`  

- **events**  
  - Table: `events`  
    - `EName`  
    - `startdate`  
    - `enddate`  
    - `venue`  
    - `coordinatorname`  
    - `coordinatorcontact`  

### 3️⃣ Run the Project
- Start **Apache** and **MySQL** from XAMPP.  
- Open your browser and go to:  

```bash
http://localhost/CampusProject/login.php
