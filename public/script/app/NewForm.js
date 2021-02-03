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

new Vue({
    el:'#app',
    computed: {
        ...Vuex.mapState([
            'sent',
            'formResponseTitle',
            'formResponseMessage',
            'formResponseColor',
            'responseSuccessful'
        ])
    },
    methods: {
        ...Vuex.mapActions([
            'goEditForm',
            'goShareForm'
        ])
    },
    store
});
