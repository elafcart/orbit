<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Le impostazioni sono state salvate con successo!',
        'email' => [
            'title' => 'Richieste di preventivo',
            'description' => 'Modelli di email per le richieste di preventivo',
            'templates' => [
                'notice_title' => 'Invia notifica all\'amministratore',
                'notice_description' => 'Invia notifica all\'amministratore quando viene inviata una richiesta di preventivo',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Categorie di servizi',
        'create' => 'Crea categoria di servizio',
    ],
    'service' => [
        'name' => 'Servizi',
        'create' => 'Crea servizio',
    ],
    'package' => [
        'name' => 'Pacchetti',
        'create' => 'Crea pacchetto',
    ],
    'project' => [
        'name' => 'Progetti',
        'create' => 'Crea progetto',
        'author' => 'Autore',
        'client' => 'Cliente',
        'place' => 'Luogo',
        'start_date' => 'Data di inizio',
        'metrics' => [
            'title' => 'Metriche del progetto (schede dei case study)',
            'helper' => 'Fino a tre coppie di valore/etichetta della metrica visualizzate nei layout delle schede dei case study. Lascia vuota qualsiasi coppia per nasconderla.',
            'value_n' => 'Valore della metrica :n',
            'label_n' => 'Etichetta della metrica :n',
            'label_placeholder' => 'es. Efficienza di pianificazione',
        ],
    ],
    'quotation_request' => [
        'name' => 'Richieste di preventivo',
        'viewing' => 'Visualizzazione richiesta di preventivo #:name',
        'information' => 'Informazioni',
    ],
    'custom_field' => [
        'name' => 'Campi personalizzati',
        'create' => 'Crea',
        'type' => 'Tipo',
        'options' => 'Opzioni',
        'placeholder' => 'Testo segnaposto',
        'placeholder_placeholder' => 'Inserisci il testo segnaposto',
        'required' => 'Obbligatorio',
        'option' => [
            'label' => 'Etichetta',
            'value' => 'Valore',
            'add_row' => 'Aggiungi nuova riga',
            'add_from_global' => 'Aggiungi campo personalizzato globale',
        ],
        'modal' => [
            'heading' => 'Aggiungi nuovo campo personalizzato',
            'select_field' => 'Seleziona campo',
            'button' => 'Aggiungi nuovo',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Testo',
                'number' => 'Numero',
                'dropdown' => 'Menu a tendina',
                'checkbox' => 'Casella di controllo',
                'textarea' => 'Area di testo',
            ],
        ],
        'ask_for_select' => 'Si prega di selezionare un campo personalizzato',
        'add_a_new_custom_field' => 'Aggiungi un nuovo campo personalizzato',
    ],
    'image' => 'Immagine',
    'category' => 'Categoria',
    'duration' => 'Durata',
    'price' => 'Prezzo',
    'annual_price' => 'Prezzo annuale',
    'form' => [
        'none' => 'Nessuno',
        'images' => 'Immagini',
        'name_placeholder' => 'Inserisci il nome',
        'is_featured' => 'In evidenza?',
        'price_placeholder' => 'Inserisci il prezzo',
        'features' => 'Caratteristiche',
        'features_help_block' => 'Separa con nuova riga (+ è incluso, - non è incluso)',
        'features_placeholder' => 'Esempio:
+ Spedizione mondiale in 15 giorni
+ Imballaggio con bolle gratuito
- Supporto 24/7
        ',
        'description_placeholder' => 'Inserisci la descrizione',
        'packages_switch_pricing_plan' => 'Inserisci il prezzo annuale per attivare la funzione di cambio piano tariffario',
        'action_url' => 'URL azione',
        'action_label' => 'Etichetta azione',
    ],
    'is_popular' => 'È popolare?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Orario',
            'daily' => 'Giornaliero',
            'weekly' => 'Settimanale',
            'monthly' => 'Mensile',
            'annually' => 'Annuale',
            'quarterly' => 'Trimestrale',
            'one_time' => 'Una tantum',
        ],
        'quote_statuses' => [
            'read' => 'Letto',
            'unread' => 'Non letto',
        ],
    ],
    'edit_this_service' => 'Modifica questo servizio',
    'edit_this_service_category' => 'Modifica questa categoria di servizio',
    'edit_this_project' => 'Modifica questo progetto',
    'edit_this_project_category' => 'Modifica questa categoria di progetto',
    'edit_this_package' => 'Modifica questo pacchetto',
    'message' => 'Messaggio',
    'time' => 'Tempo',
    'service_categories' => 'Categorie di servizi',
    'services' => 'Servizi',
    'projects' => 'Progetti',
    'packages' => 'Pacchetti',
];