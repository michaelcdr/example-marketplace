

window.alertSuccess = function(dataObj){
    let opts ={
        type:"success",
        toast: true,
        position: 'top-start',
        timer: 3000,
        showConfirmButton: false
    }
    $.extend(opts, dataObj);
    Swal.fire(opts);
}

window.alertError = function(dataObj){
    let opts = {
        title: 'Ops, algo deu errado',
        type: 'error',
        position: 'top-start',
        showConfirmButton: false
    };
    $.extend(opts, dataObj);
    
    Swal.fire(opts);
}

window.alertServerError = function(){
    Swal.fire({
        toast: true,
        title: 'Ops, algo deu errado',
        text: 'Ocorreu um erro interno em nossos servidores, tente novamente mais tarde.',
        type: 'error'
    });
}

window.alertConfirm = function(title, text, callback){
    Swal.fire({
        title: title,
        text: text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim'
    }).then((result) => {
        if (result.value){
            callback();
        }
    });
}
  
 