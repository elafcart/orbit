<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Les paramètres ont été enregistrés avec succès !',
        'email' => [
            'title' => 'Demandes de devis',
            'description' => 'Modèles d\'e-mail pour les demandes de devis',
            'templates' => [
                'notice_title' => 'Envoyer une notification à l\'administrateur',
                'notice_description' => 'Envoyer une notification à l\'administrateur lorsqu\'une demande de devis est envoyée',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Catégories de services',
        'create' => 'Créer une catégorie de service',
    ],
    'service' => [
        'name' => 'Services',
        'create' => 'Créer un service',
    ],
    'package' => [
        'name' => 'Forfaits',
        'create' => 'Créer un forfait',
    ],
    'project' => [
        'name' => 'Projets',
        'create' => 'Créer un projet',
        'author' => 'Auteur',
        'client' => 'Client',
        'place' => 'Lieu',
        'start_date' => 'Date de début',
        'metrics' => [
            'title' => 'Métriques du projet (cartes d\'étude de cas)',
            'helper' => 'Jusqu\'à trois paires valeur/étiquette de métrique affichées dans les mises en page de cartes d\'étude de cas. Laissez une paire vide pour la masquer.',
            'value_n' => 'Valeur de la métrique :n',
            'label_n' => 'Étiquette de la métrique :n',
            'label_placeholder' => 'p. ex. Efficacité de planification',
        ],
    ],
    'quotation_request' => [
        'name' => 'Demandes de devis',
        'viewing' => 'Consultation de la demande de devis #:name',
        'information' => 'Informations',
    ],
    'custom_field' => [
        'name' => 'Champs personnalisés',
        'create' => 'Créer',
        'type' => 'Type',
        'options' => 'Options',
        'placeholder' => 'Texte indicatif',
        'placeholder_placeholder' => 'Entrer le texte indicatif',
        'required' => 'Requis',
        'option' => [
            'label' => 'Libellé',
            'value' => 'Valeur',
            'add_row' => 'Ajouter une nouvelle ligne',
            'add_from_global' => 'Ajouter un champ personnalisé global',
        ],
        'modal' => [
            'heading' => 'Ajouter un nouveau champ personnalisé',
            'select_field' => 'Sélectionner un champ',
            'button' => 'Ajouter',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Texte',
                'number' => 'Nombre',
                'dropdown' => 'Liste déroulante',
                'checkbox' => 'Case à cocher',
                'textarea' => 'Zone de texte',
            ],
        ],
        'ask_for_select' => 'Veuillez sélectionner un champ personnalisé',
        'add_a_new_custom_field' => 'Ajouter un nouveau champ personnalisé',
    ],
    'image' => 'Image',
    'category' => 'Catégorie',
    'duration' => 'Durée',
    'price' => 'Prix',
    'annual_price' => 'Prix annuel',
    'form' => [
        'none' => 'Aucun',
        'images' => 'Images',
        'name_placeholder' => 'Entrer le nom',
        'is_featured' => 'En vedette ?',
        'price_placeholder' => 'Entrer le prix',
        'features' => 'Caractéristiques',
        'features_help_block' => 'Séparer par une nouvelle ligne (+ est inclus, - n\'est pas inclus)',
        'features_placeholder' => 'Exemple :
+ Livraison mondiale en 15 jours
+ Emballage bulle gratuit
- Support 24/7
        ',
        'description_placeholder' => 'Entrer la description',
        'packages_switch_pricing_plan' => 'Entrer le prix annuel pour activer la fonction de changement de plan tarifaire',
        'action_url' => 'URL d\'action',
        'action_label' => 'Libellé d\'action',
    ],
    'is_popular' => 'Populaire ?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Horaire',
            'daily' => 'Quotidien',
            'weekly' => 'Hebdomadaire',
            'monthly' => 'Mensuel',
            'annually' => 'Annuel',
            'quarterly' => 'Trimestriel',
            'one_time' => 'Une fois',
        ],
        'quote_statuses' => [
            'read' => 'Lu',
            'unread' => 'Non lu',
        ],
    ],
    'edit_this_service' => 'Modifier ce service',
    'edit_this_service_category' => 'Modifier cette catégorie de service',
    'edit_this_project' => 'Modifier ce projet',
    'edit_this_project_category' => 'Modifier cette catégorie de projet',
    'edit_this_package' => 'Modifier ce forfait',
    'message' => 'Message',
    'time' => 'Heure',
    'service_categories' => 'Catégories de services',
    'services' => 'Services',
    'projects' => 'Projets',
    'packages' => 'Forfaits',
];