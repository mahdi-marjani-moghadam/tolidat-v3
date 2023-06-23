<?php

return [
    'address' => 5,
    'phone' => 2,
    'website' => 3,
    'commercial_name' => 3,
    'news' => 7,
    'email' => 3,
    'social' => 3,
    'banner' => 2,
    'logo' => 4,
    'licence' => 3,
    'position' => 3,
    'honour' => 2,
    'history' => 5,
    'employment' => 7,
    'advertise' => 3,
    'keyword' => 5,
    'national_id' => 10,
    'licence_number' => 10,
    'branch' => 5,
    'representation' => 5,
    'company_name' => 2,
    'manager_name' => 3,
    'catalog' => 2,
    'video_script' => 2,
    'product' => [
        'keyword' => [
            ['min' => 1, 'max' => 3, 'score' => 3], // score is percent and condition min >= 1 & max<= 3
            ['min' => 4, 'max' => 5, 'score' => 7], // score is percent and condition min >= 4 & max<= 5
            ['min' => 6, 'max' => 'end', 'score' => 10], // score is percent and condition min >= 6
        ],

        'image' => 20, // percent

        'description' => [
            ['min' => 50, 'max' => 70, 'score' => 30], // score is percent
            ['min' => 71, 'max' => 100, 'score' => 50], // score is percent
            ['min' => 101, 'max' => 150, 'score' => 60], // score is percent
            ['min' => 151, 'max' => 'end', 'score' => 70], // score is percent
        ]
    ],

    'company_description' => [
        ['min' => 5, 'max' => 30, 'score' => 1], // score is percent
        ['min' => 31, 'max' => 60, 'score' => 3], // score is percent
        ['min' => 61, 'max' => 100, 'score' => 5], // score is percent
        ['min' => 101, 'max' => 'end', 'score' => 7], // score is percent
    ]
];