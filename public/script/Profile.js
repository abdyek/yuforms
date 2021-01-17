new Vue({
    el:'#app',
    data: {
        newEmail:"",
        passwordToChangeEmail:"",
        newPassword:"",
        newPasswordAgain:"",
        passwordToChangePassword:"",
        changeEmailButtonDisabled:true,
        changePasswordButtonDisabled:true,
        passwordConsistent:true,
        passwordLengthOK:true,
        responseVisible:false,
        responseTitle:"",
        responseMessage:"",
        responseColor:"",
    },
    beforeCreate: function() {
        let hash = getCookie('user');
        if(hash) {
            this.userInfo = objectFromBase64(hash);
        }
    },
    computed: {
        userEmail: function() {
            return this.userInfo['email'];
        },
        userName: function() {
            return this.userInfo['firstName'] + " " + this.userInfo['lastName'];
        }
    },
    methods: {
        changeEmail: function() {
            this.changeEmailButtonDisabled = true;
            fetch('api/changeMyEmail', {
                method: 'PATCH',
                header: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    password: this.passwordToChangeEmail,
                    newEmail: this.newEmail
                })
            }).then((response)=>{
                if(!response.ok) throw new Error(response.status);
                else return response.json();
            }).then((json)=>{
                // changing cookie and userEmail
                let hash = getCookie('user');
                let userInfo = objectFromBase64(hash);
                userInfo['email'] = this.newEmail;
                hash = base64FromObject(userInfo);
                setCookie('user', hash);
                /* !!! */
                this.userEmail = this.newEmail; // doesn't change
                /* !!! */
                // ^ changing cookie and userEmail
                this.changeEmailButtonDisabled = false;
                this.response('Başarılı', 'Başarılı bir şekilde e-postanız değiştirildi. Lütfen yeni e-postanızı doğrulayın!', 'green');
            }).catch((error)=>{
                if(error.message==401) {
                    this.changeEmailButtonDisabled = false;
                    this.response('Başarısız', 'Yanlış parola girdiniz', 'red');
                } else if(error.message=403) {
                    this.changeEmailButtonDisabled = false;
                    this.response('Başarısız', 'Bunun için yetkiye sahip değilsiniz!', 'red');
                    setTimeout(()=>{
                        changePage('/');
                    }, 1000);
                } else if(error.message==422) {
                    this.changeEmailButtonDisabled = false;
                    this.response('Başarısız', 'Bu mail kullanımda!', 'deep-orange');
                }
            });
        },
        changePassword: function() {
            this.changePasswordButtonDisabled = true;
            fetch('api/changeMyPassword', {
                method: 'PATCH',
                header: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    password: this.passwordToChangePassword,
                    newPassword: this.newPassword
                })
            }).then((response)=>{
                if(!response.ok) throw new Error(response.status);
                else return response.json();
            }).then((json)=>{
                this.response('Başarılı', 'Başarılı bir şekilde parolanız değiştirildi', 'green');
                this.changePasswordButtonDisabled = false;
            }).catch((error)=>{
                if(error.message==401) {
                    this.changePasswordButtonDisabled = false;
                    this.response('Başarısız', 'Yanlış parola girdiniz', 'red');
                } else if(error.message=403) {
                    this.changePasswordButtonDisabled = false;
                    this.response('Başarısız', 'Bunun için yetkiye sahip değilsiniz!', 'red');
                    setTimeout(()=>{
                        changePage('/');
                    }, 1000);
                }
            });
        },
        inputNewEmail: function(e) {
            this.newEmail = e.target.value;
            this.checkToEmail();
        },
        inputPasswordToChangeEmail: function(e) {
            this.passwordToChangeEmail = e.target.value;
            this.checkToEmail();
        },
        inputNewPassword: function(e) {
            this.newPassword = e.target.value;
            this.checkToPassword();
            this.checkPasswordConsistent();
        },
        inputNewPasswordAgain: function(e) {
            this.newPasswordAgain = e.target.value;
            this.checkToPassword();
            this.checkPasswordConsistent();
        },
        inputPassword: function(e) {
            this.passwordToChangePassword = e.target.value;
            this.checkToPassword();
        },
        checkToEmail: function() {
            const pwLen = this.passwordToChangeEmail.length;
            this.changeEmailButtonDisabled = (validateEmail(this.newEmail) && pwLen>=10 && pwLen<=50 && this.userEmail!=this.newEmail)?false:true;
        },
        checkToPassword: function() {
            const newPwLen = this.newPassword.length;
            const newPwAgLen = this.newPasswordAgain.length;
            const pwLen = this.passwordToChangePassword.length;
            const condition = (newPwLen>=10 && newPwLen<=50 && newPwAgLen>=10 && newPwAgLen<=50 && pwLen>=10 && pwLen<=50);
            this.changePasswordButtonDisabled = (condition)?false:true;
            this.passwordLengthOK = (condition);
        },
        checkPasswordConsistent: function() {
            this.passwordConsistent = (this.newPassword==this.newPasswordAgain);
        },
        response: function(title, message, color) {
            this.responseTitle = title;
            this.responseMessage = message;
            this.responseColor = color;
            this.responseVisible = true;
        },
        hideReponse: function() {
            this.responseVisible = false;
        }
    }
});
