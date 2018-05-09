function fadeMessage() {
    $("#message").fadeOut('slow');
}

function focusField(field) {
    document.getElementById(field).style.backgroundColor = '#F7F7F7';
}

function sendData(data, url) {
    $.ajax({
        data: data,
        type: 'post',
        url: url,
        success: function (response) {
            $('#response').html(response);
        }
    });
}

function sendDataDiv(data, url, div) {
    $.ajax({
        data: data,
        type: 'post',
        url: url,
        success: function (response) {
            $(div).html(response);
        }
    });
}

function sendDataDelete(id, message) {
    $.ajax({
        data: {
            "id" : id,
            "func" : "delete"
        },
        type: 'post',
        url: 'controller/',
        success: function (response) {
            if (response === '1') {
                $('#row_'+id).remove();
                $('#detail_'+id).remove();
                swal('Eliminado', message, 'success');
            } else {
                swal('Error', 'No se ha podido eliminar el registro.', 'error');
            }
        }
    });
}

function generateTable() {
    sendData({
        "search" : $('#search').val(),
        "func" : "table"
    }, 'controller/');
}

function showDetail(id, field, event) {
    event.preventDefault();
    sendDataDiv({
            "id" : id,
            "func" : "detail"
        }, 'controller/',
        field);
    document.getElementById("detail_button_"+id)
        .setAttribute('onclick', 'hideDetail("'+id+'","#detail_'+id+'", event)');
    document.getElementById("image_"+id)
        .setAttribute('src', '../assets/img/minus.png');
}

function hideDetail(id, field, event) {
    event.preventDefault();
    $(field).html("");
    document.getElementById("detail_button_"+id)
        .setAttribute('onclick', 'showDetail("'+id+'", "#detail_'+id+'", event)');
    document.getElementById("image_"+id)
        .setAttribute('src', '../assets/img/more.png');
}

function confirmDelete(name, id, object) {
    swal({
        title: '¿Desea eliminar el '+object+'?',
        text: "Está a punto de eliminar "+ name,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar'
    }).then(function (result) {
        console.log(result.value);
        if (result.value) {
            sendDataDelete(id, object.charAt(0).toUpperCase() + object.slice(1)+' eliminado correctamente.',
                'No se ha podido eliminar el '+object+' correctamente.');
        }
    });
}

function login(event) {
    event.preventDefault();
    sendData({
        "user" : $("#user").val(),
        "pass" : $("#pass").val(),
        "func" : "signin"
    }, 'controller/');
}

function emptyForm() {
    $("#response").html('' +
        '<div id="message" class="alert alert-danger">\n' +
        '<a href="#" onclick="fadeMessage()" class="close" title="close">×</a>\n' +
        '<span>Ha dejado campos vacíos</span>\n' +
        '</div>');
}