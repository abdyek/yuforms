Vue.component('yuforms-header-button', {
    props:['name'],
    data: function() {
        return {
            show:true
        }
    },
    template: `
        <button v-show="show" class="w3-button w3-medium w3-blue-grey">{{name}}</button>\
    `
});

Vue.component('yuforms-header', {
    template: `\
        <div class="w3-top">\
            <div class="w3-row w3-large w3-light-grey w3-card-2">\
                <div class="w3-container w3-auto" style="max-width:1100px; height:75px">\
                    <div class="w3-cell-row">\
                        <div class="w3-container w3-cell">\
                            <h1>Yuforms</h1>\
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

Vue.component('yuforms-container', {
    props:{
        'margin-left':{
            type:Boolean,
            default:false
        },
        'margin-right':{
            type:Boolean,
            default:false
        },
        'margin-top':{
            type:Boolean,
            default:false
        },
        'margin-bottom': {
            type:Boolean,
            default:false
        },
        'card': {
            type:Boolean,
            default:false
        },
        'light-grey': {
            type:Boolean,
            default:false
        }
    },
    template: `
        <div :class="{'w3-container':true, 'w3-margin-left': marginLeft, 'w3-margin-right':marginRight, 'w3-margin-top':marginTop, 'w3-margin-bottom':marginBottom, 'w3-card':card, 'w3-light-grey':lightGrey}">
            <slot></slot>
        </div>
    `
});

Vue.component('yuforms-form-component-input-text',{
    props:['question', 'label'],
    template: `
        <yuforms-container :card="true" :light-grey="true">
            <h4>{{question}}</h4>
            <div class="w3-padding-16">
                <label>{{label}}</label>
                <input class="w3-input" type="text">
            </div> 
        </yuforms-container>
    `
});

Vue.component('yuforms-form-component-input-checkbox', {
    props:['question', 'options'],
    template: `
        <yuforms-container :card="true" :light-grey="true">
            <h4>{{question}}</h4>
            <div class="w3-padding-16" v-for="opt in options" :key="opt.id">
                <input class="w3-check" type="checkbox" :checked="opt.checked">
                <label>{{opt.name}}</label>
            </div> 
        </yuforms-container>
    `
});

Vue.component('yuforms-form-component-input-radio', {
    props:['question', 'options'],
    template: `
        <yuforms-container :card="true" :light-grey="true">
            <h4>{{question}}</h4>
            <div class="w3-padding-16" v-for="opt in options" :key="opt.id">
                <input class="w3-radio" type="radio" name="gender" :value="opt.value" :checked="opt.checked">
                <label>{{opt.name}}</label>
            </div>
        </yuforms-container>
    `
});

Vue.component('yuforms-form-component-select', {
    props:['question', 'options'],
    template:`
        <yuforms-container :card="true" :light-grey="true">
            <h4>{{question}}</h4>
            <div class="w3-padding-16">
                <select class="w3-select" name="option">
                    <option value="" disabled selected>-- Lütfen Seçiniz --</option>
                    <option v-for="opt in options" :key="opt.id" :value="opt.value">{{opt.name}}</option>
                </select>
            </div> 
        </yuforms-container>
    `
});

Vue.component('yuforms-form-header', {
    props:['name'],
    template:`
        <h2>{{name}}</h2>
    `
});

Vue.component('yuforms-new-question', {
    props:['formComponentList'],
    data: function() {
        return {
            clicked:false,
            selectedValue:"",
            createButtonShow:false
        }
    },
    methods: {
        toggleClicked: function() {
            this.clicked = (this.clicked==false)?true:false;
        },
        onChange: function(e) {
            this.createButtonShow = true;
            this.selectedValue=e.target.value;
        }
    },
    template: `
        <yuforms-container :card="true" :light-grey="true">
            <div v-if="clicked==false" class="w3-center w3-margin-top w3-margin-bottom">
                <button class="w3-button w3-xlarge w3-dark-grey" @click="this.toggleClicked">+</button>
            </div>
            <div v-else>
                <div class="w3-cell-row">
                    <div class="w3-cell">
                        <h3>Yeni Soru</h3>
                    </div>
                    <div class="w3-cell">
                        <div class="w3-right">
                            <button class="w3-button w3-dark-grey" @click="this.toggleClicked">İptal</button>
                        </div>
                    </div>
                </div>
                <div class="w3-cell-row">
                    <div class="w3-container w3-cell">
                        <h5>Tür</h5>
                    </div>
                    <div class="w3-container w3-cell">
                        <div class="w3-right">
                            <select class="w3-select" name="component-type" v-model="selectedValue" >
                                <option value="" disabled selected>-- Lütfen Seçiniz --</option>
                                <option v-for="opt in formComponentList" :key="opt.id" :value="opt.value" @click.prevent="onChange">{{opt.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div v-if="selectedValue=='input-text'" class="w3-cell-row">
                    <div class="w3-cell w3-padding-16">
                        <yuforms-basic-input label="Soru"></yuforms-basic-input>
                    </div>
                </div>
                <div v-else-if="selectedValue=='input-radio'">
                    <div  class="w3-cell-row">
                        <div class="w3-cell w3-padding-16">
                            <yuforms-basic-input label="Soru"></yuforms-basic-input>
                        </div>
                    </div>
                    <div class="w3-cell-row">
                        <div class="w3-cell">
                            <h6>Seçenekler</h6>
                        </div>
                    </div>
                    <div  class="w3-cell-row">
                        <div class="w3-cell w3-padding-16">
                            <yuforms-new-question-select-option-options>
                            </yuforms-new-question-select-option-options>
                        </div>
                    </div>
                </div>
                <div v-else class="w3-cell-row"></div>
                <div v-if="createButtonShow" class="w3-cell-row">
                    <div class="w3-cell">
                        <div class="w3-right w3-margin-bottom">
                            <button class="w3-button w3-black">Oluştur</button>
                        </div>
                    </div>
                </div>
            </div>
        </yuforms-container>
    `
});

Vue.component('yuforms-new-question-select-option-options', {
    data: function() {
        return {
            index:0,
            opts: [
                {
                    id:0,
                    placeholder:"Seçenek 1",
                    value:"",
                }
            ]
        }
    },
    methods: {
        tiktik:function(e) {
            this.opts[e.target.name].value=e.target.value;
            console.log(this.opts[0].value);
            let length = this.opts.length;
            if(e.target.name==length-1 && this.opts[length-1].value.length>0) {
                // add to end
                this.opts.push({
                    id:length,
                    placeholder:"Seçenek " + (length+1)
                });
            } else if(e.target.name==length-2 && e.target.value.length==0) {
                // delete last
                this.opts.splice(-1,1);
            } else if(e.target.name<length && e.target.value.length==0) {
                let newArr = this.opts.slice();
                for(let i=parseInt(e.target.name);i<length-1;i++) {
                    newArr[i].value = newArr[i+1].value;
                }
                newArr.splice(-1,1);
                this.opts = newArr;
            }
        }
    },
    template: `
        <div>
            <input :key="opt.id" :name="opt.id" v-for="opt in opts" class="w3-input" type="text" :value="opt.value" @input.prevent="tiktik" :placeholder="opt.placeholder">
        </div>
    `
});

Vue.component('yuforms-basic-input', {
    props:{
        label:{
            default:""
        },
        placeholder: {
            default:""
        }
    },
    template: `
        <div>
            <label>{{label}}</label>
            <input class="w3-input" type="text" :placeholder="placeholder">
        </div>
    `
});

Vue.component('yuforms-main', {
    template:`
        <div id="yuforms-content" class="w3-auto">
            <slot></slot>
        </div>
    `
});

Vue.component('yuforms-right', {
    template:`
        <div class="w3-right">
            <slot></slot>
        </div>
    `
});

Vue.component('yuforms-button', {
    props: {
        name: {
            type:String,
            default:"button"
        },
        marginTop: {
            type:Boolean,
            default:false
        },
        marginRight: {
            type:Boolean,
            default:false
        },
        marginBottom: {
            type:Boolean,
            default:false
        },
        marginLeft: {
            type:Boolean,
            default:false
        }
    },
    template: `
        <button :class="{'w3-button':true, 'w3-blue':true, 'w3-margin-top':marginTop, 'w3-margin-right':marginRight, 'w3-margin-bottom':marginBottom, 'w3-margin-left':marginLeft}">{{name}}</button>
    `
});

new Vue({
    el:'#app',
    data: {
        info:"vue is here"
    }
});
