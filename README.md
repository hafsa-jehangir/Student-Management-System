# Student-Management-System
A simple PHP and MySQL-based student management system to add, edit, display and delete student records
This is a basic **Student Management System** web application built with PHP and MySQL. It allows users to add, edit, and delete student records, including uploading and displaying student pictures.

## Features

- Add new student records with details such as name, roll number, email, phone, department, semester, address, gender, date of birth, guardian name, and picture.
- Edit existing student records with the ability to update all fields and change the student's picture.
- Delete student records from the database.
- View all students in a tabular format with their details and pictures.
- Responsive and clean UI with simple CSS styling.

## Technologies Used

- PHP (server-side scripting)
- MySQL (database)
- HTML/CSS (frontend)
- Font Awesome (icons)

## Installation

1. Clone the repository or download the source code.
2. Set up a local or remote server with PHP and MySQL (e.g., XAMPP, WAMP).
3. Create a MySQL database named `student`.
4. Create the `my_std` table manually with appropriate columns for student data including a `picture` field (varchar).
5. Place the project files inside your server's root directory (`htdocs` or `www`).
6. Create a folder named `imgcrud` inside the project directory for storing student images.
7. Access the project via your browser (e.g., `http://localhost/your-project-folder/CRUD.php`).

## Usage

- Use the form on the main page to add new students.
- Click the edit button to update student details.
- Click the delete button to remove a student record.
- Uploaded images will be stored in the `imgcrud` folder.


## Notes

- Make sure to set proper folder permissions to allow file uploads.
- This project is for learning and small-scale usage; it does not implement advanced security features like input validation or prepared statements.

## License

This project is open-source and free to use.
