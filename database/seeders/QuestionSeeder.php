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
        $questions = [
            [
                'title' => 'Quelle est la complexité temporelle moyenne d\'un algorithme de tri par insertion?',
                'content' => 'Dans quel cas ce type de tri est-il plus performant que le tri rapide?',
                'author_id' => 1,
                'module_id' => 100,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Comment le protocole TCP/IP garantit-il la fiabilité de la transmission des données?',
                'content' => 'Expliquer le rôle de chaque couche dans la fiabilité des données.',
                'author_id' => 2,
                'module_id' => 98,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Avantages et inconvénients des microservices',
                'content' => 'Quels sont les avantages des microservices par rapport à une architecture monolithique?',
                'author_id' => 3,
                'module_id' => 226,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Conservation de l\'énergie dans les systèmes à vapeur',
                'content' => 'Comment le principe de conservation de l\'énergie est-il appliqué dans les systèmes à vapeur modernes?',
                'author_id' => 5,
                'module_id' => 55,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Rôle des alliages dans les matériaux',
                'content' => 'Comment les alliages améliorent-ils les propriétés mécaniques des matériaux en termes de résistance?',
                'author_id' => 6,
                'module_id' => 70,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Loi de Bernoulli et systèmes de ventilation',
                'content' => 'Expliquez comment la loi de Bernoulli est utilisée dans la conception de systèmes de ventilation.',
                'author_id' => 6,
                'module_id' => 354,
                'created_date' => now(),
                'resolved' => true,
            ],
            [
                'title' => 'Systèmes de freinage hydraulique',
                'content' => 'Pourquoi les systèmes de freinage hydraulique sont-ils préférés dans les véhicules modernes?',
                'author_id' => 7,
                'module_id' => 70,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Simulation numérique en ingénierie mécanique',
                'content' => 'En quoi la simulation numérique aide-t-elle à optimiser la conception des structures?',
                'author_id' => 4,
                'module_id' => 28,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Structures de données et bases de données',
                'content' => 'Quel est le rôle des listes chaînées et des arbres binaires dans la gestion des grandes bases de données?',
                'author_id' => 3,
                'module_id' => 89,
                'created_date' => now(),
                'resolved' => false,
            ],
            [
                'title' => 'Algorithmes de traitement d\'images en temps réel',
                'content' => 'Quels sont les algorithmes les plus adaptés pour le traitement d\'images en temps réel et pourquoi?',
                'author_id' => 1,
                'module_id' => 254,
                'created_date' => now(),
                'resolved' => false,
            ],
        ];


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
            'question_id' => 2,
            'author_id' => 1,
            'created_date' => now(),
            'validated' => false,
            ],
            [
            'content' => 'La loi de Bernoulli est essentielle pour prédire le comportement de l\'air dans les systèmes de ventilation et pour concevoir des installations efficaces, économes en énergie et confortables pour les occupants',
            'question_id' => 6,
            'author_id' => 7,
            'created_date' => now(),
            'validated' => true,
            ],
            [
                'content' => 'Les systèmes de freinage hydraulique sont préférés dans les véhicules modernes en raison de leur efficacité, de leur fiabilité et de leur capacité à fournir un freinage puissant et uniforme.',
                'question_id' => 7,
                'author_id' => 6,
                'created_date' => now(),
                'validated' => false,
            ],
            [
                'content' => 'Les alliages améliorent les propriétés mécaniques des matériaux, notamment leur résistance, en modifiant leur structure atomique et leurs caractéristiques physiques grâce à l\'ajout d\'éléments métalliques ou non métalliques.?',
                'question_id' => 5,
                'author_id' => 7,
                'created_date' => now(),
                'validated' => false,
            ],
        ];

        $answers_users_upvote = [
            [
                'user_id' => 6,
                'answer_id' => 3,
            ],
        ];

        DB::table('questions')->insert($questions);
        DB::table('answers')->insert($answers);
        DB::table('answers_users_upvote')->insert($answers_users_upvote);
    }
}
