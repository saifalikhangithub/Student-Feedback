# Student Feedback System
This is a feedback-based platform designed to help prospective students make informed decisions before enrolling in a college course. Existing students can share their experiences and provide feedback on various aspects such as faculty teaching quality, infrastructure, campus environment, and course-specific strengths and weaknesses. This system offers valuable insights into which colleges are best suited for particular courses, helping students choose the right institution for their academic goals.
------------------------------------------------------
This is a simple web-based Student Feedback System developed using PHP and MySQL. It allows students to register, log in, submit feedback for faculty members within their department, and provides a public interface to view submitted feedback.

##Screenshorts


## Features

* **Student Registration:** Students can create an account with their name, email, password, and department.
* **Student Login:** Registered students can log in securely to access their dashboard.
* **Department-wise Faculty Listing:** Logged-in students can view a list of faculty members belonging to their specific department.
* **Feedback Submission:** Students can submit textual feedback for individual faculty members.
* **Password Hashing:** Student passwords are securely hashed using `PASSWORD_BCRYPT` before being stored in the database.
* **View Feedback:** A public page allows anyone to view feedback submitted for faculty, filtered by department.
* **Session Management:** Uses PHP sessions to maintain user authentication and state.

## Technologies Used

* **Backend:** PHP
* **Database:** MySQL
* **Frontend:** HTML, CSS

## Database Schema

The project uses a MySQL database named `student_feedback` with the following tables:

* `students`: Stores student registration details.
    * `id` (Primary Key, Auto-increment)
    * `name` (VARCHAR)
    * `email` (VARCHAR, Unique)
    * `password` (VARCHAR) - Hashed password
    * `department` (VARCHAR)
* `faculty`: Stores details of faculty members.
    * `id` (Primary Key, Auto-increment)
    * `name` (VARCHAR)
    * `department` (VARCHAR)
* `feedback`: Stores student feedback submissions.
    * `id` (Primary Key, Auto-increment)
    * `student_id` (Foreign Key referencing `students.id`)
    * `faculty_id` (Foreign Key referencing `faculty.id`)
    * `feedback` (TEXT)

## Getting Started

Follow these instructions to set up and run the project on your local machine.

### Prerequisites

* A web server with PHP support (e.g., Apache, Nginx)
* MySQL database server
* phpMyAdmin (optional, for easy database management)

### Installation

1.  **Clone the repository:**
    ```bash
    git clone <repository_url>
    cd student-feedback-system
    ```

2.  **Set up the database:**
    * Open your MySQL client or phpMyAdmin.
    * Create a new database named `student_feedback`.
    * Import the `student_feedback.sql` file into this new database. This will create the necessary tables and their relationships.
    * You can also run the following SQL queries to populate the `faculty` table with some initial data (from `faculty data.txt`):
        ```sql
        INSERT INTO faculty (name, department) VALUES
        ('Dr. Anil Kumar', 'BCA'),
         ('Prof. Meera Sharma', 'MBA'),
         ('Dr. Rakesh Singh', 'MCA'),
         ('Prof. Neha Joshi', 'BCA'),
         ('Dr. Amit Verma', 'MBA'),
         ('Prof. Rekha Nair', 'MCA'),
         ('Dr. Sunil Rao', 'BCA'),
         ('Prof. Kavita Iyer', 'MBA'),
         ('Dr. Manoj Desai', 'MCA'),
         ('Prof. Priya Menon', 'BCA');
        ```

3.  **Place project files on your web server:**
    * Copy all the PHP files (`index.php`, `register.php`, `login.php`, `dashboard.php`, `submit_feedback.php`, `view_feedback.php`, `logout.php`) into your web server's document root (e.g., `htdocs` for XAMPP, `www` for WAMP).

4.  **Configure database connection:**
    * Ensure that the database connection details in `login.php`, `dashboard.php`, `register.php`, `submit_feedback.php`, and `view_feedback.php` are correct.
        The current connection string assumes:
        ```php
        $conn = mysqli_connect("localhost", "root", "", "student_feedback");
        ```
        If your MySQL username or password is different, update `"root"` and `""` accordingly.

5.  **Access the application:**
    * Open your web browser and navigate to the URL where you placed the project files (e.g., `http://localhost/student-feedback-system/` or `http://localhost/index.php` depending on your setup).

## Usage

1.  **Register:**
    * On the welcome page (`index.php`), click on "Register" to create a new student account.
    * Fill in your name, email, desired password, and select your department.

2.  **Login:**
    * After successful registration (or directly from the welcome page), click on "Login".
    * Enter your registered email and password.

3.  **Dashboard:**
    * Once logged in, you will be redirected to the dashboard.
    * You will see a list of faculty members in your department.
    * Below each faculty member's name, there will be a text area to submit your feedback.
    * Click "Submit Feedback" after typing your comments.

4.  **View Feedback:**
    * From the welcome page or the dashboard, click on "View Feedback".
    * Select a department from the dropdown menu and click "View Feedback" to see all feedback submitted for that department.

5.  **Logout:**
    * Click the "Logout" button on the dashboard to end your session.

## Contributing

Contributions are welcome! If you'd like to improve this project, please feel free to:

1.  Fork the repository.
2.  Create a new branch (`git checkout -b feature/your-feature-name`).
3.  Make your changes.
4.  Commit your changes (`git commit -m 'Add some feature'`).
5.  Push to the branch (`git push origin feature/your-feature-name`).
6.  Open a Pull Request.

## License

This project is open source and free to use
