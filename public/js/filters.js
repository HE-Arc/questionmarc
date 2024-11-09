document.addEventListener('DOMContentLoaded', function() {
    const filiereSelect = document.getElementById('filiere-select');
    const yearSelect = document.getElementById('year-select');
    const moduleSelect = document.getElementById('module-select');
    const selectedModule = window.appData.selectedModule;

    function loadModules(filiere, year, selectedModule = '') {
        moduleSelect.innerHTML = '<option value="">Tous les modules</option>';

        let url = window.appData.apiModulesUrl;
        let params = new URLSearchParams();
        if (filiere) {
            params.append('filiere', filiere);
        }
        if (year) {
            params.append('year', year);
        }
        if (params.toString()) {
            url += `?${params.toString()}`;
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Aucun module disponible';
                    option.disabled = true;
                    moduleSelect.appendChild(option);
                } else {
                    data.forEach(module => {
                        const option = document.createElement('option');
                        option.value = module.name;
                        option.textContent = module.name;
                        if (module.name === selectedModule) {
                            option.selected = true;
                        }
                        moduleSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
    }

    filiereSelect.addEventListener('change', function() {
        const selectedFiliere = this.value;
        const selectedYear = yearSelect.value;
        loadModules(selectedFiliere, selectedYear);
    });

    yearSelect.addEventListener('change', function() {
        const selectedFiliere = filiereSelect.value;
        const selectedYear = this.value;
        loadModules(selectedFiliere, selectedYear);
    });

    // Charger les modules correspondants si une filière ou une année est déjà sélectionnée
    const initialFiliere = filiereSelect.value;
    const initialYear = yearSelect.value;
    loadModules(initialFiliere, initialYear, selectedModule);
});
