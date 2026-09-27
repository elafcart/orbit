<?php

return [
    'name' => 'Portfólio',
    'settings' => [
        'success_message' => 'As configurações foram salvas com sucesso!',
        'email' => [
            'title' => 'Solicitações de cotação',
            'description' => 'Modelos de e-mail para solicitações de cotação',
            'templates' => [
                'notice_title' => 'Enviar aviso ao administrador',
                'notice_description' => 'Enviar aviso ao administrador quando uma solicitação de cotação for enviada',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Categorias de serviço',
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
            'title' => 'Métricas do projeto (cards de estudo de caso)',
            'helper' => 'Até três pares de valor/rótulo de métrica exibidos nos layouts de cards de estudo de caso. Deixe qualquer par vazio para ocultá-lo.',
            'value_n' => 'Valor da métrica :n',
            'label_n' => 'Rótulo da métrica :n',
            'label_placeholder' => 'ex. Eficiência de planejamento',
        ],
    ],
    'quotation_request' => [
        'name' => 'Solicitações de cotação',
        'viewing' => 'Visualizando solicitação de cotação #:name',
        'information' => 'Informação',
    ],
    'custom_field' => [
        'name' => 'Campos personalizados',
        'create' => 'Criar',
        'type' => 'Tipo',
        'options' => 'Opções',
        'placeholder' => 'Espaço reservado',
        'placeholder_placeholder' => 'Digite o espaço reservado',
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
        'add_a_new_custom_field' => 'Adicionar um novo campo personalizado',
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
+ Envio de 15 dias para o mundo todo
+ Plástico bolha grátis
- Suporte 24/7
        ',
        'description_placeholder' => 'Digite a descrição',
        'packages_switch_pricing_plan' => 'Digite o preço anual para alternar o recurso do plano de preços',
        'action_url' => 'URL da ação',
        'action_label' => 'Rótulo da ação',
    ],
    'is_popular' => 'Popular?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Por hora',
            'daily' => 'Diário',
            'weekly' => 'Semanal',
            'monthly' => 'Mensal',
            'annually' => 'Anual',
            'quarterly' => 'Trimestral',
            'one_time' => 'Uma vez',
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
    'service_categories' => 'Categorias de serviço',
    'services' => 'Serviços',
    'projects' => 'Projetos',
    'packages' => 'Pacotes',
];
