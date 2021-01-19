Vue.component('yuforms-signup', {
    template: `
        <div id="yuforms-signup" class="w3-auto">
            <slot></slot>
        </div>
    `
});

new Vue({
    el: '#app',
    data: {
        email:"",
        firstName:"",
        lastName:"",
        password:"",
        passwordAgain:"",
        emailAlertHidden:true,
        firstNameAlertHidden:true,
        lastNameAlertHidden:true,
        passwordAlertHidden:true,
        passwordAgainAlertHidden:true,
        buttonDisabled:true,
        responseHidden:true,
        responseColor:"",
        responseTitle:"",
        responseMessage:""
    },
    methods: {
        inputEmail: function(e) {
            this.email = e.target.value;
            this.emailAlertHidden = (validateEmail(this.email));
            this.checkAlertsToButton();
        },
        inputFirstName: function(e) {
            this.firstName = e.target.value.trim();
            let len = this.firstName.length;
            this.firstNameAlertHidden = (len>=1 && len<=50);
            this.checkAlertsToButton();
        },
        inputLastName: function(e) {
            this.lastName = e.target.value.trim();
            let len = this.lastName.length;
            this.lastNameAlertHidden = (len>=1 && len<=50);
            this.checkAlertsToButton();
        },
        inputPassword: function(e) {
            this.password = e.target.value;
            let len = this.password.length;
            this.passwordAlertHidden = (len>=10 && len<=50);
            this.checkAlertsToButton();
        },
        inputPasswordAgain: function(e) {
            this.passwordAgain = e.target.value;
            this.passwordAgainAlertHidden = (this.password==this.passwordAgain);
            this.checkAlertsToButton();
        },
        checkAlertsToButton: function() {
            this.buttonDisabled = (this.emailAlertHidden && this.firstNameAlertHidden && this.lastNameAlertHidden && this.passwordAlertHidden && this.passwordAgainAlertHidden && this.passwordAgain.length && this.email.length && this.firstName.length && this.lastName.length)?false:true;
        },
        signup: function() {
            this.buttonDisabled = true;
            fetch('api/signUp', {
                method: 'POST',
                header: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: this.email,
                    firstName: this.firstName,
                    lastName: this.lastName,
                    password: this.password
                })
            }).then((response)=>{
                if(!response.ok) throw new Error(response.status);
                else return response.json();
            }).then((json)=>{
                if(json.state) {
                    this.success();
                } else if(json.error=="available email") {
                    this.availableEmailErr();
                }
            }).catch((error)=>{
                if(error.message==400) {
                    this.responseTitle = "Başarısız";
                    this.responseMessage = "Geçersiz istek";
                    this.responseColor="red";
                    this.responseHidden = false;
                } else if(error.message==403) {
                    this.responseTitle = "Başarısız";
                    this.responseMessage = "Böyle bir yetkiye sahip değilsiniz";
                    this.responseColor="red";
                    this.responseHidden = false;
                    this.redirect('/');
                }
            });
        },
        success: function() {
            this.responseTitle="Başarılı";
            this.responseMessage="Başarılı bir şekilde kayıt oldunuz.";
            this.responseColor="green";
            this.responseHidden=false;
        },
        availableEmailErr: function() {
            this.responseTitle="Başarısız";
            this.responseMessage="Bu e-posta ile hali hazırda kayıt olunmuş.";
            this.responseColor="red";
            this.responseHidden=false;
        },
        redirect: function(page) {
            setTimeout(()=>{
                changePage(page);
            },2000);
        }
    }
});
