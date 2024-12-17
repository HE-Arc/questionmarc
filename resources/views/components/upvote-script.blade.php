<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.upvote-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                @if (Auth::check())
                    const answerId = this.dataset.answerId;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    fetch(`/answers/${answerId}/upvote`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Mise à jour de l'interface
                                const countElement = document.getElementById(
                                    `upvote-count-${answerId}`);
                                countElement.textContent = data.upvoters_count;

                                // Modifier la classe du bouton selon l'état
                                if (data.upvoted) {
                                    this.classList.remove('text-gray-500',
                                        'hover:text-indigo-600');
                                    this.classList.add('text-indigo-600',
                                        'hover:text-gray-500');
                                } else {
                                    this.classList.remove('text-indigo-600',
                                        'hover:text-gray-500');
                                    this.classList.add('text-gray-500',
                                        'hover:text-indigo-600');
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Erreur lors de l\'upvote :', error);
                        });
                @else
                    window.location.href =
                        "{{ route('login') }}?redirect_to={{ request()->fullUrl() }}";
                @endif
            });
        });
    });
</script>
