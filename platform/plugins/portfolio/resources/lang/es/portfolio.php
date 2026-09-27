<?php

return [
    'name' => 'Portafolio',
    'settings' => [
        'success_message' => '¡La configuración se ha guardado correctamente!',
        'email' => [
            'title' => 'Solicitudes de presupuesto',
            'description' => 'Plantillas de correo electrónico para solicitudes de presupuesto',
            'templates' => [
                'notice_title' => 'Enviar notificación al administrador',
                'notice_description' => 'Enviar notificación al administrador cuando se envía una solicitud de presupuesto',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Categorías de servicios',
        'create' => 'Crear categoría de servicio',
    ],
    'service' => [
        'name' => 'Servicios',
        'create' => 'Crear servicio',
    ],
    'package' => [
        'name' => 'Paquetes',
        'create' => 'Crear paquete',
    ],
    'project' => [
        'name' => 'Proyectos',
        'create' => 'Crear proyecto',
        'author' => 'Autor',
        'client' => 'Cliente',
        'place' => 'Lugar',
        'start_date' => 'Fecha de inicio',
        'metrics' => [
            'title' => 'Métricas del proyecto (tarjetas de caso de estudio)',
            'helper' => 'Hasta tres pares de valor/etiqueta de métrica mostrados en los diseños de tarjetas de caso de estudio. Deje cualquier par vacío para ocultarlo.',
            'value_n' => 'Valor de la métrica :n',
            'label_n' => 'Etiqueta de la métrica :n',
            'label_placeholder' => 'p. ej., Eficiencia de planificación',
        ],
    ],
    'quotation_request' => [
        'name' => 'Solicitudes de presupuesto',
        'viewing' => 'Viendo solicitud de presupuesto #:name',
        'information' => 'Información',
    ],
    'custom_field' => [
        'name' => 'Campos personalizados',
        'create' => 'Crear',
        'type' => 'Tipo',
        'options' => 'Opciones',
        'placeholder' => 'Marcador de posición',
        'placeholder_placeholder' => 'Ingrese el marcador de posición',
        'required' => 'Requerido',
        'option' => [
            'label' => 'Etiqueta',
            'value' => 'Valor',
            'add_row' => 'Agregar nueva fila',
            'add_from_global' => 'Agregar campo personalizado global',
        ],
        'modal' => [
            'heading' => 'Agregar nuevo campo personalizado',
            'select_field' => 'Seleccionar campo',
            'button' => 'Agregar nuevo',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Texto',
                'number' => 'Número',
                'dropdown' => 'Lista desplegable',
                'checkbox' => 'Casilla de verificación',
                'textarea' => 'Área de texto',
            ],
        ],
        'ask_for_select' => 'Por favor seleccione un campo personalizado',
        'add_a_new_custom_field' => 'Agregar un nuevo campo personalizado',
    ],
    'image' => 'Imagen',
    'category' => 'Categoría',
    'duration' => 'Duración',
    'price' => 'Precio',
    'annual_price' => 'Precio anual',
    'form' => [
        'none' => 'Ninguno',
        'images' => 'Imágenes',
        'name_placeholder' => 'Ingrese el nombre',
        'is_featured' => '¿Es destacado?',
        'price_placeholder' => 'Ingrese el precio',
        'features' => 'Características',
        'features_help_block' => 'Separar por nueva línea (+ está incluido, - no está incluido)',
        'features_placeholder' => 'Ejemplo:
+ Envío mundial en 15 días
+ Embalaje con burbujas gratis
- Soporte 24/7
        ',
        'description_placeholder' => 'Ingrese la descripción',
        'packages_switch_pricing_plan' => 'Ingrese el precio anual para activar la función de cambio de plan de precios',
        'action_url' => 'URL de acción',
        'action_label' => 'Etiqueta de acción',
    ],
    'is_popular' => '¿Es popular?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Por hora',
            'daily' => 'Diario',
            'weekly' => 'Semanal',
            'monthly' => 'Mensual',
            'annually' => 'Anual',
            'quarterly' => 'Trimestral',
            'one_time' => 'Una vez',
        ],
        'quote_statuses' => [
            'read' => 'Leído',
            'unread' => 'No leído',
        ],
    ],
    'edit_this_service' => 'Editar este servicio',
    'edit_this_service_category' => 'Editar esta categoría de servicio',
    'edit_this_project' => 'Editar este proyecto',
    'edit_this_project_category' => 'Editar esta categoría de proyecto',
    'edit_this_package' => 'Editar este paquete',
    'message' => 'Mensaje',
    'time' => 'Hora',
    'service_categories' => 'Categorías de servicios',
    'services' => 'Servicios',
    'projects' => 'Proyectos',
    'packages' => 'Paquetes',
];