class Carrinho
{
    constructor()
    {
        this._routeDelete = "/remover-item-carrinho";
        this._routeList = "/listar-itens-carrinho";
        this._carrinhoContainerEl = $("#carrinhos-itens");
        this.initEvents();
    } 
    
    initEvents()
    {
        let _self = this;
        $('.btn-delete').unbind('click')
        $('.btn-delete').click(function(){
            let btnEl = $(this);
            _self.delete(btnEl);
        });
    }
    
    delete(btnEl)
    {
        let _self = this;
        let callback = function(){       
            let params = { productId : btnEl.data('id') };
            $.post(_self._routeDelete, params, function(data){
                console.log(data)
                if (data.success){
                    _self.toList();
                } else {
                    alertError({ text: data.text , msg: data.msg });
                }
            });
        }

        alertConfirm(
            'Deseja remover esse produto do carrinho?',
            'Essa ação não podera ser desfeita.',
            callback
        );
    }

    toList()
    {
        let _self = this;
        $.post(_self._routeList, function(data){
            _self._carrinhoContainerEl.html(data);
            _self.initEvents();
        });
    }
}

window.carrinho = new Carrinho();