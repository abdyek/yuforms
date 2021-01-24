Vue.component('yuforms-confirm-email', {
    template: `
        <div id="yuforms-confirm-email" class="w3-card-4 w3-auto">
            <slot></slot>
        </div>
    `
});
new Vue({
    el:'#app',
    data: {
        email:"",
        code:"",
        emailAlertHidden:true,
        codeAlertHidden:true,
        buttonDisabled:true,
        responseHidden:true,
        responseTitle:"",
        responseMessage:"",
        responseColor:""
    },
    methods: {
        inputEmail: function(e) {
            this.email = e.target.value;
            this.emailAlertHidden = validateEmail(this.email);
            this.checkAlertToButton();
        },
        inputCode: function(e) {
            this.code = e.target.value;
            this.codeAlertHidden = (this.code.length<=6 && !isNaN(this.code));
            this.checkAlertToButton();
        },
        checkAlertToButton: function() {
            this.buttonDisabled = (this.emailAlertHidden && this.codeAlertHidden &&this.email.length && this.code.length==6)?false:true;
        },
        setResponse: function(title, message, color) {
            this.responseTitle = title;
            this.responseMessage = message;
            this.responseColor = color;
            this.responseHidden = false;
        },
        setResponseHidden: function(hidden) {
            this.responseHidden = hidden;
        },
        confirmEmail: function() {
            this.buttonDisabled = true;
            fetch('api/confirmEmail', {
                method: 'POST',
                header: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: this.email,
                    code: this.code
                })
            }).then((response)=>{
                if(!response.ok) throw new Error(response.status);
                else return response.json();
            }).then((json)=>{
                this.setResponse('Başarılı', 'Başarılı bir şekilde e-postanız doğrulandı. Giriş yapabilirsiniz.', 'green');
            }).catch((error)=>{
                if(error.message==404) {
                    this.setResponse('Başarısız', 'Doğrulanması gereken böyle bir e-posta yok. Daha önce doğrulanmış olabilir ya da bu e-posta ile daha önce kayıt yapılmamış olabilir.', 'red');
                } else if(error.message==401) {
                    this.setResponse('Başarısız', 'Yanlış aktivasyon kodu', 'red');
                }
            });
        }
    }
});
