<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between">
        <!-- Contact Us -->
        <div class="mb-6 md:mb-0">
            <h5 class="text-lg font-semibold mb-2">Contactez-nous</h5>
            <ul>
                <li class="mb-1">
                    <a href="mailto:tom.vivone@he-arc.ch;sebastien.mendes@he-arc.ch;luan.bozier@he-arc.ch" class="hover:underline">
                        Email : Cliquez ici pour nous contacter.
                    </a>
                </li>
            </ul>
        </div>

        <!-- Qui sommes-nous ? -->
        <div class="mb-6 md:mb-0">
            <h5 class="text-lg font-semibold mb-2">Qui sommes-nous ?</h5>
            <ul>
                <li class="mb-1">Sébastien Mendes</li>
                <li class="mb-1">Tom Vivone</li>
                <li class="mb-1">Luan Bozier</li>
            </ul>
        </div>

        <!-- Légal -->
        <div>
            <h5 class="text-lg font-semibold mb-2">Réalisation</h5>
            <p class="font-bold">Hautes Écoles Arc - Informatique Logiciel, 3ème année</p>
            <p>Réalisé dans le cadre du cours d'Application Web. 2024</p>
        </div>
    </div>
    <div class="mt-8 border-t border-gray-700 pt-4 text-center text-sm">
        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.
    </div>
</div>
