Vue.component('yuforms-form-title', {
    props: {
        editable: {
            type:Boolean,
            default:false
        }
    },
    computed: {
        ...Vuex.mapState([
            'formTitle'
        ]),
    },
    methods: {
        ...Vuex.mapActions([
            'setFormTitle'
        ]),
        changeTitle: function(e) {
            this.setFormTitle(e.target.innerText);
        }
    },
    template: `
        <h1 :contenteditable="editable" @blur="changeTitle">
            {{formTitle}}
        </h1>
    `
});

Vue.component('yuforms-example', {
    computed: {
        ...Vuex.mapState([
            'questions'
        ])
    },
    template: `
        <div>
            <div v-for="q in questions" :key="q.id">
                {{q.id}} - {{q.questionText}}
            </div>
        </div>
    `
});

new Vue({
    el:'#app',
    store
});
