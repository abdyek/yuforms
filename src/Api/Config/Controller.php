<?php

namespace Yuforms\Api\Config;

class Controller {
    const CONTROLLER = [
        'Example'=>[
            'POST'=>[
                'authorization'=>['guest', 'member', 'root'],
                    /*
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
                ]*/
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
                'authorization'=>['guest'],
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
                'authorization'=>['guest'],
                'required'=>[
                    'email'=>[
                        'type'=>'email',
                        'limits'=>[
                            'min'=>1,
                            'max'=>255
                        ]
                    ],
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
                'authorization'=>['guest'],
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
                'authorization'=>['guest'],
                'required'=>[
                    'email'=>[
                        'type'=>'email',
                        'limits'=>[
                            'min'=>1,
                            'max'=>255
                        ]
                    ]
                ]
            ],
            'PATCH'=>[
                'authorization'=>['guest'],
                'required'=>[
                    'email'=>[
                        'type'=>'email',
                        'limits'=>[
                            'min'=>1,
                            'max'=>255
                        ],
                    ],
                    'code'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>10,
                            'max'=>10
                        ]
                    ],
                    'newPassword'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>10,
                            'max'=>50
                        ]
                    ]
                ]
            ]
        ],
        'ChangeMyPassword'=>[
            'PATCH'=>[
                'authorization'=>['member'],
                'required'=>[
                    'password'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>10,
                            'max'=>50
                        ]
                    ],
                    'newPassword'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>10,
                            'max'=>50
                        ]
                    ]
                ]
            ]
        ],
        'ChangeMyEmail'=>[
            'PATCH'=>[
                'authorization'=>['member'],
                'required'=>[
                    'password'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>10,
                            'max'=>50
                        ]
                    ],
                    'newEmail'=>[
                        'type'=>'email',
                        'limits'=>[
                            'min'=>1,
                            'max'=>255
                        ]
                    ]
                ]
            ]
        ],
        'LogOut'=>[
            'POST'=>[
                'authorization'=>['member']
            ]
        ],
        'Form'=>[
            'POST'=>[
                'authorization'=>['member'],
            ],
            /* these codes will changed by myself
            'GET'=>[
                'authorization'=>['member'],
                'required'=>[
                    'id'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>1,
                            'max'=>11,
                        ]
                    ]
                ]
            ],
             */
            'PUT'=>[
                'authorization'=>['member'],
                'required'=>[
                    'id'=>[
                        'type'=>'int',
                        'limits'=>[
                            'min'=>1,
                            'max'=>11
                        ]
                    ],
                    'formTitle'=>[
                        'type'=>'str',
                        'limits'=>[
                            'min'=>1,
                            'max'=>256
                        ]
                    ],
                    'questions'=>[
                        'type'=>'arr',
                        'limits'=>[
                            'min'=>1,
                            'max'=>50  // actually there isn't top limit, I can change it
                        ]
                    ]
                ]
            ],
            'DELETE'=>[
                'authorization'=>['member'],
                'required'=>[
                    'id'=>[
                        'type'=>'int',
                        'limits'=>[
                            'min'=>1,
                            'max'=>11
                        ]
                    ]
                ]
            ]
        ],
        'Share'=>[
            'POST'=>[
                'authorization'=>['member'],
                'required'=>[
                    'id'=>[
                        'type'=>'int',
                        'limits'=>[
                            'min'=>1,
                            'max'=>11
                        ]
                    ],
                    'onlyMember'=>[
                        'type'=>'int',
                        'limits'=>[
                            'min'=>1,
                            'max'=>1
                        ]
                    ]
                ]
            ],
            'DELETE'=>[
                'authorization'=>['member'],
                'required'=>[
                    'id'=>[
                        'type'=>'int',
                        'limits'=>[
                            'min'=>1,
                            'max'=>11
                        ]
                    ]
                ]
            ],
        ],
        'Submit'=>[
            'GET'=>[
                'authorization'=>['guest', 'member'],
                'required'=>[
                    'id'=>[
                        'type'=>'int',
                        'limits'=>[
                            'min'=>1,
                            'max'=>11
                        ]
                    ]
                ]
            ]
        ]
    ];
}
