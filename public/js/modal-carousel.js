document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('[data-carousel="static"]');
    const modal = document.getElementById('carousel-modal');
    const modalItems = Array.from(modal.querySelectorAll('[data-modal-carousel-item]'));
    const closeModalButton = document.getElementById('close-modal');
    const modalNextButton = document.getElementById('modal-next');
    const modalPrevButton = document.getElementById('modal-prev');
    const openModalButton = carousel.querySelector('[data-carousel-fullscreen]');

    let modalIndex = 0;

    const updateModalSlides = () => {
        modalItems.forEach((item, index) => {
            item.classList.toggle('block', index === modalIndex);
            item.classList.toggle('hidden', index !== modalIndex);
        });
    };

    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modalIndex = 0; // Start with the first slide
        updateModalSlides();
    });

    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    modalNextButton.addEventListener('click', () => {
        modalIndex = (modalIndex + 1) % modalItems.length;
        updateModalSlides();
    });

    modalPrevButton.addEventListener('click', () => {
        modalIndex = (modalIndex - 1 + modalItems.length) % modalItems.length;
        updateModalSlides();
    });

    // Ensure the ESC key closes the modal
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
        }
    });
});
