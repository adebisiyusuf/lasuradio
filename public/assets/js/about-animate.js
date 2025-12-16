document.addEventListener("DOMContentLoaded", function () {
    const animatedElements = document.querySelectorAll(
        ".animate, .animate-left, .animate-right"
    );

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                }
            });
        },
        {
            threshold: 0.15
        }
    );

    animatedElements.forEach((el) => observer.observe(el));
});
