new Vue({
    el:'#app',
    beforeCreate: function() {
        const url = new URL(window.location.href);
        this.formSlug = url.searchParams.get('slug');
        fetch('api/form/?'+generateUrlPar({
            'id':this.formSlug
        }), {
            method: 'GET',
            header: {
                'Content-Type': 'application/json'
            }
        }).then((response)=>{
            if(!response.ok) throw new Error(response.status);
            else return response.json();
        }).then((json)=>{
            console.log(json);
        }).catch((error)=>{

        });
    },
    created: function() {
        this.setFormTitle(this.formSlug);
    },
    computed: {
        ...Vuex.mapState([
            'formTitle'
        ])
    },
    methods: {
        ...Vuex.mapActions([
            'setFormTitle'
        ])
    },
    store
});
