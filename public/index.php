<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Yuforms</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        {{info}}
    </div>
    <div class="w3-top">
        <div class="w3-row w3-large w3-light-grey">
            <div class="w3-container w3-auto" style="max-width:1100px; height:75px">
                <div class="w3-cell-row">
                    <div class="w3-container w3-cell">
                        <h1>Yuforms<h1>
                    </div>
                    <div class="w3-container w3-cell">
                        <div class="w3-right" style="margin-top:20px">
                            <button class="w3-button w3-medium w3-blue-grey">Yeni Form</button>
                            <button class="w3-button w3-medium w3-blue-grey">Formlarım</button>
                            <button class="w3-button w3-medium w3-blue-grey">Hesap</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-auto" style="max-width:1100px; height:2000px; margin-top:65px">
        <div class="w3-container">
            <p style="text-align:justify;">
     Proin iaculis sem ac ligula mollis laoreet. Maecenas sit amet ipsum id eros auctor imperdiet. Sed eu finibus mauris. Maecenas commodo aliquet quam. Phasellus tincidunt est et justo faucibus dictum. Integer tempor interdum ligula, sit amet egestas velit consequat ac. Vestibulum sodales tristique interdum. Vestibulum rhoncus rhoncus ante, nec tincidunt nisl tincidunt nec. Aenean convallis, urna eu auctor interdum, odio ligula aliquet leo, in euismod metus mi a metus. Sed quis dolor suscipit, porta lorem vitae, tincidunt risus. Morbi dui ipsum, pretium imperdiet ex a, vulputate semper urna. 
            </p>
        </div>
        <div class="w3-container w3-margin-top">
            <div class="w3-container w3-card w3-light-grey">
                <h4>İsminiz nedir?</h4>
                <div class="w3-padding-16">
                    <label>First Name</label>
                    <input class="w3-input" type="text">
                    <label>Last Name</label>
                    <input class="w3-input" type="text">
                </div> 
            </div>
        </div>
        <div class="w3-container w3-margin-top">
            <div class="w3-container w3-card w3-light-grey">
                <h4>Hangisini tercih edersiniz?</h4>
                <div class="w3-padding-16">
                    <input class="w3-check" type="checkbox" checked="checked">
                    <label>Milk</label>

                    <input class="w3-check" type="checkbox">
                    <label>Sugar</label>

                    <input class="w3-check" type="checkbox" disabled>
                    <label>Lemon (Disabled)</label> 
                </div> 
            </div>
        </div>
        <div class="w3-container w3-margin-top">
            <div class="w3-container w3-card w3-light-grey">
                <h4>Cinsiyetiniz?</h4>
                <div class="w3-padding-16">
                    <input class="w3-radio" type="radio" name="gender" value="male" checked>
                    <label>Male</label>

                    <input class="w3-radio" type="radio" name="gender" value="female">
                    <label>Female</label>

                    <input class="w3-radio" type="radio" name="gender" value="" disabled>
                    <label>Don't know (Disabled)</label>
                </div> 
            </div>
        </div>
        <div class="w3-container w3-margin-top">
            <div class="w3-container w3-card w3-light-grey">
                <h4>Seçiniz</h4>
                <div class="w3-padding-16">
                    <select class="w3-select" name="option">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                </div> 
            </div>
        </div>
        <div class="w3-container w3-margin-top">
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script> 
    <script src="public/script/script.js"></script>
</body>
</html>
