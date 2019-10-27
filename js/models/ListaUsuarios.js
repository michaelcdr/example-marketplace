class ListaUsuarios
{
    constructor()
    {
        this.initEvents();
        this._routeDelete = '/admin/deletar-usuario';
        this._routeList = '/admin/lista-usuarios-table'
    }

    initEvents()
    {
        let _self = this;
        $('.btn-delete').unbind('click')
        $('.btn-delete').click(function(){
            let btnEl = $(this);
            _self.delete(btnEl);
        });

        $('#btn-pesquisar').unbind('click')
        $('#btn-pesquisar').click(function(){
            let search = $("#search-users").val();
            _self.toList(search);
        });

        $("#search-users").unbind('keyup')
        $("#search-users").keyup(function(ev){
            if (ev.which === 13)
                _self.toList($("#search-users").val());
        });
    }

    delete(btnEl)
    {
        //exibindo msg amigavel ao usuario e quando ele confirmar volta para index
        let _self = this;
        let callback = function(){       
            let params = { id : btnEl.data('id') };
            $.post(_self._routeDelete, params, function(data){
                if (data.success){
                    _self.toList(1,$("#search-users").val());
                } else {
                    alertError({ text: data.text , msg: data.msg });
                }
            });
        }
        alertConfirm('Deseja remover esse usuário?','Essa ação não podera ser desfeita.',callback);
    }

    toList(search)
    {
        let params = { page : 1, s : search };
        let _self = this;
        $.post(_self._routeList, params, function(data){
            
            $('#tb-users').html(data);
            _self.initEvents();
        });
    }
}

window.listaUsuarios = new ListaUsuarios();