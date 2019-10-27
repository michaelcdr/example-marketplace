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
        _self._formEl.submit(() => {
            _self.login();
            return false;
        });
    }

    validate(){
        let isValid = true;
        $('input[required]').each((index,el) => {
            if ($(el).val() === ''){
                $(el).addClass('is-invalid');
                isValid = false;
            }
        });
        return isValid;
    }

    getModelData()
    {
        let _self = this;
        return {
            isValid : _self.validate(),
            model : {
                login : _self._loginEl.val(),
                password: _self._passwordEl.val()
            }
        };
    }

    login()
    {
        let _self = this;
        let objModel = _self.getModelData();
        let btn =_self._formEl.find('button');
        if (objModel.isValid){
            btn.button('loading');
            $.post('/autenticar', objModel.model, function(data){
                if (data.success){
                    document.location = "/";
                } else {
                    alertError({ text: data.msg });
                    btn.button('reset');
                }
            }).fail(() => {
                alertServerError();
                btn.button('reset');
            });
        }
        return false;
    }
}