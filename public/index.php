<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Yuforms</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style/w3.css">
    <link rel="stylesheet" href="public/style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <yuforms-header></yuforms-header>
        <yuforms-main>
            <!-- yuforms-form-header is here -->
            <yuforms-container :margin-top="true" :margin-right="true">
                <yuforms-form-header name="Sanat Tarihi Hakkında"></yuforms-form-header>
            </yuforms-container>
            <yuforms-container :margin-top="true">
                <yuforms-form-component-input-text question="İsminiz Nedir?" label="isminiz"></yuforms-form-component-input-text>
            </yuforms-container>
            <yuforms-container :margin-top="true">
                <yuforms-form-component-input-checkbox question="Arkadaşlar bu bir virüs olabilir mi?" :options="[{id:0, name:'Bilmem', checked:false}, {id:1, name:'Orda durcan', checked:true}]">
                </yuforms-form-component-input-checkbox>
            </yuforms-container>
            <yuforms-container :margin-top="true">
                <yuforms-form-component-input-radio question="Arkadaşlar bu bir virüs olabilir mi?" :options="[{id:0, name:'Evet', value:'yes', checked:false}, {id:1, name:'Hayır', value:'no', checked:true}]">
                </yuforms-form-component-input-radio>
            </yuforms-container>
            <yuforms-container :margin-top="true">
                <yuforms-form-component-select question="Bir tanesi seç lan tirrek" :options="[{id:0, name:'Evet', value:'yes', checked:false}, {id:1, name:'Hayır', value:'no', checked:true}]">
                </yuforms-form-component-select>
            </yuforms-container>
            <yuforms-container :margin-top="true">
                <div class="w3-container w3-card w3-light-grey">
                    <h4>Seçiniz</h4>
                    <div class="w3-padding-16">
                        <div class="w3-row-padding">
                            <div class="w3-third">
                                <input class="w3-input w3-border" type="text" placeholder="One">
                            </div>
                            <div class="w3-third">
                                <input class="w3-input w3-border" type="text" placeholder="Two">
                            </div>
                            <div class="w3-third">
                                <input class="w3-input w3-border" type="text" placeholder="Three">
                            </div>
                        </div>
                    </div>
                </div>
            </yuforms-container>
            <yuforms-container :margin-top="true">
                <yuforms-new-question :form-component-list="[{id:0, name:'Kısa Cevap', value:'input-text', checked:false}, {id:1, name:'Çoktan Seçmeli', value:'input-radio', checked:false}]"></yuforms-new-question>
            </yuforms-container>
        </yuforms-main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script> 
    <script src="public/script/script.js"></script>
</body>
</html>
