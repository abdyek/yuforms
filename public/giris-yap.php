<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Giriş Yap</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style/w3.css">
    <link rel="stylesheet" href="public/style/style.css">
    <link rel="stylesheet" href="public/style/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <yuforms-header></yuforms-header>
        <yuforms-main>
             <div id="yuforms-login" class="w3-card-4 w3-auto">
                <div class="w3-container w3-teal">
                    <h2>Giriş Yap</h2>
                </div>
                <yuforms-container :margin-top="true">
                    <label>E-posta</label>
                    <input class="w3-input" type="text">
                    <label>Parola</label>
                    <input class="w3-input" type="text">
                </yuforms-container>
                <yuforms-container>
                    <yuforms-right>
                        <yuforms-button name="Giriş Yap" margin-top margin-bottom></yuforms-button>
                    </yuforms-right>
                </yuforms-container>
            </div>
        </yuforms-main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script> 
    <script src="public/script/script.js"></script>
</body>
</html>
