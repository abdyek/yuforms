Vue.component('yuforms-header-button', {
    props:['name'],
    data: function() {
        return {
            v-show:true;
        }
    }
    template: `
        <button v-show="show" class="w3-button w3-medium w3-blue-grey">{{name}}</button>\
    `
});

Vue.component('yuforms-header', {
    template: `\
        <div class="w3-top">\
            <div class="w3-row w3-large w3-light-grey">\
                <div class="w3-container w3-auto" style="max-width:1100px; height:75px">\
                    <div class="w3-cell-row">\
                        <div class="w3-container w3-cell">\
                            <h1>Yuforms<h1>\
                        </div>\
                        <div class="w3-container w3-cell">\
                            <div class="w3-right" style="margin-top:20px">\
                                <yuforms-header-button name="Yeni Form"></yuforms-header-button>
                                <yuforms-header-button name="Formlarım"></yuforms-header-button>
                                <yuforms-header-button name="Hesap"></yuforms-header-button>
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
    `
});

new Vue({
    el:'#app',
    data: {
        info:"vue is here"
    }
});
