<?php

return [
    'name' => 'พอร์ตโฟลิโอ',
    'settings' => [
        'success_message' => 'บันทึกการตั้งค่าเรียบร้อยแล้ว!',
        'email' => [
            'title' => 'คำขอใบเสนอราคา',
            'description' => 'แบบฟอร์มอีเมลสำหรับคำขอใบเสนอราคา',
            'templates' => [
                'notice_title' => 'ส่งการแจ้งเตือนไปยังผู้ดูแลระบบ',
                'notice_description' => 'ส่งการแจ้งเตือนไปยังผู้ดูแลระบบเมื่อมีการส่งคำขอใบเสนอราคา',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'หมวดหมู่บริการ',
        'create' => 'สร้างหมวดหมู่บริการ',
    ],
    'service' => [
        'name' => 'บริการ',
        'create' => 'สร้างบริการ',
    ],
    'package' => [
        'name' => 'แพ็คเกจ',
        'create' => 'สร้างแพ็คเกจ',
    ],
    'project' => [
        'name' => 'โครงการ',
        'create' => 'สร้างโครงการ',
        'author' => 'ผู้เขียน',
        'client' => 'ลูกค้า',
        'place' => 'สถานที่',
        'start_date' => 'วันที่เริ่มต้น',
        'metrics' => [
            'title' => 'เมตริกของโปรเจกต์ (การ์ดกรณีศึกษา)',
            'helper' => 'คู่ค่า/ป้ายกำกับเมตริกสูงสุดสามคู่ที่แสดงในเลย์เอาต์การ์ดกรณีศึกษา ปล่อยคู่ใดให้ว่างเพื่อซ่อน',
            'value_n' => 'ค่าเมตริก :n',
            'label_n' => 'ป้ายเมตริก :n',
            'label_placeholder' => 'เช่น ประสิทธิภาพการวางแผน',
        ],
    ],
    'quotation_request' => [
        'name' => 'คำขอใบเสนอราคา',
        'viewing' => 'กำลังดูคำขอใบเสนอราคา #:name',
        'information' => 'ข้อมูล',
    ],
    'custom_field' => [
        'name' => 'ฟิลด์ที่กำหนดเอง',
        'create' => 'สร้าง',
        'type' => 'ประเภท',
        'options' => 'ตัวเลือก',
        'placeholder' => 'ตัวยึดตำแหน่ง',
        'placeholder_placeholder' => 'ป้อนตัวยึดตำแหน่ง',
        'required' => 'จำเป็น',
        'option' => [
            'label' => 'ป้ายกำกับ',
            'value' => 'ค่า',
            'add_row' => 'เพิ่มแถวใหม่',
            'add_from_global' => 'เพิ่มฟิลด์ที่กำหนดเองส่วนกลาง',
        ],
        'modal' => [
            'heading' => 'เพิ่มฟิลด์ที่กำหนดเองใหม่',
            'select_field' => 'เลือกฟิลด์',
            'button' => 'เพิ่มใหม่',
        ],
        'enums' => [
            'fields' => [
                'text' => 'ข้อความ',
                'number' => 'ตัวเลข',
                'dropdown' => 'เมนูแบบเลื่อนลง',
                'checkbox' => 'ช่องทำเครื่องหมาย',
                'textarea' => 'พื้นที่ข้อความ',
            ],
        ],
        'ask_for_select' => 'โปรดเลือกฟิลด์ที่กำหนดเอง',
        'add_a_new_custom_field' => 'เพิ่มฟิลด์ที่กำหนดเองใหม่',
    ],
    'image' => 'รูปภาพ',
    'category' => 'หมวดหมู่',
    'duration' => 'ระยะเวลา',
    'price' => 'ราคา',
    'annual_price' => 'ราคาต่อปี',
    'form' => [
        'none' => 'ไม่มี',
        'images' => 'รูปภาพ',
        'name_placeholder' => 'ป้อนชื่อ',
        'is_featured' => 'แนะนำ?',
        'price_placeholder' => 'ป้อนราคา',
        'features' => 'คุณสมบัติ',
        'features_help_block' => 'แยกด้วยบรรทัดใหม่ (+ รวมอยู่ด้วย, - ไม่รวม)',
        'features_placeholder' => 'ตัวอย่าง:
+ การจัดส่ง 15 วันทั่วโลก
+ ฟองน้ำห่อฟรี
- การสนับสนุน 24/7
        ',
        'description_placeholder' => 'ป้อนคำอธิบาย',
        'packages_switch_pricing_plan' => 'ป้อนราคาต่อปีเพื่อเปิดใช้งานคุณลักษณะการเปลี่ยนแผนราคา',
        'action_url' => 'URL การดำเนินการ',
        'action_label' => 'ป้ายกำกับการดำเนินการ',
    ],
    'is_popular' => 'ได้รับความนิยม?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'รายชั่วโมง',
            'daily' => 'รายวัน',
            'weekly' => 'รายสัปดาห์',
            'monthly' => 'รายเดือน',
            'annually' => 'รายปี',
            'quarterly' => 'รายไตรมาส',
            'one_time' => 'ครั้งเดียว',
        ],
        'quote_statuses' => [
            'read' => 'อ่านแล้ว',
            'unread' => 'ยังไม่ได้อ่าน',
        ],
    ],
    'edit_this_service' => 'แก้ไขบริการนี้',
    'edit_this_service_category' => 'แก้ไขหมวดหมู่บริการนี้',
    'edit_this_project' => 'แก้ไขโครงการนี้',
    'edit_this_project_category' => 'แก้ไขหมวดหมู่โครงการนี้',
    'edit_this_package' => 'แก้ไขแพ็คเกจนี้',
    'message' => 'ข้อความ',
    'time' => 'เวลา',
    'service_categories' => 'หมวดหมู่บริการ',
    'services' => 'บริการ',
    'projects' => 'โครงการ',
    'packages' => 'แพ็คเกจ',
];
