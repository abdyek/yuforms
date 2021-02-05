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
