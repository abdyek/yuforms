Vue.component('info', {
    data: function() {
        return {
            title:"Yuforms"
        }
    },
    template: `
        <div>{{title}}</div>
    `
});

new Vue({
    el:'#app'
});

