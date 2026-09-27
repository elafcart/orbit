<?php

return [
    'name' => 'Portfólio',
    'settings' => [
        'success_message' => 'As configurações foram salvas com sucesso!',
        'email' => [
            'title' => 'Solicitações de orçamento',
            'description' => 'Modelos de e-mail para solicitações de orçamento',
            'templates' => [
                'notice_title' => 'Enviar notificação ao administrador',
                'notice_description' => 'Enviar notificação ao administrador quando uma solicitação de orçamento for enviada',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Categorias de serviços',
        'create' => 'Criar categoria de serviço',
    ],
    'service' => [
        'name' => 'Serviços',
        'create' => 'Criar serviço',
    ],
    'package' => [
        'name' => 'Pacotes',
        'create' => 'Criar pacote',
    ],
    'project' => [
        'name' => 'Projetos',
        'create' => 'Criar projeto',
        'author' => 'Autor',
        'client' => 'Cliente',
        'place' => 'Local',
        'start_date' => 'Data de início',
        'metrics' => [
            'title' => 'Métricas do projeto (cartões de estudo de caso)',
            'helper' => 'Até três pares de valor/rótulo de métrica exibidos nos layouts de cartões de estudo de caso. Deixe qualquer par vazio para ocultá-lo.',
            'value_n' => 'Valor da métrica :n',
            'label_n' => 'Rótulo da métrica :n',
            'label_placeholder' => 'ex. Eficiência de planeamento',
        ],
    ],
    'quotation_request' => [
        'name' => 'Solicitações de orçamento',
        'viewing' => 'Visualizando solicitação de orçamento #:name',
        'information' => 'Informações',
    ],
    'custom_field' => [
        'name' => 'Campos personalizados',
        'create' => 'Criar',
        'type' => 'Tipo',
        'options' => 'Opções',
        'placeholder' => 'Texto de exemplo',
        'placeholder_placeholder' => 'Digite o texto de exemplo',
        'required' => 'Obrigatório',
        'option' => [
            'label' => 'Rótulo',
            'value' => 'Valor',
            'add_row' => 'Adicionar nova linha',
            'add_from_global' => 'Adicionar campo personalizado global',
        ],
        'modal' => [
            'heading' => 'Adicionar novo campo personalizado',
            'select_field' => 'Selecionar campo',
            'button' => 'Adicionar novo',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Texto',
                'number' => 'Número',
                'dropdown' => 'Lista suspensa',
                'checkbox' => 'Caixa de seleção',
                'textarea' => 'Área de texto',
            ],
        ],
        'ask_for_select' => 'Por favor, selecione um campo personalizado',
        'add_a_new_custom_field' => 'Adicionar novo campo personalizado',
    ],
    'image' => 'Imagem',
    'category' => 'Categoria',
    'duration' => 'Duração',
    'price' => 'Preço',
    'annual_price' => 'Preço anual',
    'form' => [
        'none' => 'Nenhum',
        'images' => 'Imagens',
        'name_placeholder' => 'Digite o nome',
        'is_featured' => 'Em destaque?',
        'price_placeholder' => 'Digite o preço',
        'features' => 'Recursos',
        'features_help_block' => 'Separe por nova linha (+ está incluído, - não está incluído)',
        'features_placeholder' => 'Exemplo:
+ Entrega mundial em 15 dias
+ Embalagem com bolhas grátis
- Suporte 24/7
        ',
        'description_placeholder' => 'Digite a descrição',
        'packages_switch_pricing_plan' => 'Digite o preço anual para ativar o recurso de mudança de plano de preços',
        'action_url' => 'URL de ação',
        'action_label' => 'Rótulo de ação',
    ],
    'is_popular' => 'É popular?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Por hora',
            'daily' => 'Diário',
            'weekly' => 'Semanal',
            'monthly' => 'Mensal',
            'annually' => 'Anual',
            'quarterly' => 'Trimestral',
            'one_time' => 'Única vez',
        ],
        'quote_statuses' => [
            'read' => 'Lido',
            'unread' => 'Não lido',
        ],
    ],
    'edit_this_service' => 'Editar este serviço',
    'edit_this_service_category' => 'Editar esta categoria de serviço',
    'edit_this_project' => 'Editar este projeto',
    'edit_this_project_category' => 'Editar esta categoria de projeto',
    'edit_this_package' => 'Editar este pacote',
    'message' => 'Mensagem',
    'time' => 'Tempo',
    'service_categories' => 'Categorias de serviços',
    'services' => 'Serviços',
    'projects' => 'Projetos',
    'packages' => 'Pacotes',
];