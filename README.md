# Restaurant Management & Food Ordering System

A comprehensive web-based application designed to manage restaurant operations and online food ordering. This project demonstrates a solid understanding of database relations, user authentication, and CRUD operations.

## 🌟 Key Features

**For Customers:**
* **Browse Menu:** Users can view a variety of meals with images, descriptions, and prices.
* **Shopping Cart & Orders:** Users can add meals to their cart and place orders.
* **Order Tracking:** Users can see the status of their orders.

**For Administrators (Admin Dashboard):**
* **Menu Management:** Admins can add, edit, or remove meals from the menu.
* **Order Management:** Track and update order statuses (Pending, Preparing, Delivered, Cancelled).
* **Employee Management:** A dedicated system to manage restaurant staff, positions (Chef, Cashier, Manager, etc.), and salaries.
* **User Roles:** Secure login system differentiating between regular customers and administrators.

## 🛠️ Technologies Used
* **Backend:** PHP
* **Database:** MySQL (Relational Database Design)
* **Frontend:** HTML, CSS

## 📊 Database Structure (Highlight)
The project includes a well-structured relational database with the following main tables:
* `Users`: Handles authentication and roles (Admin/User).
* `Meals`: Stores menu items with details and soft-delete features.
* `Orders` & `Order_Items`: Manages customer carts and tracks total prices and statuses.
* `Employees`: Manages staff information and payroll.
