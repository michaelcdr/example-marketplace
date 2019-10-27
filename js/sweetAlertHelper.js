

window.alertSuccess = function(dataObj){
    Swal.fire({
        type: 'success',
        title: dataObj.title,
        text: dataObj.text
    });
}

window.alertError = function(dataObj){
    Swal.fire({
        title: 'Ops, algo deu errado',
        type: 'error',
        text: dataObj.text
    });
}

window.alertServerError = function(){
    Swal.fire({
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