<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Asetukset on tallennettu onnistuneesti!',
        'email' => [
            'title' => 'Tarjouspyynnöt',
            'description' => 'Sähköpostimallit tarjouspyyntöjä varten',
            'templates' => [
                'notice_title' => 'Lähetä ilmoitus ylläpitäjälle',
                'notice_description' => 'Lähetä ilmoitus ylläpitäjälle, kun tarjouspyyntö lähetetään',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Palveluluokat',
        'create' => 'Luo palveluluokka',
    ],
    'service' => [
        'name' => 'Palvelut',
        'create' => 'Luo palvelu',
    ],
    'package' => [
        'name' => 'Paketit',
        'create' => 'Luo paketti',
    ],
    'project' => [
        'name' => 'Projektit',
        'create' => 'Luo projekti',
        'author' => 'Tekijä',
        'client' => 'Asiakas',
        'place' => 'Paikka',
        'start_date' => 'Aloituspäivä',
        'metrics' => [
            'title' => 'Projektin mittarit (tapaustutkimuskortit)',
            'helper' => 'Enintään kolme mittariarvon/-tunnisteen paria, jotka näytetään tapaustutkimuskorttien asetteluissa. Jätä mikä tahansa pari tyhjäksi piilottaaksesi sen.',
            'value_n' => 'Mittari :n arvo',
            'label_n' => 'Mittari :n tunniste',
            'label_placeholder' => 'esim. Suunnittelun tehokkuus',
        ],
    ],
    'quotation_request' => [
        'name' => 'Tarjouspyynnöt',
        'viewing' => 'Tarkastellaan tarjouspyyntöä #:name',
        'information' => 'Tiedot',
    ],
    'custom_field' => [
        'name' => 'Mukautetut kentät',
        'create' => 'Luo',
        'type' => 'Tyyppi',
        'options' => 'Vaihtoehdot',
        'placeholder' => 'Paikanpitäjä',
        'placeholder_placeholder' => 'Syötä paikanpitäjä',
        'required' => 'Pakollinen',
        'option' => [
            'label' => 'Nimike',
            'value' => 'Arvo',
            'add_row' => 'Lisää uusi rivi',
            'add_from_global' => 'Lisää globaali mukautettu kenttä',
        ],
        'modal' => [
            'heading' => 'Lisää uusi mukautettu kenttä',
            'select_field' => 'Valitse kenttä',
            'button' => 'Lisää uusi',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Teksti',
                'number' => 'Numero',
                'dropdown' => 'Pudotusvalikko',
                'checkbox' => 'Valintaruutu',
                'textarea' => 'Tekstialue',
            ],
        ],
        'ask_for_select' => 'Ole hyvä ja valitse mukautettu kenttä',
        'add_a_new_custom_field' => 'Lisää uusi mukautettu kenttä',
    ],
    'image' => 'Kuva',
    'category' => 'Luokka',
    'duration' => 'Kesto',
    'price' => 'Hinta',
    'annual_price' => 'Vuosihinta',
    'form' => [
        'none' => 'Ei mitään',
        'images' => 'Kuvat',
        'name_placeholder' => 'Syötä nimi',
        'is_featured' => 'Suositeltu?',
        'price_placeholder' => 'Syötä hinta',
        'features' => 'Ominaisuudet',
        'features_help_block' => 'Erota uudella rivillä (+ sisältyy, - ei sisälly)',
        'features_placeholder' => 'Esimerkki:
+ 15 päivän toimitus maailmanlaajuisesti
+ Ilmainen kuplapakkaus
- 24/7 Tuki
        ',
        'description_placeholder' => 'Syötä kuvaus',
        'packages_switch_pricing_plan' => 'Syötä vuosihinta hinnoittelusuunnitelman vaihtoominaisuuden käyttöön',
        'action_url' => 'Toiminnon URL',
        'action_label' => 'Toiminnon nimike',
    ],
    'is_popular' => 'Suosittu?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Tunneittain',
            'daily' => 'Päivittäin',
            'weekly' => 'Viikoittain',
            'monthly' => 'Kuukausittain',
            'annually' => 'Vuosittain',
            'quarterly' => 'Neljännesvuosittain',
            'one_time' => 'Kertamaksu',
        ],
        'quote_statuses' => [
            'read' => 'Luettu',
            'unread' => 'Lukematon',
        ],
    ],
    'edit_this_service' => 'Muokkaa tätä palvelua',
    'edit_this_service_category' => 'Muokkaa tätä palveluluokkaa',
    'edit_this_project' => 'Muokkaa tätä projektia',
    'edit_this_project_category' => 'Muokkaa tätä projektiluokkaa',
    'edit_this_package' => 'Muokkaa tätä pakettia',
    'message' => 'Viesti',
    'time' => 'Aika',
    'service_categories' => 'Palveluluokat',
    'services' => 'Palvelut',
    'projects' => 'Projektit',
    'packages' => 'Paketit',
];
