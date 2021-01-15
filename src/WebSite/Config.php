<?php

namespace Yuforms\WebSite;

class Config {
    const PAGES = [
        'index'=>[
            'className'=>'Index',
            'title'=>'Ana Sayfa'                // For template, not now
        ],
        'giris-yap'=>[
            'className'=>'Login',
            'title'=>'Giriş Yap'                // For template, not now
        ],
        'yeni-form'=>[
            'className'=>'NewForm',
            'title'=>'Yeni Form Oluştur'        // For template, not now
        ],
        'form-duzenle'=>[
            'className'=>'EditForm',
            'title'=>'Form Düzenle'             // For template, not now
        ],
        'formlarim'=>[
            'className'=>'MyForms',
            'title'=>'Formlarım'                // For template, not now
        ],
    ];
}
