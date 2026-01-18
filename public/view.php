<?php
require_once '../includes/db.php';

$userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 1;
$data = getResumeData($pdo, $userId);
$profile = $data['profile'];

if (!$profile) {
    die("Resume not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($profile['full_name']) ?> - Resume</title>
    <meta name="description" content="Resume of <?= htmlspecialchars($profile['full_name']) ?>">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar" data-testid="nav-main">
        <div class="nav-container">
            <span class="nav-brand" data-testid="text-nav-brand"><?= htmlspecialchars($profile['full_name']) ?></span>
            <ul class="nav-menu" data-testid="nav-menu">
                <li><a href="#profile" data-testid="link-nav-profile">Profile</a></li>
                <li><a href="#experience" data-testid="link-nav-experience">Experience</a></li>
                <li><a href="#education" data-testid="link-nav-education">Education</a></li>
                <li><a href="#skills" data-testid="link-nav-skills">Skills</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <section id="profile" class="section profile-section" data-testid="section-profile">
            <div class="profile-header">
                <div class="profile-photo" data-testid="img-profile-photo">
                    <span class="photo-initials"><?= htmlspecialchars(substr($profile['full_name'], 0, 2)) ?></span>
                </div>
                <div class="profile-info">
                    <h1 class="profile-name" data-testid="text-profile-name"><?= htmlspecialchars($profile['full_name']) ?></h1>
                    <div class="profile-contact">
                        <a href="mailto:<?= htmlspecialchars($profile['email']) ?>" class="contact-item" data-testid="link-email">
                            <?= htmlspecialchars($profile['email']) ?>
                        </a>
                        <?php if (!empty($profile['phone'])): ?>
                        <a href="tel:<?= htmlspecialchars($profile['phone']) ?>" class="contact-item" data-testid="link-phone">
                            <?= htmlspecialchars($profile['phone']) ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <p class="profile-summary" data-testid="text-profile-summary"><?= htmlspecialchars($profile['summary']) ?></p>
        </section>

        <section id="experience" class="section" data-testid="section-experience">
            <div class="section-header" onclick="toggleSection('experience')" data-testid="button-toggle-experience">
                <h2>Experience</h2>
                <button type="button" class="toggle-btn" aria-label="Toggle section">
                    <span class="toggle-icon" id="experience-icon">-</span>
                </button>
            </div>
            <div class="section-content" id="experience-content">
                <?php if (empty($data['experiences'])): ?>
                <p class="empty-message">No experience entries.</p>
                <?php else: ?>
                <div class="timeline">
                    <?php foreach ($data['experiences'] as $exp): ?>
                    <div class="timeline-item" data-testid="item-experience-<?= $exp['id'] ?>">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h3 class="item-title"><?= htmlspecialchars($exp['job_title']) ?></h3>
                            <p class="item-org"><?= htmlspecialchars($exp['organization']) ?></p>
                            <p class="item-date"><?= htmlspecialchars($exp['start_date']) ?> - <?= htmlspecialchars($exp['end_date']) ?></p>
                            <?php if (!empty($exp['description'])): ?>
                            <p class="item-desc"><?= htmlspecialchars($exp['description']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <section id="education" class="section" data-testid="section-education">
            <div class="section-header" onclick="toggleSection('education')" data-testid="button-toggle-education">
                <h2>Education</h2>
                <button type="button" class="toggle-btn" aria-label="Toggle section">
                    <span class="toggle-icon" id="education-icon">-</span>
                </button>
            </div>
            <div class="section-content" id="education-content">
                <?php if (empty($data['educations'])): ?>
                <p class="empty-message">No education entries.</p>
                <?php else: ?>
                <div class="timeline">
                    <?php foreach ($data['educations'] as $edu): ?>
                    <div class="timeline-item" data-testid="item-education-<?= $edu['id'] ?>">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h3 class="item-title"><?= htmlspecialchars($edu['degree']) ?></h3>
                            <p class="item-org"><?= htmlspecialchars($edu['institution']) ?></p>
                            <p class="item-date"><?= htmlspecialchars($edu['start_date']) ?> - <?= htmlspecialchars($edu['end_date']) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <section id="skills" class="section" data-testid="section-skills">
            <div class="section-header" onclick="toggleSection('skills')" data-testid="button-toggle-skills">
                <h2>Skills</h2>
                <button type="button" class="toggle-btn" aria-label="Toggle section">
                    <span class="toggle-icon" id="skills-icon">-</span>
                </button>
            </div>
            <div class="section-content" id="skills-content">
                <?php if (empty($data['skills'])): ?>
                <p class="empty-message">No skills listed.</p>
                <?php else: ?>
                <div class="skills-grid">
                    <?php foreach ($data['skills'] as $skill): ?>
                    <div class="skill-item" data-testid="item-skill-<?= $skill['id'] ?>">
                        <span class="skill-name"><?= htmlspecialchars($skill['skill_name']) ?></span>
                        <span class="skill-level"><?= htmlspecialchars($skill['level']) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="footer" data-testid="footer">
        <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($profile['full_name']) ?></p>
    </footer>

    <script>
    function toggleSection(sectionId) {
        var content = document.getElementById(sectionId + '-content');
        var icon = document.getElementById(sectionId + '-icon');
        if (content.classList.contains('collapsed')) {
            content.classList.remove('collapsed');
            icon.textContent = '-';
        } else {
            content.classList.add('collapsed');
            icon.textContent = '+';
        }
    }
    </script>
</body>
</html>
