# To-Do List Application

This is a simple To-Do List application built with Laravel 9 and Bootstrap. The application allows users to add, complete, view, and delete tasks dynamically without refreshing the page, using AJAX and SweetAlert for enhanced user experience.

## Features

- **Add Tasks**: Users can add new tasks by entering the task title and clicking the "Add Task" button. The task appears in the list without a page reload.
- **Complete Tasks**: Users can mark tasks as completed by clicking the checkbox next to each task. Completed tasks will be removed from the list.
- **Show All Tasks**: Users can view all tasks, including completed and non-completed ones, by clicking the "Show All Tasks" button.
- **Delete Tasks**: Users can delete tasks by clicking the "Delete" button. A confirmation dialog will appear before the task is permanently deleted.
- **Duplicate Task Prevention**: Duplicate tasks are not allowed.

## Requirements

- PHP version 8.0 or higher
- Composer
- Laravel 9.x
- Node.js and npm (for running npm scripts)
- XAMPP, WAMP, or any local server environment

## Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/todo-list-app.git
    cd todo-list-app
    ```

2. **Install dependencies:**
    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Set up the environment:**
    - Copy `.env.example` to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Generate an application key:
      ```bash
      php artisan key:generate
      ```
    - Configure your `.env` file with your database credentials.

4. **Run the migrations and seed the database:**
    ```bash
    php artisan migrate --seed
    ```

5. **Serve the application:**
    ```bash
    php artisan serve
    ```
    The application will be accessible at `http://localhost:8000`.

## Usage

### Adding a Task
- Enter the task title in the input field and click the "Add Task" button.
- The task will appear in the list below without refreshing the page.

### Marking a Task as Completed
- Click the checkbox next to the task.
- The task will be marked as completed and removed from the list.

### Viewing All Tasks
- Click the "Show All Tasks" button to display all tasks, including those that have been completed.

### Deleting a Task
- Click the "Delete" button next to the task.
- A confirmation dialog will appear. If you confirm, the task will be deleted.

## Code Structure

- **Controllers**:
  - `ToDoController`: Handles the CRUD operations for tasks.

- **Models**:
  - `Todo`: The Eloquent model representing the task.

- **Views**:
  - `resources/views/todo/index.blade.php`: The main view template for the To-Do list.

- **JavaScript**:
  - Custom scripts are included in the Blade template to handle AJAX operations and integrate SweetAlert for alerts and confirmations.

## Technologies Used

- **Laravel 9**: A PHP framework for building modern web applications.
- **Bootstrap 5**: A CSS framework for styling the application.
- **SweetAlert2**: A library for creating beautiful alerts and confirmations.
- **AJAX**: Used for asynchronous operations without page reload.

## Screenshots

(Include screenshots of the application if possible)

## License

This project is open-source and available under the [MIT License](LICENSE).

## Contributing

If you would like to contribute to this project, please fork the repository and submit a pull request. We welcome all contributions!

## Contact

If you have any questions or need further assistance, feel free to reach out to the project maintainer at your.email@example.com.
