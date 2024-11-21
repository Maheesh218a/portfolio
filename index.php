<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Maheesha Udalagama</title>
    <meta name="description" content="Get in touch with Maheesha Udalagama for inquiries, collaborations, or feedback.">
    <meta name="keywords" content="Contact, Maheesha Udalagama, Email, Feedback">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS and Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="resources/icons/icon.webp">
</head>

<body>
    <?php include "navbar.php"; ?>

    <!-- Home Section -->
    <section id="home" class="home-section">
        <div class="container">
            <h1 class="welcome-text">Welcome to Maheesha Udalagama's Portfolio</h1>
            <p class="subtitle-text">Your Trusted Partner for Creative Solutions</p>
            <a href="#projects" class="btn btn-primary project-button">View Projects</a>
        </div>
    </section>

    <!-- About Me Section -->
    <section id="about" class="about-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-4">P R O F I L E</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <p class="about-description">
                        I am a dedicated and enthusiastic software engineering student at the Java Institute with a software engineer degree.
                        Living in Matale, I have honed my skills in Java and other programming languages through academic projects and personal endeavors.
                        I enjoy creating user-friendly and efficient websites, constantly seeking opportunities to apply my knowledge and contribute
                        to innovative software solutions.
                    </p>
                    <div class="personal-details">
                        <h5><strong>FULL NAME</strong></h5>
                        <p>Watte Walawwe Maheesha Nimsith Udalagama</p>

                        <h5><strong>Residence</strong></h5>
                        <p>Matale, Sri Lanka</p>

                        <h5><strong>Degree Program</strong></h5>
                        <p>BSc(Hons) in Software Engineering <br> Graduate at (2026 December)</p>
                    </div>
                    <div class="text-center mt-4">
                        <a href="resources/cv/Maheesha_Udalagama_CV.pdf" class="btn btn-primary download-cv" download>Download My CV</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects-section">
        <div class="container">
            <h2 class="section-title">My Projects</h2>
            <div class="row">
                <?php
                try {
                    // Pagination settings
                    $limit = 6; // Show 6 projects per page (2 rows of 3)
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    // Fetch the total count of projects
                    $countQuery = "SELECT COUNT(*) as total FROM projects";
                    $countResult = Database::search($countQuery);
                    $totalProjects = $countResult->fetch_assoc()['total'];

                    // Fetching paginated project data
                    $query = "SELECT p.id, 
                                 p.project_name, 
                                 p.link, 
                                 p.description, 
                                 pc.category, 
                                 p.img_path AS path 
                          FROM projects p
                          JOIN project_category pc ON p.project_category_id = pc.id
                          LIMIT $limit OFFSET $offset";

                    $result = Database::search($query);

                    // Check if any projects exist
                    if ($result->num_rows > 0) {
                        $counter = 0;
                        while ($row = $result->fetch_assoc()) {
                            echo '
                        <div class="col-md-4 col-sm-6 project-item">
                            <a href="' . $row['link'] . '" target="_blank" class="project-card-link">
                                <div class="project-card">
                                    <div class="card-front">
                                        <img src="' . $row['path'] . '" alt="' . $row['project_name'] . '" class="project-image">
                                        <h3 class="project-title">' . $row['project_name'] . '</h3>
                                    </div>
                                    <div class="card-back">
                                        <h4>' . $row['category'] . '</h4>
                                        <p>' . $row['description'] . '</p>
                                        <div class="social-icons">
                                            <a href="https://wa.me/94767900101" target="_blank" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                                            <a href="https://www.linkedin.com" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                            <a href="' . $row['link'] . '" target="_blank" class="social-icon"><i class="fab fa-github"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>';

                            $counter++;
                            if ($counter % 3 == 0) {
                                // Close and start a new row every 3 items
                                echo '</div><div class="row">';
                            }
                        }
                    } else {
                        echo '<p>No projects found.</p>';
                    }

                    // Calculate total pages
                    $totalPages = ceil($totalProjects / $limit);

                    // Display pagination links
                    if ($totalPages > 1) {
                        echo '<div class="pagination">';
                        for ($i = 1; $i <= $totalPages; $i++) {
                            $active = ($i == $page) ? 'active' : '';
                            echo '<a href="?page=' . $i . '#projects" class="pagination-link ' . $active . '">' . $i . '</a>';
                        }
                        echo '</div>';
                    }
                } catch (Exception $e) {
                    echo '<p>Error loading projects: ' . $e->getMessage() . '</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section py-5">
        <div class="container">
            <h1 class="section-title text-primary text-center mb-5">My Services</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-card text-center p-4 rounded shadow">
                        <i class="fas fa-code fa-3x text-primary mb-3"></i>
                        <h5>Web Development</h5>
                        <p>Custom websites tailored to your needs with responsive design and modern frameworks.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card text-center p-4 rounded shadow">
                        <i class="fas fa-desktop fa-3x text-primary mb-3"></i>
                        <h5>POS System Development</h5>
                        <p>Efficient point-of-sale systems for businesses, built for ease of use and scalability.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card text-center p-4 rounded shadow">
                        <i class="fas fa-tools fa-3x text-primary mb-3"></i>
                        <h5>Error Fixing</h5>
                        <p>Quick and reliable debugging services for your websites, applications, and systems.</p>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="service-card text-center p-4 rounded shadow">
                        <i class="fas fa-book fa-3x text-primary mb-3"></i>
                        <h5>Assignment Help</h5>
                        <p>Professional assistance with academic and technical assignments to ensure success.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card text-center p-4 rounded shadow">
                        <i class="fas fa-file-alt fa-3x text-primary mb-3"></i>
                        <h5>CV Creation</h5>
                        <p>Stand out with expertly crafted resumes tailored to your career goals.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card text-center p-4 rounded shadow">
                        <i class="fas fa-video fa-3x text-primary mb-3"></i>
                        <h5>Video Editing</h5>
                        <p>Professional video editing for events, businesses, and personal projects.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contact" class="contact-form-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-4">Contact Me</h2>
            <p class="text-center text-muted mb-5">Feel free to reach out for inquiries, collaborations, or feedback.</p>
            <div class="form-wrapper">
                <form action="send_contact.php" method="POST" class="p-4 shadow-lg rounded">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Contact Details Section -->
    <section class="contact-details-section py-5">
        <div class="container text-center">
            <h4 class="section-title mb-4">Get in Touch</h4>
            <p class="text-muted">Connect with Maheesha Udalagama on various platforms.</p>
            <div class="social-icons mt-4 d-flex flex-wrap justify-content-center">
                <a href="https://wa.me/94767900101" class="social-icon m-2" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                <a href="https://www.facebook.com/maheeshanimsithudalagama.udalagama/" class="social-icon m-2" target="_blank" title="Facebook"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="https://www.linkedin.com/in/maheesha-udalagama-11958b273/" class="social-icon m-2" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i> LinkedIn</a>
                <a href="https://github.com/Maheesh218a" class="social-icon m-2" target="_blank" title="GitHub"><i class="fab fa-github"></i> GitHub</a>
                <a href="https://www.tiktok.com/@maheesha_nimsith?_t=8rZVAgqPByc&_r=1" class="social-icon m-2" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i> TikTok</a>
                <a href="https://www.instagram.com/maheesha_udalagama/" class="social-icon m-2" target="_blank" title="Instagram"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="https://www.youtube.com/@maheeshaudalagama5717" class="social-icon m-2" target="_blank" title="YouTube"><i class="fab fa-youtube"></i> YouTube</a>
            </div>
            <p class="mt-4">
                <a href="mailto:maheeshaudalagama@gmail.com" class="btn btn-primary">Email Me</a>
            </p>
        </div>
    </section>


    <!-- Google Maps Section -->
    <section class="google-maps-section py-5">
        <div class="container text-center">
            <h4 class="section-title">Visit My Location</h4>
            <iframe class="mt-4 map-iframe"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1577.568863093602!2d80.6275585!3d7.5504709!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMzMnMDcuNyJOIDgwwrAzNSc2OS4yIkU!5e0!3m2!1sen!2slk!4v1696321526573!5m2!1sen!2slk"
                width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </section>

    <?php include "footer.php" ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>