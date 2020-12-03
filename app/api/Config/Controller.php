<?php

namespace Yuforms\Config;

class Controller {
    const CONTROLLER = [
        'Example'=>[
            'POST'=>[
                'authorization'=>['guest', 'member', 'root'],
                'required'=>[
                    'name'=>[
                        'type'=>'str', // str, arr, int, email
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
        ],
        'SignUp'=>[
            'POST'=>[
                'authorization'=>['member'],
                'required'=>[
                    'email'=>[
                        'type'=>'email',
                        'limits'=>[
                            'min'=>1,
                            'max'=>255
                        ]
                    ],
                    'firstName'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>1,
                            'max'=>50
                        ]
                    ],
                    'lastName'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>1,
                            'max'=>50
                        ]
                    ],
                    'password'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>10,
                            'max'=>50
                        ]
                    ]
                ]
            ]
        ],
        'ConfirmEmail'=>[
            'POST'=>[
                'authorization'=>['member'],
                'required'=>[
                    'code'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>6,
                            'max'=>6
                        ]
                    ]
                ]
            ]
        ],
        'Login'=>[
            'POST'=>[
                'authorization'=>['member'],
                'required'=>[
                    'email'=>[
                        'type'=>'email',
                        'limits'=>[
                            'min'=>1,
                            'max'=>255
                        ]
                    ],
                    'password'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>10,
                            'max'=>50
                        ]
                    ]
                ]
            ]
        ],
        'ForgotMyPassword'=>[
            'POST'=>[
                'authorization'=>['member']
            ]
        ],
        'ChangeMyPassword'=>[
            'POST'=>[
                'authorization'=>['member']
            ]
        ],
        'ChangeMyEmail'=>[
            'PATCH'=>[
                'authorization'=>['member']
            ]
        ],
        'LogOut'=>[
            'POST'=>[
                'authorization'=>['member']
            ]
        ]
    ];
}
