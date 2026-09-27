<?php

return [
    'name' => 'Portfolyo',
    'settings' => [
        'success_message' => 'Ayarlar başarıyla kaydedildi!',
        'email' => [
            'title' => 'Teklif Talepleri',
            'description' => 'Teklif talepleri için e-posta şablonları',
            'templates' => [
                'notice_title' => 'Yöneticiye bildirim gönder',
                'notice_description' => 'Teklif talebi gönderildiğinde yöneticiye bildirim gönder',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Hizmet Kategorileri',
        'create' => 'Hizmet Kategorisi Oluştur',
    ],
    'service' => [
        'name' => 'Hizmetler',
        'create' => 'Hizmet Oluştur',
    ],
    'package' => [
        'name' => 'Paketler',
        'create' => 'Paket Oluştur',
    ],
    'project' => [
        'name' => 'Projeler',
        'create' => 'Proje Oluştur',
        'author' => 'Yazar',
        'client' => 'Müşteri',
        'place' => 'Yer',
        'start_date' => 'Başlangıç Tarihi',
        'metrics' => [
            'title' => 'Proje metrikleri (vaka çalışması kartları)',
            'helper' => 'Vaka çalışması kart düzenlerinde görüntülenen üç adede kadar metrik değer/etiket çifti. Bir çifti gizlemek için boş bırakın.',
            'value_n' => 'Metrik :n değeri',
            'label_n' => 'Metrik :n etiketi',
            'label_placeholder' => 'örn. Planlama Verimliliği',
        ],
    ],
    'quotation_request' => [
        'name' => 'Teklif Talepleri',
        'viewing' => 'Teklif talebi görüntüleniyor #:name',
        'information' => 'Bilgi',
    ],
    'custom_field' => [
        'name' => 'Özel Alanlar',
        'create' => 'Oluştur',
        'type' => 'Tür',
        'options' => 'Seçenekler',
        'placeholder' => 'Yer Tutucu',
        'placeholder_placeholder' => 'Yer tutucu girin',
        'required' => 'Gerekli',
        'option' => [
            'label' => 'Etiket',
            'value' => 'Değer',
            'add_row' => 'Yeni satır ekle',
            'add_from_global' => 'Global özel alan ekle',
        ],
        'modal' => [
            'heading' => 'Yeni özel alan ekle',
            'select_field' => 'Alan seç',
            'button' => 'Yeni ekle',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Metin',
                'number' => 'Sayı',
                'dropdown' => 'Açılır Menü',
                'checkbox' => 'Onay Kutusu',
                'textarea' => 'Metin Alanı',
            ],
        ],
        'ask_for_select' => 'Lütfen bir özel alan seçin',
        'add_a_new_custom_field' => 'Yeni bir özel alan ekle',
    ],
    'image' => 'Resim',
    'category' => 'Kategori',
    'duration' => 'Süre',
    'price' => 'Fiyat',
    'annual_price' => 'Yıllık fiyat',
    'form' => [
        'none' => 'Yok',
        'images' => 'Resimler',
        'name_placeholder' => 'İsim girin',
        'is_featured' => 'Öne çıkan?',
        'price_placeholder' => 'Fiyat girin',
        'features' => 'Özellikler',
        'features_help_block' => 'Yeni satırla ayırın (+ dahil, - dahil değil)',
        'features_placeholder' => 'Örnek:
+ Dünya Çapında 15 Günlük Kargo
+ Ücretsiz Balonlu Naylon
- 24/7 Destek
        ',
        'description_placeholder' => 'Açıklama girin',
        'packages_switch_pricing_plan' => 'Fiyatlandırma planı değiştirme özelliği için yıllık fiyat girin',
        'action_url' => 'İşlem URL\'si',
        'action_label' => 'İşlem Etiketi',
    ],
    'is_popular' => 'Popüler?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Saatlik',
            'daily' => 'Günlük',
            'weekly' => 'Haftalık',
            'monthly' => 'Aylık',
            'annually' => 'Yıllık',
            'quarterly' => 'Üç Aylık',
            'one_time' => 'Tek Seferlik',
        ],
        'quote_statuses' => [
            'read' => 'Okundu',
            'unread' => 'Okunmadı',
        ],
    ],
    'edit_this_service' => 'Bu hizmeti düzenle',
    'edit_this_service_category' => 'Bu hizmet kategorisini düzenle',
    'edit_this_project' => 'Bu projeyi düzenle',
    'edit_this_project_category' => 'Bu proje kategorisini düzenle',
    'edit_this_package' => 'Bu paketi düzenle',
    'message' => 'Mesaj',
    'time' => 'Zaman',
    'service_categories' => 'Hizmet Kategorileri',
    'services' => 'Hizmetler',
    'projects' => 'Projeler',
    'packages' => 'Paketler',
];
