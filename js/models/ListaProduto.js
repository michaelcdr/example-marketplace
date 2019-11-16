class ListaProduto
{
    constructor()
    {
        this.initEvents();
        this._routeDelete = '/admin/produtos/deletar';
        this._routeList = '/admin/produtos/lista-partial'
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
            let search = $("#search-products").val();
            _self.toList(search);
        });

        $("#search-products").unbind('keyup')
        $("#search-products").keyup(function(ev){
            if (ev.which === 13)
                _self.toList($("#search-products").val());
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
                    _self.toList(1,$("#search-products").val());
                } else {
                    alertError({ text: data.text , msg: data.msg });
                }
            });
        }
        alertConfirm('Deseja remover esse produto?','Essa ação não podera ser desfeita.',callback);
    }

    toList(search)
    {
        let params = { page : 1, s : search };
        let _self = this;
        $.post(_self._routeList, params, function(data){
            
            $('#container-products').html(data);
            _self.initEvents();
        });
    }
}

window.listaProduto = new ListaProduto();