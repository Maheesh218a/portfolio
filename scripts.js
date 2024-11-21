// Highlight the current page in the navbar
document.addEventListener("DOMContentLoaded", () => {
    const currentPath = window.location.pathname;
    const links = document.querySelectorAll(".nav-link");

    links.forEach(link => {
        if (currentPath.includes(link.getAttribute("href"))) {
            link.classList.add("active");
        }
    });
});

// Smooth Scroll for Projects Button
document.querySelector('.project-button').addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector('#projects');
    target.scrollIntoView({ behavior: 'smooth' });
});

// Add smooth animation to scroll (Optional if needed for navigation)
document.querySelectorAll('.social-icon').forEach(icon => {
    icon.addEventListener('mouseenter', () => {
        icon.style.transform = 'scale(1.2)';
    });
    icon.addEventListener('mouseleave', () => {
        icon.style.transform = 'scale(1)';
    });
});

// Add animation on hover
document.querySelectorAll('.service-card').forEach((card) => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-10px)';
        card.style.transition = 'transform 0.3s ease';
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0)';
    });
});

