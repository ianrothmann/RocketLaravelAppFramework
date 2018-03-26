<?php

return [
    'language' => [
        'url' => 'rocket/language',
        'routename' => 'rocket.language.save',
        'middleware' => []
    ],
    'disks' => [
        'public'=>'s3',
        'private'=>'s3private',
        'temporaryUrls'=>true
    ],
    'breadcrumbs' => [
        'number'=>4,
        'default'=>'hide'
    ]
];
