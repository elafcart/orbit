<?php

return [
    'name' => 'Portofolio',
    'settings' => [
        'success_message' => 'Pengaturan telah berhasil disimpan!',
        'email' => [
            'title' => 'Permintaan Penawaran',
            'description' => 'Template email untuk permintaan penawaran',
            'templates' => [
                'notice_title' => 'Kirim pemberitahuan ke administrator',
                'notice_description' => 'Kirim pemberitahuan ke administrator saat permintaan penawaran dikirim',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Kategori Layanan',
        'create' => 'Buat Kategori Layanan',
    ],
    'service' => [
        'name' => 'Layanan',
        'create' => 'Buat Layanan',
    ],
    'package' => [
        'name' => 'Paket',
        'create' => 'Buat Paket',
    ],
    'project' => [
        'name' => 'Proyek',
        'create' => 'Buat Proyek',
        'author' => 'Penulis',
        'client' => 'Klien',
        'place' => 'Tempat',
        'start_date' => 'Tanggal Mulai',
        'metrics' => [
            'title' => 'Metrik proyek (kartu studi kasus)',
            'helper' => 'Hingga tiga pasang nilai/label metrik yang ditampilkan pada tata letak kartu studi kasus. Biarkan pasangan kosong untuk menyembunyikannya.',
            'value_n' => 'Nilai metrik :n',
            'label_n' => 'Label metrik :n',
            'label_placeholder' => 'misal: Efisiensi perencanaan',
        ],
    ],
    'quotation_request' => [
        'name' => 'Permintaan Penawaran',
        'viewing' => 'Melihat permintaan penawaran #:name',
        'information' => 'Informasi',
    ],
    'custom_field' => [
        'name' => 'Bidang Kustom',
        'create' => 'Buat',
        'type' => 'Tipe',
        'options' => 'Opsi',
        'placeholder' => 'Placeholder',
        'placeholder_placeholder' => 'Masukkan placeholder',
        'required' => 'Wajib',
        'option' => [
            'label' => 'Label',
            'value' => 'Nilai',
            'add_row' => 'Tambah baris baru',
            'add_from_global' => 'Tambah bidang kustom global',
        ],
        'modal' => [
            'heading' => 'Tambah bidang kustom baru',
            'select_field' => 'Pilih bidang',
            'button' => 'Tambah baru',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Teks',
                'number' => 'Angka',
                'dropdown' => 'Dropdown',
                'checkbox' => 'Kotak centang',
                'textarea' => 'Area teks',
            ],
        ],
        'ask_for_select' => 'Silakan pilih bidang kustom',
        'add_a_new_custom_field' => 'Tambah bidang kustom baru',
    ],
    'image' => 'Gambar',
    'category' => 'Kategori',
    'duration' => 'Durasi',
    'price' => 'Harga',
    'annual_price' => 'Harga tahunan',
    'form' => [
        'none' => 'Tidak ada',
        'images' => 'Gambar',
        'name_placeholder' => 'Masukkan nama',
        'is_featured' => 'Unggulan?',
        'price_placeholder' => 'Masukkan harga',
        'features' => 'Fitur',
        'features_help_block' => 'Pisahkan dengan baris baru (+ termasuk, - tidak termasuk)',
        'features_placeholder' => 'Contoh:
+ Pengiriman 15 hari ke seluruh dunia
+ Bubble wrap gratis
- Dukungan 24/7
        ',
        'description_placeholder' => 'Masukkan deskripsi',
        'packages_switch_pricing_plan' => 'Masukkan harga tahunan untuk mengaktifkan fitur beralih paket harga',
        'action_url' => 'URL Tindakan',
        'action_label' => 'Label Tindakan',
    ],
    'is_popular' => 'Populer?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Per jam',
            'daily' => 'Harian',
            'weekly' => 'Mingguan',
            'monthly' => 'Bulanan',
            'annually' => 'Tahunan',
            'quarterly' => 'Triwulan',
            'one_time' => 'Sekali',
        ],
        'quote_statuses' => [
            'read' => 'Dibaca',
            'unread' => 'Belum dibaca',
        ],
    ],
    'edit_this_service' => 'Edit layanan ini',
    'edit_this_service_category' => 'Edit kategori layanan ini',
    'edit_this_project' => 'Edit proyek ini',
    'edit_this_project_category' => 'Edit kategori proyek ini',
    'edit_this_package' => 'Edit paket ini',
    'message' => 'Pesan',
    'time' => 'Waktu',
    'service_categories' => 'Kategori Layanan',
    'services' => 'Layanan',
    'projects' => 'Proyek',
    'packages' => 'Paket',
];