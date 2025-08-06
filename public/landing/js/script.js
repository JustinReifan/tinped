function toggleMobileMenu() {
    const mobileMenu = document.getElementById("mobile-menu");
    const menuIcon = document.getElementById("menu-icon");
    const closeIcon = document.getElementById("close-icon");

    if (mobileMenu.classList.contains("tw-opacity-0")) {
        // Open menu
        mobileMenu.classList.remove(
            "tw-opacity-0",
            "tw-max-h-0",
            "tw-invisible"
        );
        mobileMenu.classList.add("tw-opacity-100", "tw-max-h-[500px]");
        menuIcon.classList.add("tw-hidden");
        closeIcon.classList.remove("tw-hidden");
        closeIcon.classList.add("tw-block");
    } else {
        // Close menu
        mobileMenu.classList.remove("tw-opacity-100", "tw-max-h-[500px]");
        mobileMenu.classList.add("tw-opacity-0", "tw-max-h-0", "tw-invisible");
        menuIcon.classList.remove("tw-hidden");
        menuIcon.classList.add("tw-block");
        closeIcon.classList.add("tw-hidden");
    }
}

// Toggle sitemap submenu on mobile
function toggleSitemapMenu() {
    const submenu = document.getElementById("sitemap-submenu");
    if (submenu.classList.contains("tw-hidden")) {
        submenu.classList.remove("tw-hidden");
    } else {
        submenu.classList.add("tw-hidden");
    }
}

function toggleBreadcrumbMenu() {
    const breadcrumbLinks = document.getElementById("breadcrumb-links");
    if (breadcrumbLinks.classList.contains("tw-hidden")) {
        breadcrumbLinks.classList.remove("tw-hidden");
        breadcrumbLinks.classList.add("tw-flex", "tw-flex-col");
    } else {
        breadcrumbLinks.classList.add("tw-hidden");
        breadcrumbLinks.classList.remove("tw-flex", "tw-flex-col");
    }
}

// Navbar scroll effect
window.addEventListener("scroll", function () {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > 20) {
        navbar.classList.add(
            "tw-bg-white/80",
            "tw-backdrop-blur-lg",
            "tw-shadow-md"
        );
    } else {
        navbar.classList.remove(
            "tw-bg-white/80",
            "tw-backdrop-blur-lg",
            "tw-shadow-md"
        );
    }
});

// Initialize any tooltips or other functionality when the DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Add any initialization code here if needed
    console.log("Tinped SMM Landing Page Loaded");
});
