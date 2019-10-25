

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