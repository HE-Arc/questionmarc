document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('[data-carousel="static"]');
    if (carousel) {
        const items = Array.from(carousel.querySelectorAll('[data-carousel-item]'));
        let activeIndex = 0;

        const updateSlides = () => {
            items.forEach((item, index) => {
                item.classList.toggle('block', index === activeIndex);
                item.classList.toggle('hidden', index !== activeIndex);
            });
        };

        const nextButton = carousel.querySelector('[data-carousel-next]');
        const prevButton = carousel.querySelector('[data-carousel-prev]');

        nextButton.addEventListener('click', () => {
            activeIndex = (activeIndex + 1) % items.length;
            updateSlides();
        });

        prevButton.addEventListener('click', () => {
            activeIndex = (activeIndex - 1 + items.length) % items.length;
            updateSlides();
        });

        // Initial setup
        updateSlides();
    }
});
