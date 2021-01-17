Vue.component('yuforms-login', {
    template: `
        <div id="yuforms-login" class="w3-card-4 w3-auto">
            <slot></slot>
        </div>
    `
});

new Vue({
    el:'#app',
    data: {
        email:"",
        password:"",
        inputDisabled:false,
        loginButtonDisabled:true,
        alertHidden:true,
        alertTitle:"",
        alertMessage:"",
        alertColor:""
    },
    methods: {
        login: function() {
            this.inputDisabled = this.loginButtonDisabled = true;
            fetch('api/login', {
                method: 'POST',
                header: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: this.email,
                    password:this.password
                })
            }).then((response)=>{
                if(!response.ok) throw new Error(response.status);
                else return response.json();
            }).then((json)=>{
                this.inputDisabled = this.loginButtonDisabled = false;
                this.alertColor = "green";
                this.alertHidden = false;
                this.alertTitle="Giriş Başarılı";
                this.alertMessage="Ana sayfaya yönlendirileceksiniz";
                delete json['state'];
                delete json['jwt'];
                let hash = base64FromObject(json);
                setCookie('user', hash);
                setTimeout(function() {
                    changePage('/');
                },1500);
            }).catch((error)=>{
                if(error.message==401) {
                    this.inputDisabled = this.loginButtonDisabled = false;
                    this.alertColor = "red";
                    this.alertHidden = false;
                    this.alertTitle="Giriş Başarısız";
                    this.alertMessage="E-posta - Parola uyumsuz";
                } else if(error.message==403) {
                    this.inputDisabled = this.loginButtonDisabled = false;
                    this.alertColor = "red";
                    this.alertHidden = false;
                    this.alertTitle="403";
                    this.alertMessage="Hali hazırda giriş yapılmış";
                    setTimeout(function() {
                        changePage('/profil');
                    },1500);
                }
            });
        },
        checkInput: function() {
            let passwordLen = this.password.length;
            this.loginButtonDisabled = (passwordLen>=10 && passwordLen<=50 && validateEmail(this.email))?false:true;
        },
        changeEmail: function(e) {
            this.email = e.target.value;
            this.checkInput();
        },
        changePassword: function(e) {
            this.password = e.target.value;
            this.checkInput();
        }
    }
});
