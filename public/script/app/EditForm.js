new Vue({
    el:'#app',
    created: function() {
        this.loadFormAPI();
    },
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
            'loadFormAPI'
        ])
    },
    store
});
