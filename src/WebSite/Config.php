<?php

namespace Yuforms\WebSite;

class Config {
    const PAGES = [
        'index'=>[
            'name'=>'Index',
            'title'=>'Ana Sayfa',
            'authorization'=>[
                'guest'=>true,
                'member'=>true
            ]
        ],
        'giris-yap'=>[
            'name'=>'Login',
            'title'=>'Giriş Yap',
            'authorization'=>[
                'guest'=>true,
                'member'=>'profil'
            ]
        ],
        'yeni-form'=>[
            'name'=>'NewForm',
            'title'=>'Yeni Form Oluştur',
            'authorization'=>[
                'guest'=>'giris-yap',
                'member'=>true
            ]
        ],
        'form-duzenle'=>[
            'name'=>'EditForm',
            'title'=>'Form Düzenle',
            'authorization'=>[
                'guest'=>'giris-yap',
                'member'=>true
            ]
        ],
        'formlarim'=>[
            'name'=>'MyForms',
            'title'=>'Formlarım',
            'authorization'=>[
                'guest'=>'giris-yap',
                'member'=>true
            ]
        ],
        'deneme'=>[
            'name'=>'Deneme',
            'title'=>'Burası Başlık Ehe Ehe',
            'authorization'=>[
                'guest'=>true,
                'member'=>true
            ]
        ],
        'profil'=>[
            'name'=>'Profile',
            'title'=>'Profilim',
            'authorization'=>[
                'guest'=>'giris-yap',
                'member'=>true
            ]
        ]
    ];
}