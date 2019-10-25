class LoginUsuario
{
    constructor(){
        this._formEl = $('form#form-login');
        this._loginEl = $("#login");
        this._passwordEl = $("#password");
        this.initEvents();
    }

    initEvents(){
        let _self = this;
        _self._formEl.submit(function(){
            
            // if (_self.validate()){
            //     
            // } 
            let objValidate = _self.validate();
            console.log('validate: ' + objValidate.isValid);
            return false;
        });
    }

    validate(){
        let _self = this;
        let isValid = true;
        $('input[required]').each((index,el) => {
            if ($(el).val() === ''){
                $(el).addClass('is-invalid');
                isValid = false;
            }
        });
        return { isValid };
    }

    getModelData(){
        let _self = this;
        return {
            login : _self._loginEl.val(),
            password: _self._passwordEl.val()
        };
    }

    login(){
        $.post('/login-post', this.getModelData(), function(data){
            if (data.Sucesso){
               
            } else{
                alertError({text: data.msg });
            }
        });
        return false;
    }
}