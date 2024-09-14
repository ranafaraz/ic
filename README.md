# IC - Multi-Branching Education ERP System

## Overview

IC is a SaaS-based Institute Management System designed to manage and automate the daily tasks of educational institutions such as schools, colleges, academies, and universities. It is specifically built to handle multiple branches, allowing a SuperAdmin to control all branches and staff, while each branch is independently managed by its own Admin. This ensures that information about different branches cannot be viewed or modified by other branch users, keeping all data separate and secure. The system is effective for both polytechnics and universities, featuring a language translation system that allows users to switch languages and sessions seamlessly.

## Features

- **Student Management**
  - Enroll students, maintain student records, track attendance, and manage grades.
  - Handle student promotions, transfers, and health records.
  - Emergency contact management.

- **Staff Management**
  - Manage staff records, track attendance, and handle payroll.
  - Assign classes and duties, manage leaves and performance evaluations.

- **Course Management**
  - Create and manage courses, schedules, and classrooms.
  - Assign teachers to courses, manage class timetables, and track syllabus coverage.

- **Fee Management**
  - Automate fee collection, track payments, and generate invoices.
  - Manage scholarships, discounts, and late fee penalties.
  - Provide online payment options.

- **Examination Management**
  - Schedule exams, manage question banks, and generate report cards.
  - Conduct online exams and assessments, analyze results.

- **Communication Tools**
  - Send notifications and messages to students, parents, and staff.
  - Manage email and SMS templates, centralized announcements.

- **Library Management**
  - Manage book inventories, issue/return books, track due dates.
  - Handle fines for late returns, manage reservations, and provide an online catalog.

- **Transport Management**
  - Manage transport routes, assign vehicles, track attendance.
  - Monitor vehicle maintenance, driver details, and provide GPS tracking.

- **Reports and Analytics**
  - Generate various reports and analytics for decision-making.
  - Track attendance, academic performance, financial records.
  - Custom report generation and data export options.

- **Security**
  - Cross-Site Request Forgery (CSRF) Prevention
  - Cross-Site Scripting (XSS) Prevention
  - Password Hashing
  - Avoiding SQL Injection

- **System Requirements**
  - Supports PHP 7.3 to 8.1
  - MySQL 5.x
  - mod_rewrite Apache
  - MySQLi PHP Extension
  - PDO PHP Extension
  - cURL PHP Extension
  - OpenSSL PHP Extension
  - MBString PHP Extension
  - GD PHP Extension
  - Zip PHP Extension
  - allow_url_fopen enabled

## Installation

To set up the IC system on your local machine, follow these steps:

1. **Clone the repository:**
    ```bash
    git clone https://github.com/ranafaraz/ic.git
    cd ic
    ```

2. **Install dependencies:**
    ```bash
    composer install
    npm install
    ```

3. **Setup environment variables:**
    - Copy the `.env.example` file to `.env`:
        ```bash
        cp .env.example .env
        ```
    - Update the `.env` file with your database and other configuration settings.

4. **Generate application key:**
    ```bash
    php artisan key:generate
    ```

5. **Run migrations:**
    ```bash
    php artisan migrate
    ```

6. **Seed the database:**
    ```bash
    php artisan db:seed
    ```

7. **Run the application:**
    ```bash
    php artisan serve
    ```

8. **Access the application:**
    - Open your web browser and navigate to `http://localhost:8000`

## Docker Setup

To set up the IC system using Docker, follow these steps:

1. **Clone the repository:**
    ```bash
    git clone https://github.com/ranafaraz/ic.git
    cd ic
    ```

2. **Copy the example environment file:**
    ```bash
    cp .env.example .env
    ```

3. **Build and run the Docker containers:**
    ```bash
    docker-compose up --build
    ```

4. **Run migrations and seed the database:**
    ```bash
    docker-compose exec app php artisan migrate
    docker-compose exec app php artisan db:seed
    ```

5. **Access the application:**
    - Open your web browser and navigate to `http://localhost:8000`
  
## Steps to Deploy the Docker Images
1. Login to Docker Hub (if needed):
If you haven't logged in already, log into Docker Hub:
```bash
docker login
```
Enter your Docker Hub credentials.

2. Pull the Images from Docker Hub:
On the target machine where you want to deploy the application, run the following commands to pull all the images:
```bash
docker pull ranafarazahmed/ic:ic-app-tagname
docker pull ranafarazahmed/ic:mysql-tagname
docker pull ranafarazahmed/ic:phpmyadmin-tagname
```
Replace ic-app-tagname, mysql-tagname, and phpmyadmin-tagname with the actual tag names you used when pushing the images.

3. Create a docker-compose.yml for Deployment:

You can now create a new docker-compose.yml file to run the pulled images as containers.

Example docker-compose.yml:
```yaml
version: '3.8'

services:
  ic-app:
    image: ranafarazahmed/ic:ic-app-tagname
    ports:
      - "2027:80"
    depends_on:
      - mysql

  mysql:
    image: ranafarazahmed/ic:mysql-tagname
    environment:
      MYSQL_ROOT_PASSWORD: root_password
      MYSQL_DATABASE: ic_db
      MYSQL_USER: testcase
      MYSQL_PASSWORD: testcase
    ports:
      - "3307:3306"

  phpmyadmin:
    image: ranafarazahmed/ic:phpmyadmin-tagname
    environment:
      PMA_HOST: mysql
      MYSQL_ROOT_PASSWORD: root_password
    ports:
      - "8081:80"

networks:
  default:
    driver: bridge
```

4. Start the Containers:
Once the docker-compose.yml file is ready, you can start the application using:
```bash
docker-compose up -d
```
This command will start the containers in detached mode (in the background). The application should now be running with your previously pushed images.

5. Verify the Deployment:
- The application should be accessible on http://<server_ip>:2027.
- phpMyAdmin should be accessible on http://<server_ip>:8081.
- MySQL will be running on port 3307 and can be accessed internally by the ic-app service.

## Usage

- **Admin Panel**: Access the admin panel to manage all aspects of the institution.
  - URL: `http://localhost:8000/admin`
  - Default credentials:
    - Email: `admin@example.com`
    - Password: `password`

- **Student Portal**: Students can access their profiles, view grades, and manage their schedules.
  - URL: `http://localhost:8000/student`

- **Staff Portal**: Staff can manage their schedules, track attendance, and handle student interactions.
  - URL: `http://localhost:8000/staff`

## Contributing

We welcome contributions from the community. To contribute, please follow these steps:

1. **Fork the repository:**
    - Click the "Fork" button at the top-right corner of this repository.

2. **Create a branch:**
    ```bash
    git checkout -b feature/your-feature-name
    ```

3. **Commit your changes:**
    ```bash
    git commit -m 'Add some feature'
    ```

4. **Push to the branch:**
    ```bash
    git push origin feature/your-feature-name
    ```

5. **Create a Pull Request:**
    - Open a Pull Request from your forked repository's branch to the `develop` branch of this repository.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For any queries or support, please contact us at `dexterousdevelopers@gmail.com`.
