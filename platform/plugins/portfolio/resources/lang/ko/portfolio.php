<?php

return [
    'name' => '포트폴리오',
    'settings' => [
        'success_message' => '설정이 성공적으로 저장되었습니다!',
        'email' => [
            'title' => '견적 요청',
            'description' => '견적 요청을 위한 이메일 템플릿',
            'templates' => [
                'notice_title' => '관리자에게 알림 보내기',
                'notice_description' => '견적 요청이 전송될 때 관리자에게 알림 보내기',
            ],
        ],
    ],
    'service_category' => [
        'name' => '서비스 카테고리',
        'create' => '서비스 카테고리 만들기',
    ],
    'service' => [
        'name' => '서비스',
        'create' => '서비스 만들기',
    ],
    'package' => [
        'name' => '패키지',
        'create' => '패키지 만들기',
    ],
    'project' => [
        'name' => '프로젝트',
        'create' => '프로젝트 만들기',
        'author' => '작성자',
        'client' => '클라이언트',
        'place' => '장소',
        'start_date' => '시작일',
        'metrics' => [
            'title' => '프로젝트 메트릭 (사례 연구 카드)',
            'helper' => '사례 연구 카드 레이아웃에 표시되는 최대 3개의 메트릭 값/라벨 쌍입니다. 쌍을 비워 두면 숨겨집니다.',
            'value_n' => '메트릭 :n 값',
            'label_n' => '메트릭 :n 라벨',
            'label_placeholder' => '예: 계획 효율성',
        ],
    ],
    'quotation_request' => [
        'name' => '견적 요청',
        'viewing' => '견적 요청 보기 #:name',
        'information' => '정보',
    ],
    'custom_field' => [
        'name' => '사용자 정의 필드',
        'create' => '만들기',
        'type' => '유형',
        'options' => '옵션',
        'placeholder' => '플레이스홀더',
        'placeholder_placeholder' => '플레이스홀더 입력',
        'required' => '필수',
        'option' => [
            'label' => '라벨',
            'value' => '값',
            'add_row' => '새 행 추가',
            'add_from_global' => '전역 사용자 정의 필드 추가',
        ],
        'modal' => [
            'heading' => '새 사용자 정의 필드 추가',
            'select_field' => '필드 선택',
            'button' => '새로 추가',
        ],
        'enums' => [
            'fields' => [
                'text' => '텍스트',
                'number' => '숫자',
                'dropdown' => '드롭다운',
                'checkbox' => '체크박스',
                'textarea' => '텍스트 영역',
            ],
        ],
        'ask_for_select' => '사용자 정의 필드를 선택하세요',
        'add_a_new_custom_field' => '새 사용자 정의 필드 추가',
    ],
    'image' => '이미지',
    'category' => '카테고리',
    'duration' => '기간',
    'price' => '가격',
    'annual_price' => '연간 가격',
    'form' => [
        'none' => '없음',
        'images' => '이미지',
        'name_placeholder' => '이름 입력',
        'is_featured' => '추천?',
        'price_placeholder' => '가격 입력',
        'features' => '기능',
        'features_help_block' => '새 줄로 구분 (+ 포함됨, - 포함되지 않음)',
        'features_placeholder' => '예시:
+ 전 세계 15일 배송
+ 무료 버블랩
- 24/7 지원
        ',
        'description_placeholder' => '설명 입력',
        'packages_switch_pricing_plan' => '가격 플랜 전환 기능을 위해 연간 가격을 입력하세요',
        'action_url' => '액션 URL',
        'action_label' => '액션 라벨',
    ],
    'is_popular' => '인기?',
    'enums' => [
        'package_durations' => [
            'hourly' => '시간별',
            'daily' => '일일',
            'weekly' => '주간',
            'monthly' => '월간',
            'annually' => '연간',
            'quarterly' => '분기별',
            'one_time' => '일회성',
        ],
        'quote_statuses' => [
            'read' => '읽음',
            'unread' => '읽지 않음',
        ],
    ],
    'edit_this_service' => '이 서비스 편집',
    'edit_this_service_category' => '이 서비스 카테고리 편집',
    'edit_this_project' => '이 프로젝트 편집',
    'edit_this_project_category' => '이 프로젝트 카테고리 편집',
    'edit_this_package' => '이 패키지 편집',
    'message' => '메시지',
    'time' => '시간',
    'service_categories' => '서비스 카테고리',
    'services' => '서비스',
    'projects' => '프로젝트',
    'packages' => '패키지',
];
