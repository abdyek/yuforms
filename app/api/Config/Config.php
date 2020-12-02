<?php

namespace Yuforms\Config;

class Config {
    const CONTROLLER = [
        'Example'=>[
            'POST'=>[
                'authorization'=>['guest', 'member', 'root'],
                'required'=>[
                    'key1'=>[
                        'type'=>'str', // str, arr, int
                        'limits'=>[
                            'min'=>0,
                            'max'=>10
                        ]
                    ],
                    'key2'=>[
                        'type'=>'int', // str, arr, int
                        'limits'=>[
                            'min'=>20,
                            'max'=>30
                        ]
                    ],
                    'wrapperKey'=>[
                        'subKey1'=>[
                            'type'=>'int', // str, arr, int
                            'limits'=>[
                                'min'=>20,
                                'max'=>30
                            ]
                        ],
                        'subKey2'=>[
                            'type'=>'int', // str, arr, int
                            'limits'=>[
                                'min'=>20,
                                'max'=>30
                            ]
                        ],
                    ]
                ]
            ],
            'GET'=>[
                'authorization'=>['guest', 'member', 'root'],
            ],
            'PUT'=>[
                'authorization'=>['guest', 'member', 'root'],
            ],
            'PATCH'=>[
                'authorization'=>['guest', 'member', 'root'],
            ],
            'DELETE'=>[
                'authorization'=>['guest', 'member', 'root'],
            ]
        ]
    ];
}
