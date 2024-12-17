@props(['card', 'images'])

<!-- Carousel Component -->
<div id="carousel-{{ $images[0]->id }}" class="relative w-full mt-4" data-carousel="static">
    <!-- Carousel Wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        @foreach ($images as $index => $image)
            <div class="{{ $index === 0 ? 'block' : 'hidden' }} ease-in-out" data-carousel-item>
                <img src="{{ asset('storage/' . $image['path']) }}" alt="Image {{ $index + 1 }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
            </div>
        @endforeach
    </div>
    <!-- Full-Screen Button -->
    <button type="button" class="absolute bottom-5 right-5 z-40 px-4 py-2 text-white rounded-lg"
        data-carousel-fullscreen>
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M3 4C3 3.44772 3.44772 3 4 3H8C8.55228 3 9 3.44772 9 4C9 4.55228 8.55228 5 8 5H6.41421L9.70711 8.29289C10.0976 8.68342 10.0976 9.31658 9.70711 9.70711C9.31658 10.0976 8.68342 10.0976 8.29289 9.70711L5 6.41421V8C5 8.55228 4.55228 9 4 9C3.44772 9 3 8.55228 3 8V4ZM16 3H20C20.5523 3 21 3.44772 21 4V8C21 8.55228 20.5523 9 20 9C19.4477 9 19 8.55228 19 8V6.41421L15.7071 9.70711C15.3166 10.0976 14.6834 10.0976 14.2929 9.70711C13.9024 9.31658 13.9024 8.68342 14.2929 8.29289L17.5858 5H16C15.4477 5 15 4.55228 15 4C15 3.44772 15.4477 3 16 3ZM9.70711 14.2929C10.0976 14.6834 10.0976 15.3166 9.70711 15.7071L6.41421 19H8C8.55228 19 9 19.4477 9 20C9 20.5523 8.55228 21 8 21H4C3.44772 21 3 20.5523 3 20V16C3 15.4477 3.44772 15 4 15C4.55228 15 5 15.4477 5 16V17.5858L8.29289 14.2929C8.68342 13.9024 9.31658 13.9024 9.70711 14.2929ZM14.2929 14.2929C14.6834 13.9024 15.3166 13.9024 15.7071 14.2929L19 17.5858V16C19 15.4477 19.4477 15 20 15C20.5523 15 21 15.4477 21 16V20C21 20.5523 20.5523 21 20 21H16C15.4477 21 15 20.5523 15 20C15 19.4477 15.4477 19 16 19H17.5858L14.2929 15.7071C13.9024 15.3166 13.9024 14.6834 14.2929 14.2929Z"
                    fill="#000000"></path>
            </g>
        </svg>
    </button>
    <!-- Slider Indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
        @foreach ($images as $index => $image)
            <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
        @endforeach
    </div>
    <!-- Slider Controls -->
    <button type="button"
        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 dark:bg-gray-800/30 group-hover:bg-black/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70">
            <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 dark:bg-gray-800/30 group-hover:bg-black/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70">
            <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
<!-- Modal for Full Screen -->
<div id="carousel-modal-{{ $images[0]->id }}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
    <div class="relative w-full h-full">
        <div class="relative w-full h-full overflow-hidden rounded-lg flex items-center justify-center">
            @foreach ($images as $index => $image)
                <div class="{{ $index === 0 ? 'block' : 'hidden' }} ease-in-out" data-modal-carousel-item>
                    <img src="{{ asset('storage/' . $image['path']) }}" alt="Image {{ $index + 1 }}"
                        class="block max-w-full max-h-full object-contain mx-auto">
                </div>
            @endforeach
        </div>
        <button type="button" class="absolute top-4 right-4 text-white text-2xl" id="close-modal-{{ $images[0]->id }}">&times;</button>
        <!-- Slider Controls for Modal -->
        <button type="button"
            class="absolute top-1/2 left-4 z-60 transform -translate-y-1/2 text-white bg-black/50 rounded-full p-2"
            id="modal-prev-{{ $images[0]->id }}">
            &larr;
        </button>
        <button type="button"
            class="absolute top-1/2 right-4 z-60 transform -translate-y-1/2 text-white bg-black/50 rounded-full p-2"
            id="modal-next-{{ $images[0]->id }}">
            &rarr;
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const carousel = document.querySelector('#carousel-{{ $images[0]->id }}');
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
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const carousel = document.querySelector('#carousel-{{ $images[0]->id }}');
        const modal = document.getElementById('carousel-modal-{{ $images[0]->id }}');
        const modalItems = Array.from(modal.querySelectorAll('[data-modal-carousel-item]'));
        const closeModalButton = document.getElementById('close-modal-{{ $images[0]->id }}');
        const modalNextButton = document.getElementById('modal-next-{{ $images[0]->id }}');
        const modalPrevButton = document.getElementById('modal-prev-{{ $images[0]->id }}');
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
</script>
