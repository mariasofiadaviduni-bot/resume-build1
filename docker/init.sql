-- Create database if not exists
CREATE DATABASE IF NOT EXISTS resume_db;
USE resume_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Profile table
CREATE TABLE IF NOT EXISTS profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    summary TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Experiences table
CREATE TABLE IF NOT EXISTS experiences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    job_title VARCHAR(255) NOT NULL,
    organization VARCHAR(255) NOT NULL,
    start_date VARCHAR(100),
    end_date VARCHAR(100),
    description TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Skills table
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    skill_name VARCHAR(255) NOT NULL,
    level ENUM('Beginner', 'Proficient', 'Expert') DEFAULT 'Proficient',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Education table
CREATE TABLE IF NOT EXISTS educations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    institution VARCHAR(255) NOT NULL,
    degree VARCHAR(255),
    start_date VARCHAR(100),
    end_date VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert default user
INSERT INTO users (id) VALUES (1);

-- Insert profile for Maria Sofia David
INSERT INTO profiles (user_id, full_name, email, phone, summary) VALUES
(1, 'Maria Sofia David', 'maria.sofia.david@example.com', '+856 20 1234 5678', 'Passionate Fullstack student with strong interest in web development, UI/UX design, and programming. Eager to learn and create innovative digital solutions. Currently studying at Lycée Français International de Vientiane, Laos.');

-- Insert experiences
INSERT INTO experiences (user_id, job_title, organization, start_date, end_date, description) VALUES
(1, 'Web Development Intern', 'Tech Solutions Laos', 'Jun 2023', 'Aug 2023', 'Developed responsive web pages using HTML, CSS, and JavaScript. Collaborated with the design team to implement UI mockups.'),
(1, 'Youth Ambassador', 'UNFPA Environmental Change', 'Jan 2023', 'Present', 'Advocated for environmental awareness and sustainable development practices in the local community.'),
(1, 'Coding Club President', 'Lycée Français International', 'Sep 2022', 'Jun 2023', 'Led weekly coding sessions, organized hackathons, and mentored junior students in programming fundamentals.');

-- Insert skills
INSERT INTO skills (user_id, skill_name, level) VALUES
(1, 'HTML/CSS', 'Expert'),
(1, 'JavaScript', 'Proficient'),
(1, 'Python', 'Proficient'),
(1, 'PHP', 'Proficient'),
(1, 'MySQL', 'Proficient'),
(1, 'React', 'Beginner'),
(1, 'Figma', 'Expert'),
(1, 'Git/GitHub', 'Proficient');

-- Insert education
INSERT INTO educations (user_id, institution, degree, start_date, end_date) VALUES
(1, 'Lycée Français International de Vientiane', 'High School Diploma (Baccalauréat)', '2019', '2023'),
(1, 'Coursera - Google', 'UX Design Professional Certificate', '2022', '2023'),
(1, 'freeCodeCamp', 'Responsive Web Design Certification', '2022', '2022'),
(1, 'Harvard CS50', 'Introduction to Computer Science', '2023', '2023');
