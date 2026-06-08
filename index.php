<?php 
include 'includes/db_connect.php'; 

// Fetch About Me details
$about_me = [
    'photo_path' => 'images/elham.png',
    'strong_name' => 'Elham Abdillahi',
    'title' => 'Software Developer',
    'bio_text' => "Hello! I'm Elham Abdillahi, a passionate and detail-oriented Software Developer and a Computer Science student. I love working on full-stack development, database design, and learning modern toolchains to solve real-world problems. I'm currently advancing my skills in PHP, Java, and JavaScript. Outside of code, I enjoy leading student tech initiatives as an Innovation Club Coordinator, reading, and participating in global open-source developer communities."
];
if ($conn) {
    $res = @$conn->query("SELECT * FROM about_me LIMIT 1");
    if ($res && $res->num_rows > 0) {
        $about_me = $res->fetch_assoc();
    }
}

// Fetch Skills
$skills = [];
if ($conn) {
    $res = @$conn->query("SELECT * FROM skills ORDER BY id ASC");
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $skills[] = $row;
        }
    }
}
if (empty($skills)) {
    $skills = [
        ['name' => 'PHP', 'icon' => '🐘', 'category' => 'backend'],
        ['name' => 'MySQL / SQL', 'icon' => '💾', 'category' => 'backend'],
        ['name' => 'Java', 'icon' => '☕', 'category' => 'languages'],
        ['name' => 'JavaScript', 'icon' => '🌐', 'category' => 'languages'],
        ['name' => 'HTML & CSS', 'icon' => '🎨', 'category' => 'frontend'],
        ['name' => 'MS Excel', 'icon' => '📊', 'category' => 'frontend']
    ];
}

// Fetch Projects
$projects = [];
if ($conn) {
    $res = @$conn->query("SELECT * FROM projects ORDER BY id ASC");
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $projects[] = $row;
        }
    }
}
if (empty($projects)) {
    $projects = [
        ['title' => 'spftrack', 'description' => 'A web application built using HTML, CSS, SQL and PHP to display learning management systems and track academic indicators.', 'image_path' => 'images/spftrack', 'link_url' => '#'],
        ['title' => 'My Personal Portfolio', 'description' => 'A premium professional developer portfolio built with semantic HTML5, glassmorphic CSS3, AJAX, PHP, and MySQL backend dashboard features.', 'image_path' => 'images/portfolio.png', 'link_url' => 'index.php']
    ];
}

// Fetch Education
$education = [];
if ($conn) {
    $res = @$conn->query("SELECT * FROM education ORDER BY id DESC");
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $education[] = $row;
        }
    }
}
if (empty($education)) {
    $education = [
        ['degree' => 'Bachelor of Science in Computer Science', 'institution' => 'International University of East Africa', 'period' => '2023 – Present', 'description' => 'Studying algorithms, data structures, software engineering methodologies, databases, and core application architectures.']
    ];
}

// Fetch Experience
$experience = [];
if ($conn) {
    $res = @$conn->query("SELECT * FROM experience ORDER BY id DESC");
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $experience[] = $row;
        }
    }
}
if (empty($experience)) {
    $experience = [
        ['role' => 'Innovation Club Coordinator', 'organization' => 'International University of East Africa', 'period' => 'Mar 2026 – Present', 'description' => 'Directing technical workshops, driving hackathons, and fostering innovation among student tech groups.'],
        ['role' => 'Web Application Development Intern', 'organization' => 'Razor Tech Company', 'period' => 'Nov 2025 – Jan 2026', 'description' => 'Assisted in building custom client-facing interfaces, responsive mockups, and writing PHP server scripts.'],
        ['role' => 'Database Design and Management Intern', 'organization' => 'Razor Tech Company', 'period' => 'Sep 2025 – Nov 2025', 'description' => 'Modeled relational schemas, wrote database migrations, optimized query index performance, and analyzed database transactions.']
    ];
}

// Fetch Courses
$courses = [];
if ($conn) {
    $res = @$conn->query("SELECT * FROM courses ORDER BY id DESC");
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $courses[] = $row;
        }
    }
}
if (empty($courses)) {
    $courses = [
        ['title' => 'SQL and Relational Databases 101', 'provider' => 'Cognitive Class', 'period' => '2025', 'description' => 'Acquired strong proficiency in standard SQL operations, structural database concepts, and query optimizations with real-world data.', 'image_path' => 'images/c1.png'],
        ['title' => 'Introduction to MS Excel', 'provider' => 'Microsoft', 'period' => '2025', 'description' => 'Applied advanced spreadsheet calculation modeling, macro operations, data analytics, and reporting structures.', 'image_path' => 'images/c2.png'],
        ['title' => 'Introduction to Java', 'provider' => 'Sololearn', 'period' => '2025', 'description' => 'Mastered core programming fundamentals, object-oriented concepts, logic constructs, and error handling in Java.', 'image_path' => 'images/c3.png']
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="<?php echo htmlspecialchars($about_me['photo_path']); ?>" type="image/png">
    <title><?php echo htmlspecialchars($about_me['strong_name']); ?> - <?php echo htmlspecialchars($about_me['title']); ?></title>
</head>

<body>
<header>
    <div class="logo">DevElham</div>

    <nav>
        <div class="navbar" id="navbar">
            <a href="#Home" class="nav-link active">Home</a>
            <a href="#about" class="nav-link">About Me</a>
            <a href="#skills" class="nav-link">Skills</a>
            <a href="#projects" class="nav-link">Projects</a>
            <a href="#education" class="nav-link">Education</a>
            <a href="#experince" class="nav-link">Experience</a>
            <a href="#courses" class="nav-link">Courses</a>
            <a href="#contact" class="nav-link">Contact</a>
        </div>
    </nav>
</header>

<section id="Home" class="Home">
    <img src="<?php echo htmlspecialchars($about_me['photo_path']); ?>" alt="<?php echo htmlspecialchars($about_me['strong_name']); ?>">
    <h1><?php echo htmlspecialchars($about_me['strong_name']); ?></h1>
    <h2>I'm a <?php echo htmlspecialchars($about_me['title']); ?></h2>
    <p>Motivated and ambitious Computer Science student with a strong foundation in software development. Quick learner with excellent problem-solving and teamwork skills.</p>
    <a href="files/Elham_Abdillahi_CV.pdf" download class="download-btn">Download Resume</a>
</section>

<section id="about" class="about">
    <h1>About Me</h1>
    <div class="about-content">
        <img src="<?php echo htmlspecialchars($about_me['photo_path']); ?>" alt="My photo" />
        <div class="bio">
            <p><?php echo nl2br(htmlspecialchars($about_me['bio_text'])); ?></p>
        </div>
    </div>
</section>

<section id="skills" class="skills">
    <h1>Skills & Tools</h1>
    <div class="skills-container">
        <div class="skills-filter">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="languages">Languages</button>
            <button class="filter-btn" data-filter="backend">Backend / Databases</button>
            <button class="filter-btn" data-filter="frontend">Frontend / Design</button>
        </div>
        <div class="skills-grid">
            <?php foreach ($skills as $skill): ?>
                <div class="skill-card" data-category="<?php echo htmlspecialchars($skill['category']); ?>">
                    <div class="skill-icon"><?php echo htmlspecialchars($skill['icon']); ?></div>
                    <h3><?php echo htmlspecialchars($skill['name']); ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="projects" class="projects">
    <h1>Projects</h1>
    <div class="project-grid">
        <?php foreach ($projects as $project): ?>
            <div class="project-card">
                <img src="<?php echo htmlspecialchars($project['image_path']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                <div class="project-info">
                    <h2><?php echo htmlspecialchars($project['title']); ?></h2>
                    <p><?php echo htmlspecialchars($project['description']); ?></p>
                    <a href="<?php echo htmlspecialchars($project['link_url']); ?>" class="project-link">View Project</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="education" class="education">
    <h1>Education</h1>
    <div class="education-timeline">
        <?php foreach ($education as $edu): ?>
            <div class="education-card">
                <h2><?php echo htmlspecialchars($edu['degree']); ?></h2>
                <p><strong><?php echo htmlspecialchars($edu['institution']); ?></strong></p>
                <p><?php echo htmlspecialchars($edu['period']); ?></p>
                <p><?php echo htmlspecialchars($edu['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="experince" class="experince">
    <h1>Experience</h1>
    <div class="experince-timeline">
        <?php foreach ($experience as $exp): ?>
            <div class="experince-card">
                <h2><?php echo htmlspecialchars($exp['role']); ?></h2>
                <p><strong><?php echo htmlspecialchars($exp['organization']); ?></strong></p>
                <p><?php echo htmlspecialchars($exp['period']); ?></p>
                <p><?php echo htmlspecialchars($exp['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="courses" class="courses">
    <h1>Courses</h1>
    <div class="courses-timeline">
        <?php foreach ($courses as $course): ?>
            <div class="courses-card">
                <img src="<?php echo htmlspecialchars($course['image_path']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>" />
                <div class="courses-info">
                    <h2><?php echo htmlspecialchars($course['title']); ?></h2>
                    <p><strong><?php echo htmlspecialchars($course['provider']); ?></strong> • <?php echo htmlspecialchars($course['period']); ?></p>
                    <p><?php echo htmlspecialchars($course['description']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="contact" class="contact">
    <h1>Contact Me</h1>
    <p class="contact-intro">I'd love to hear from you! Feel free to reach out using the form below or via email/social channels.</p>
    
    <form class="contact-form" id="contactForm" action="submit_contact.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
        <button type="submit" id="submitBtn">Send Message</button>
    </form>
    
    <div class="contact-info">
        <p><strong>Email:</strong> <a href="mailto:elhaamoha20@gmail.com">elhaamoha20@gmail.com</a></p>
        <p><strong>LinkedIn:</strong> <a href="https://linkedin.com/in/elham-abdillahi" target="_blank">linkedin.com/in/elham-abdillahi</a></p>
    </div>
</section>

<footer>
    <p>© 2026 Elham Mohammed Abdillahi. All rights reserved.</p>
</footer>

<a href="#Home" class="back-to-top" id="backToTop">▲</a>
<div class="toast" id="toast"></div>

<script>
// Skills Filtering System
const filterButtons = document.querySelectorAll('.filter-btn');
const skillCards = document.querySelectorAll('.skill-card');

filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        filterButtons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        const filterValue = btn.getAttribute('data-filter');
        
        skillCards.forEach(card => {
            if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                card.style.display = 'flex';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, 50);
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Toast notification helper
const showToast = (message, type = 'success') => {
    const toast = document.getElementById('toast');
    toast.innerText = message;
    toast.className = `toast show ${type}`;
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, 4000);
};

// AJAX Form Handler
const contactForm = document.getElementById('contactForm');
const submitBtn = document.getElementById('submitBtn');

if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(contactForm);
        submitBtn.innerText = 'Sending...';
        submitBtn.disabled = true;
        
        fetch('submit_contact.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.status === 'success') {
                    showToast(data.message, 'success');
                    contactForm.reset();
                } else {
                    showToast(data.message, 'error');
                }
            } catch (e) {
                console.error("Malformed server response:", text);
                showToast('Server returned a malformed response. Please check database status.', 'error');
            }
        })
        .catch(err => {
            console.error("Fetch error:", err);
            showToast('Unable to connect to server. Please try again.', 'error');
        })
        .finally(() => {
            submitBtn.innerText = 'Send Message';
            submitBtn.disabled = false;
        });
    });
}

// Back to Top button visibility on scroll
const backToTopBtn = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
    if (window.scrollY > 400) {
        backToTopBtn.classList.add('visible');
    } else {
        backToTopBtn.classList.remove('visible');
    }
    
    // Highlight Active section in Navbar on scroll
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');
    
    let currentSectionId = 'Home';
    sections.forEach(sec => {
        const top = window.scrollY;
        const offset = sec.offsetTop - 120;
        const height = sec.offsetHeight;
        const id = sec.getAttribute('id');
        
        if (top >= offset && top < offset + height) {
            currentSectionId = id;
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${currentSectionId}`) {
            link.classList.add('active');
        }
    });
});
</script>
</body>
</html>
