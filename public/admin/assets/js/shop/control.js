function alertError(message){
    swal({
        type: 'error',
        title: 'Sorry!',
        text: message,
        padding: '2em'
    });
}

function alertSuccess(title, message){
    swal({
        title: title,
        text: message,
        type: "success",
        padding: "2em"
    });
}

function alertHtml(title, html){
    swal({
        title: "<u>" + title + "</u>",
        type: 'info',
        html: html,
        showCloseButton: true,
        focusConfirm: false,
        confirmButtonText:
          "OK",
        padding: "2em"
      })
}

function alertRevert(desiredAction){
    swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Confirm",
        padding: "2em"
    }).then(function(result) {
        if (result.value) {
            desiredAction();
        }
    });
}

async function alertLoader(){
    swal({
        title: "System",
        text: "Processing",
        padding: "2em",
        allowOutsideClick: false,
        onOpen: function () {
          swal.showLoading();
        }
    });
}

