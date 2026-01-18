# Resume Builder – Fullstack Website

A professional single-page resume website built as a Bachelor 2 admission project. This fullstack application allows users to view and manage their digital resume through a clean, responsive interface.

## Description

This project is a complete resume management system that enables users to create, view, and edit their professional resume online. The application features a modern, responsive design with separate view and edit modes, making it easy to showcase and update professional information.

## Features

- **Single-Page Resume Layout** – Clean, professional design displaying all resume sections
- **Four Core Sections** – Profile, Experience, Education, and Skills
- **View Mode** – Read-only display of the complete resume
- **Edit Mode** – Full CRUD operations for all resume sections
- **Responsive Design** – Optimized for mobile, tablet, and desktop devices
- **Dockerized Environment** – Easy deployment with Docker and Docker Compose
- **MySQL Database** – Persistent data storage with pre-seeded sample data

## Technologies Used

| Category | Technology |
|----------|------------|
| Frontend | HTML5, CSS3, JavaScript |
| Backend | PHP 8.2 |
| Database | MySQL 8.0 |
| Web Server | Apache 2.4 |
| Containerization | Docker, Docker Compose |

## Project Structure

```
php-resume/
├── docker/
│   ├── Dockerfile           # PHP Apache web server configuration
│   └── init.sql             # Database schema and seed data
├── includes/
│   └── db.php               # PDO database connection and helper functions
├── public/
│   ├── index.php            # Entry point (redirects to view page)
│   ├── view.php             # View mode (read-only resume display)
│   ├── edit.php             # Edit mode (CRUD operations)
│   ├── style.css            # Responsive CSS styles
│   └── script.js            # JavaScript for interactions
├── docker-compose.yml       # Docker services configuration
└── README.md                # Project documentation
```

## Installation & Run Instructions

### Prerequisites

- Docker Desktop installed and running
- Docker Compose (included with Docker Desktop)

### Steps

1. **Clone or navigate to the project directory**

   ```bash
   cd php-resume
   ```

2. **Build and start the containers**

   ```bash
   docker compose up --build
   ```

   Or run in detached mode (background):

   ```bash
   docker compose up --build -d
   ```

3. **Wait for initialization**

   The first startup may take 30-60 seconds while MySQL initializes and seed data is inserted.

4. **Access the application**

   Open your browser and navigate to:

   ```
   http://localhost:8080
   ```

### Stopping the Application

```bash
# Stop containers (preserves data)
docker compose down

# Stop and remove all data
docker compose down -v
```

## Access URLs

| URL | Description |
|-----|-------------|
| `http://localhost:8080` | Homepage (redirects to view mode) |
| `http://localhost:8080/view.php?user_id=1` | View Mode – Read-only resume display |
| `http://localhost:8080/edit.php?user_id=1` | Edit Mode – Add, update, delete entries |

## Database Schema

| Table | Description |
|-------|-------------|
| `users` | User accounts |
| `profiles` | Name, email, phone, summary |
| `experiences` | Job title, organization, dates, description |
| `educations` | Degree, institution, dates |
| `skills` | Skill name, proficiency level |

## Author

**Maria Sofia David**  
Bachelor 2 Admission Project  
Fullstack Web Development
