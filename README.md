### 2025S_INF653_VA_Back-End Web Development I
### Angel Escalera
### Midterm Project Instructions – PHP and MySQL


# Project Title

Midterm Project Instructions – PHP and MySQL

## Description

Zippy Used Autos - PHP Web Application

This is a PHP web application for Zippy Used Autos, an online platform to browse and manage used vehicle listings. The project follows the MVC (Model-View-Controller) design pattern to ensure separation of concerns and maintainable code structure.
Features

    Public Vehicle Listings: Displays all vehicles, sorted by price (descending) with the ability to filter by make, type, or class.

    Sorting & Filtering: Users can sort the vehicles by price or year, and filter by a single category at a time (make, type, or class).

    Admin Backend: Provides a secured admin area for managing vehicle listings, including adding, deleting, and updating vehicle information.

    CRUD Operations: Admins can add new vehicles, delete existing ones, and manage makes, types, and classes.

    Responsive Design: The application is responsive, ensuring that it works on both desktop and mobile devices.

File Structure

    models/: Contains database interaction logic for vehicles, makes, types, and classes.

    views/: Contains HTML files for rendering pages to the user, including public and admin views.

    controllers/: Handles the business logic, including requests for viewing vehicles, managing makes/types/classes, and deleting vehicles.

    config/: Stores configuration files like the database connection (db.php).

Key Technologies Used

    PHP for server-side scripting.

    MySQL for database management.

    HTML/CSS for frontend layout and styling.

    JavaScript for frontend interactivity (optional, if added).

How It Works

    Public Homepage: Users can view and filter vehicles based on their preferences. Vehicle data is dynamically fetched from the database.

    Admin Backend: Admins can log in to an isolated backend to manage the vehicle inventory and perform CRUD operations on vehicles, makes, types, and classes.

    Database Structure: The database is structured with four tables: vehicles, makes, types, and classes, with foreign keys linking them to ensure data integrity.


### Executing program

* Use the view_vehicles.php address below for viewers
* Step-by-step bullets
```
http://localhost/zippyusedautos/view_vehicles.php?make=&type=&class=
```


## Authors

Contributors names and contact info

ex. Angel Escalera




Inspiration, code snippets, etc.
* [view_vehicles.php](http://localhost/zippyusedautos/view_vehicles.php?make=&type=&class=)
