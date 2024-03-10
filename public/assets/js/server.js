function sweet(title, text, icon) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        customClass: {
            confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
    });
}

function toast(type, msg) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "backgroundColour": "#000000"
    }

    toastr[type](msg, '', {
        closeButton: true,
        tapToDismiss: false,
        progressBar: true
    });
}