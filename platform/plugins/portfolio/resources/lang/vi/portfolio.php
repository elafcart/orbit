<?php

return [
    'name' => 'Danh mục đầu tư',
    'settings' => [
        'success_message' => 'Cài đặt đã được lưu thành công!',
        'email' => [
            'title' => 'Yêu cầu báo giá',
            'description' => 'Mẫu email cho yêu cầu báo giá',
            'templates' => [
                'notice_title' => 'Gửi thông báo cho quản trị viên',
                'notice_description' => 'Gửi thông báo cho quản trị viên khi có yêu cầu báo giá',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Danh mục dịch vụ',
        'create' => 'Tạo danh mục dịch vụ',
    ],
    'service' => [
        'name' => 'Dịch vụ',
        'create' => 'Tạo dịch vụ',
    ],
    'package' => [
        'name' => 'Gói dịch vụ',
        'create' => 'Tạo gói dịch vụ',
    ],
    'project' => [
        'name' => 'Dự án',
        'create' => 'Tạo dự án',
        'author' => 'Tác giả',
        'client' => 'Khách hàng',
        'place' => 'Địa điểm',
        'start_date' => 'Ngày bắt đầu',
        'metrics' => [
            'title' => 'Chỉ số dự án (thẻ case study)',
            'helper' => 'Tối đa ba cặp giá trị/nhãn chỉ số hiển thị trên các bố cục thẻ case study. Để trống bất kỳ cặp nào để ẩn nó.',
            'value_n' => 'Giá trị chỉ số :n',
            'label_n' => 'Nhãn chỉ số :n',
            'label_placeholder' => 'vd: Hiệu quả lập kế hoạch',
        ],
    ],
    'quotation_request' => [
        'name' => 'Yêu cầu báo giá',
        'viewing' => 'Xem yêu cầu báo giá #:name',
        'information' => 'Thông tin',
    ],
    'custom_field' => [
        'name' => 'Trường tùy chỉnh',
        'create' => 'Tạo',
        'type' => 'Loại',
        'options' => 'Tùy chọn',
        'placeholder' => 'Văn bản gợi ý',
        'placeholder_placeholder' => 'Nhập văn bản gợi ý',
        'required' => 'Bắt buộc',
        'option' => [
            'label' => 'Nhãn',
            'value' => 'Giá trị',
            'add_row' => 'Thêm hàng mới',
            'add_from_global' => 'Thêm trường tùy chỉnh chung',
        ],
        'modal' => [
            'heading' => 'Thêm trường tùy chỉnh mới',
            'select_field' => 'Chọn trường',
            'button' => 'Thêm mới',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Văn bản',
                'number' => 'Số',
                'dropdown' => 'Danh sách thả xuống',
                'checkbox' => 'Hộp kiểm',
                'textarea' => 'Vùng văn bản',
            ],
        ],
        'ask_for_select' => 'Vui lòng chọn một trường tùy chỉnh',
        'add_a_new_custom_field' => 'Thêm trường tùy chỉnh mới',
    ],
    'image' => 'Hình ảnh',
    'category' => 'Danh mục',
    'duration' => 'Thời hạn',
    'price' => 'Giá',
    'annual_price' => 'Giá hàng năm',
    'form' => [
        'none' => 'Không có',
        'images' => 'Hình ảnh',
        'name_placeholder' => 'Nhập tên',
        'is_featured' => 'Nổi bật?',
        'price_placeholder' => 'Nhập giá',
        'features' => 'Tính năng',
        'features_help_block' => 'Phân tách bằng dòng mới (+ là bao gồm, - là không bao gồm)',
        'features_placeholder' => 'Ví dụ:
+ Vận chuyển toàn cầu trong 15 ngày
+ Bọc bong bóng miễn phí
- Hỗ trợ 24/7
        ',
        'description_placeholder' => 'Nhập mô tả',
        'packages_switch_pricing_plan' => 'Nhập giá hàng năm để kích hoạt tính năng chuyển đổi gói giá',
        'action_url' => 'Liên kết hành động',
        'action_label' => 'Nhãn hành động',
    ],
    'is_popular' => 'Phổ biến?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Theo giờ',
            'daily' => 'Hàng ngày',
            'weekly' => 'Hàng tuần',
            'monthly' => 'Hàng tháng',
            'annually' => 'Hàng năm',
            'quarterly' => 'Hàng quý',
            'one_time' => 'Một lần',
        ],
        'quote_statuses' => [
            'read' => 'Đã đọc',
            'unread' => 'Chưa đọc',
        ],
    ],
    'edit_this_service' => 'Chỉnh sửa dịch vụ này',
    'edit_this_service_category' => 'Chỉnh sửa danh mục dịch vụ này',
    'edit_this_project' => 'Chỉnh sửa dự án này',
    'edit_this_project_category' => 'Chỉnh sửa danh mục dự án này',
    'edit_this_package' => 'Chỉnh sửa gói dịch vụ này',
    'message' => 'Tin nhắn',
    'time' => 'Thời gian',
    'service_categories' => 'Danh mục dịch vụ',
    'services' => 'Dịch vụ',
    'projects' => 'Dự án',
    'packages' => 'Gói dịch vụ',
];