<?php

namespace Yuforms\Config;

class Config {
    const CONTROLLER = [
        'Example'=>[
            'POST'=>[
                'authorization'=>['guest', 'member', 'root'],
                'required'=>[
                    'name'=>[
                        'type'=>'str', // str, arr, int
                        'limits'=>[
                            'min'=>0,
                            'max'=>10
                        ]
                    ],
                    'surname'=>[
                        'type'=>'str', // str, arr, int
                        'limits'=>[
                            'min'=>0,
                            'max'=>30
                        ]
                    ],
                    'other'=>[
                        'other1'=>[
                            'type'=>'str', // str, arr, int
                            'limits'=>[
                                'min'=>0,
                                'max'=>30
                            ]
                        ],
                        'other2'=>[
                            'type'=>'str', // str, arr, int
                            'limits'=>[
                                'min'=>0,
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
