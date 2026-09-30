document.addEventListener("DOMContentLoaded", () => {
    // Clear any previously saved dark theme preference
    localStorage.removeItem("gmet-theme");
    document.body.classList.remove("dark");

    const nav = document.querySelector(".site-nav");
    const onScroll = () =>
        nav && nav.classList.toggle("scrolled", window.scrollY > 20);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });

    const els = document.querySelectorAll(".reveal");
    const io = new IntersectionObserver(
        (es) =>
            es.forEach((e) => {
                if (e.isIntersecting) {
                    e.target.classList.add("show");
                    io.unobserve(e.target);
                }
            }),
        { threshold: 0.12 },
    );
    els.forEach((e) => io.observe(e));

    // Auto-close mobile nav when a link is clicked
    document.querySelectorAll(".navbar-collapse .nav-link, .navbar-collapse .dropdown-item").forEach((a) =>
        a.addEventListener("click", () => {
            const c = document.querySelector(".navbar-collapse");
            if (c && c.classList.contains("show")) {
                const b = document.querySelector(".navbar-toggler");
                if (b) b.click();
            }
        }),
    );
});

/* THIS WEBSITE IS MADE BY MUHAMMAD ALI */