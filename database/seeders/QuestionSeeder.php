<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $answers = [
            [
            'content' => 'La complexité temporelle moyenne d\'un algorithme de tri par insertion est O(n^2) dans le pire des cas. Ce type de tri est plus performant que le tri rapide lorsque le tableau est presque trié ou contient un petit nombre d\'éléments.',
            'question_id' => 1,
            'author_id' => 2,
            'created_date' => now(),
            'validated' => false,
            ],
            [
            'content' => 'Le protocole TCP/IP garantit la fiabilité de la transmission des données en utilisant des numéros de séquence et des accusés de réception pour s\'assurer que les paquets sont reçus dans le bon ordre et sans erreur. Chaque couche du modèle OSI joue un rôle spécifique dans la fiabilité des données, de la segmentation des données à la vérification de l\'intégrité des paquets.',
            'question_id' => 1,
            'author_id' => 1,
            'created_date' => now(),
            'validated' => false,
            ],
        ];

        $questions = [
            [
                'title' => 'Quelle est la complexité temporelle moyenne d\'un algorithme de tri par insertion?',
                'content' => 'Dans quel cas ce type de tri est-il plus performant que le tri rapide?',
                'author_id' => 1,
                'module_id' => 1,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Comment le protocole TCP/IP garantit-il la fiabilité de la transmission des données?',
                'content' => 'Expliquer le rôle de chaque couche dans la fiabilité des données.',
                'author_id' => 2,
                'module_id' => 1,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Avantages et inconvénients des microservices',
                'content' => 'Quels sont les avantages des microservices par rapport à une architecture monolithique?',
                'author_id' => 3,
                'module_id' => 1,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Conservation de l\'énergie dans les systèmes à vapeur',
                'content' => 'Comment le principe de conservation de l\'énergie est-il appliqué dans les systèmes à vapeur modernes?',
                'author_id' => 1,
                'module_id' => 2,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Rôle des alliages dans les matériaux',
                'content' => 'Comment les alliages améliorent-ils les propriétés mécaniques des matériaux en termes de résistance?',
                'author_id' => 2,
                'module_id' => 2,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Loi de Bernoulli et systèmes de ventilation',
                'content' => 'Expliquez comment la loi de Bernoulli est utilisée dans la conception de systèmes de ventilation.',
                'author_id' => 3,
                'module_id' => 2,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Systèmes de freinage hydraulique',
                'content' => 'Pourquoi les systèmes de freinage hydraulique sont-ils préférés dans les véhicules modernes?',
                'author_id' => 1,
                'module_id' => 2,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Simulation numérique en ingénierie mécanique',
                'content' => 'En quoi la simulation numérique aide-t-elle à optimiser la conception des structures?',
                'author_id' => 2,
                'module_id' => 2,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Structures de données et bases de données',
                'content' => 'Quel est le rôle des listes chaînées et des arbres binaires dans la gestion des grandes bases de données?',
                'author_id' => 3,
                'module_id' => 1,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Algorithmes de traitement d\'images en temps réel',
                'content' => 'Quels sont les algorithmes les plus adaptés pour le traitement d\'images en temps réel et pourquoi?',
                'author_id' => 1,
                'module_id' => 1,
                'created_date' => now(),
                'resolved' => false,
            ],
        ];

        DB::table('questions')->insert($questions);
        DB::table('answers')->insert($answers);
    }
}
