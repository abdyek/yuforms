// global funcs

function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function changePage(uri) {
    window.location.href="/yuforms"+uri;
}

function base64FromObject(obj) {
    let stringified = JSON.stringify(obj);
    let encodedUTF8 = encode_utf8(stringified);
    return btoa(encodedUTF8);
}

function encode_utf8(s) {
  return unescape(encodeURIComponent(s));
}

function decode_utf8(s) {
  return decodeURIComponent(escape(s));
}

function objectFromBase64(encoded) {
    let decoded = atob(encoded);
    let decodedUTF8 = decode_utf8(decoded);
    return JSON.parse(decodedUTF8);
}

function setCookie(key, value) {
    let now = new Date();
    let time = now.getTime();
    let expireTime = time + 31556926000;
    now.setTime(expireTime);
    document.cookie = key+'='+value+';expires='+now.toUTCString()+';path=/';
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function getUserInfo() {
    const hash = getCookie('user');
    if(hash=="" || hash=='null') {
        return false;
    }
    const userInfo = objectFromBase64(hash);
    const keys = ['email', 'firstName', 'id', 'lastName'];
    for(let i=0;i<keys.length;i++) {
        if(userInfo[keys[i]]==undefined) {
            return false;
        }
    }
    return userInfo;
}

// ^ global funcs

Vue.component('yuforms-header-button', {
    props:['name'],
    data: function() {
        return {
            show:true
        }
    },
    template: `
        <button v-show="show" @click="$emit('on-click')" class="w3-button w3-medium w3-blue-grey">{{name}}</button>\
    `
});

Vue.component('yuforms-header', {
    beforeCreate() {
        this.userInfo = getUserInfo();
        this.guest = (this.userInfo==false)?true:false;
    },
    template: `\
        <div class="w3-top">\
            <div class="w3-row w3-large w3-light-grey w3-card-2">\
                <div class="w3-container w3-auto" style="max-width:1100px; height:75px">\
                    <div class="w3-cell-row">\
                        <div class="w3-container w3-cell">\
                            <h1>Yuforms</h1>\
                        </div>\
                        <div class="w3-container w3-cell">\
                            <div v-if="this.guest" class="w3-right" style="margin-top:20px">\
                                <yuforms-header-button name="Giriş Yap" @on-click="go('giris-yap')"></yuforms-header-button>
                            </div>\
                            <div v-else class="w3-right" style="margin-top:20px">\
                                <yuforms-header-button name="Yeni Form" @on-click="go('yeni-form')"></yuforms-header-button>
                                <yuforms-header-button name="Formlarım" @on-click="go('formlarim')"></yuforms-header-button>
                                <yuforms-header-button name="Profil" @on-click="go('profilim')"></yuforms-header-button>
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
    `,
    methods: {
        go: function(slug) {
            changePage('/'+slug);
        }
    }
});

Vue.component('yuforms-div', {
    props: {
        'margin-top':{
            type:Boolean,
            default:false
        },
        'margin-right':{
            type:Boolean,
            default:false
        },
        'margin-bottom': {
            type:Boolean,
            default:false
        },
        'margin-left':{
            type:Boolean,
            default:false
        }
    },
    template: `
        <div :class="{'w3-margin-top': marginTop, 'w3-margin-right':marginRight, 'w3-margin-bottom':marginBottom, 'w3-margin-left':marginLeft}">
            <slot></slot>
        </div>
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
        },
        'color':{
            type:String,
            default:'none'
        }
    },
    template: `
        <div :class="[{'w3-container':true, 'w3-margin-left': marginLeft, 'w3-margin-right':marginRight, 'w3-margin-top':marginTop, 'w3-margin-bottom':marginBottom, 'w3-card':card, 'w3-light-grey':lightGrey}, 'w3-' + color]">
            <slot></slot>
        </div>
    `
});

Vue.component('yuforms-card', {
    props:['shadow'],
    computed: {
        cls: function() {
            return (['2', '4'].indexOf(this.shadow)==-1)?'w3-card':'w3-card-'+this.shadow;
        }
    },
    template: `
        <div :class="cls">
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

Vue.component('yuforms-questions', {
    computed: {
        ...Vuex.mapState([
            'questions'
        ])
    },
    methods: {
        ...Vuex.mapActions([
            'addQuestion'
        ]),
        newQuestion: function() {
            this.addQuestion();
        }
    },
    template: `
        <yuforms-container margin-top>
            <yuforms-question-wrapper v-for="q in questions" :key="q.id" :id="q.id" :deleted="q.deleted" ></yuforms-question-wrapper>
            <yuforms-new-question-button @on-click="newQuestion"></yuforms-new-question-button>
        </yuforms-container>
    `
});

Vue.component('yuforms-new-question-button', {
    template: `
        <yuforms-container :card="true" color="light-grey">
            <div class="w3-center w3-margin-top w3-margin-bottom">
                <button class="w3-button w3-xlarge w3-dark-grey" @click="$emit('on-click')">+</button>
            </div>
        </yuforms-container>
    `
});

Vue.component('yuforms-question-wrapper', {
    props:['id', 'deleted'],
    computed: {
        ...Vuex.mapState([
            'questions',
            'formComponentList',
        ])
    },
    data: function() {
        return {
            selectedValue:"",
            createButtonShow:false,
            createdQuestion: false,
            question: "Yeni Soru"
        }
    },
    methods: {
        ...Vuex.mapActions([
            'createQuestion',
            'deleteQuestion',
            'resetOptions'
        ]),
        onChange: function(e) {
            this.createButtonShow = true;
            this.selectedValue=e.target.value;
            this.resetOptions(this.id);
        },
        saveQuestion: function(e) {
            this.question = e.target.innerText;
        },
        createQuestionLocal: function() {
            this.createdQuestion = true;
            this.createQuestion({
                id:this.id,
                questionText:this.question
            });
        },
        cancelQuestion: function() {
            if(this.questions[this.id].questionText) {
                this.createQuestionLocal();
            } else {
                this.deleteQuestion(this.id);
            }
        },
        deleteQuestionLocal: function() {
            this.deleteQuestion(this.id);
        },
        editQuestion: function() {
            this.createdQuestion = false;
        }
    },
    template: `
        <yuforms-container v-if="deleted==false" margin-bottom :card="true" :light-grey="true">
            <div v-if="createdQuestion==false">
                <yuforms-row>
                    <yuforms-half>
                        <h3 contenteditable @blur="saveQuestion">{{question}}</h3>
                    </yuforms-half>
                    <yuforms-half>
                        <div class="w3-right">
                            <yuforms-button margin-bottom color="deep-orange" name="İptal" @on-click="cancelQuestion"></yuforms-button>
                        </div>
                    </yuforms-half>
                </yuforms-row>
                <yuforms-row>
                    <yuforms-half>
                        <h5>Tür</h5>
                    </yuforms-half>
                    <yuforms-half>
                        <yuforms-right>
                            <select class="w3-select" name="component-type" v-model="selectedValue" >
                                <option value="" disabled selected>-- Lütfen Seçiniz --</option>
                                <option v-for="opt in formComponentList" :key="opt.id" :value="opt.value" @click.prevent="onChange">{{opt.name}}</option>
                            </select>
                        </yuforms-right>
                    </yuforms-half>
                </yuforms-row>
                <!-- here is optional inputs -->
                <div v-if="selectedValue=='input-text'" class="w3-cell-row">
                    <!-- empty -->
                </div>
                <div v-else-if="selectedValue=='input-radio'">
                    <div class="w3-cell-row">
                        <div class="w3-cell">
                            <h6>Seçenekler</h6>
                        </div>
                    </div>
                    <div  class="w3-cell-row">
                        <div class="w3-cell w3-padding-16">
                            <yuforms-new-question-select-option-options :id="id">
                            </yuforms-new-question-select-option-options>
                        </div>
                    </div>
                </div>
                <div v-else-if="selectedValue=='input-select'">
                    <div class="w3-cell-row">
                        <div class="w3-cell">
                            <h6>Seçenekler</h6>
                        </div>
                    </div>
                    <div  class="w3-cell-row">
                        <div class="w3-cell w3-padding-16">
                            <yuforms-new-question-select-option-options :id="id">
                            </yuforms-new-question-select-option-options>
                        </div>
                    </div>
                </div>
                <div v-else class="w3-cell-row"></div>
                <div v-if="createButtonShow" class="w3-cell-row">
                    <div class="w3-cell">
                        <div class="w3-right w3-margin-bottom">
                            <yuforms-button color="green" name="Oluştur" @on-click="createQuestionLocal"></yuforms-button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <yuforms-question
                    :read-only="false"
                    :question="question"
                    @edit-question="editQuestion"
                    @delete-question="deleteQuestionLocal"
                ></yuforms-question>
            </div>
        </yuforms-container>
    `
});

Vue.component('yuforms-question', {
    props: {
        'readOnly': {
            type:Boolean,
            default:true
        },
        question: {
            type:String,
            default:'question'
        }
    },
    template: `
        <div>
            <yuforms-row>
                <yuforms-half>
                    <h3>{{question}}</h3>
                </yuforms-half>
                <yuforms-half v-show="readOnly==false">
                    <yuforms-right>
                        <yuforms-button color="green" name="Düzenle" @on-click="$emit('edit-question')"></yuforms-button>
                        <yuforms-button color="red" name="Sil" @on-click="$emit('delete-question')"></yuforms-button>
                    </yuforms-right>
                </yuforms-half>
            </yuforms-row>
        </div>
    `
});

Vue.component('yuforms-new-question-select-option-options', {
    props: {
        id: {
            type:Number
        }
    },
    computed: {
        ...Vuex.mapState([
            'questions'
        ])
    },
    data: function() {
        return {
            index:0,
            opts: [
                {
                    id:0,
                    placeholder:"Seçenek 1",
                    value:"",
                }
            ],
            used:false
        }
    },
    methods: {
        ...Vuex.mapActions([
            'updateOptions'
        ]),
        input:function(e) {
            this.opts[e.target.name].value=e.target.value;
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
            this.updateOptions({
                id:this.id,
                options:this.opts
            })
        }
    },
    template: `
        <div>
            <input :key="opt.id" :name="opt.id" v-for="opt in this.questions[id].options" class="w3-input" type="text" :value="opt.value" @input.prevent="input" :placeholder="opt.placeholder">
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

Vue.component('yuforms-center', {
    template:`
        <div class="w3-center">
            <slot></slot>
        </div>
    `
});

Vue.component('yuforms-row', {
    template:`
        <div class="w3-row">
            <slot></slot>
        </div>
    `
});

Vue.component('yuforms-half', {
    template:`
        <div class="w3-half">
            <slot></slot>
        </div>
    `
});

Vue.component('yuforms-button', {
    props: {
        name: {
            type:String,
            default:"name"
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
        },
        disabled: {
            type:Boolean,
            default:false
        },
        color: {
            type:String,
            default:"grey"
        }
    },
    template: `
        <button :class="[{'w3-button':true, 'w3-margin-top':marginTop, 'w3-margin-right':marginRight, 'w3-margin-bottom':marginBottom, 'w3-margin-left':marginLeft}, 'w3-'+color]" @click="$emit('on-click')" :disabled="disabled">{{name}}</button>
    `
});

Vue.component('yuforms-alert', {
    props: {
        title: {
            type:String,
            default:"title"
        },
        message: {
            type:String,
            default:"message"
        },
        hidden: {
            type:Boolean,
            default:false
        },
        color: {
            type:String,
            default:"red"
        },
        nonTitle: {
            type:Boolean,
            default:false
        }
    },
    template: `
        <div v-if="hidden==false" :class="['w3-panel', 'w3-'+color]">
          <h3 v-if="nonTitle==false">{{title}}</h3>
          <p>{{message}}</p>
        </div>  
    `
});

/*
new Vue({
    el:'#app',
    data: {
        info:"vue is here"
    }
});
*/
