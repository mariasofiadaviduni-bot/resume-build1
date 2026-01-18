<?php
$host = getenv('DB_HOST') ?: 'db';
$dbname = getenv('DB_NAME') ?: 'resume_db';
$username = getenv('DB_USER') ?: 'resume_user';
$password = getenv('DB_PASS') ?: 'resume_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function getResumeData($pdo, $userId) {
    $data = [
        'profile' => null,
        'experiences' => [],
        'skills' => [],
        'educations' => []
    ];
    
    // Get profile
    $stmt = $pdo->prepare("SELECT * FROM profiles WHERE user_id = ?");
    $stmt->execute([$userId]);
    $data['profile'] = $stmt->fetch();
    
    // Get experiences
    $stmt = $pdo->prepare("SELECT * FROM experiences WHERE user_id = ? ORDER BY id DESC");
    $stmt->execute([$userId]);
    $data['experiences'] = $stmt->fetchAll();
    
    // Get skills
    $stmt = $pdo->prepare("SELECT * FROM skills WHERE user_id = ? ORDER BY FIELD(level, 'Expert', 'Proficient', 'Beginner'), skill_name");
    $stmt->execute([$userId]);
    $data['skills'] = $stmt->fetchAll();
    
    // Get education
    $stmt = $pdo->prepare("SELECT * FROM educations WHERE user_id = ? ORDER BY id DESC");
    $stmt->execute([$userId]);
    $data['educations'] = $stmt->fetchAll();
    
    return $data;
}
?>
