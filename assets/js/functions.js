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
            console.log(div);
            $(div).html(response);
        }
    });
}

function sendDataDelete(id, message, error) {
    $.ajax({
        data: {
            "id" : id,
            "func" : "delete"
        },
        type: 'post',
        url: 'controller/',
        success: function (response) {
            if (response === '1') {
                swal('Eliminado', message, 'success').then(function (value) {
                    $('row_'+id).remove();
                });
            } else {
                swal('Error', error, 'error').then(function (value) {
                    $('row_'+id).remove();
                });
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

function hideDetail(id, field, event, interactor) {
    event.preventDefault();
    $(field).html("");
    document.getElementById("detail_button_"+id)
        .setAttribute('onclick', 'showDetail("'+id+'", "#detail_'+id+'", event)');
    document.getElementById("image_"+id)
        .setAttribute('src', '../assets/img/more.png');
}

function confirmDelete(name, id, object, interactor) {
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
                'No se ha podido eliminar el '+object+' correctamente.',
                interactor)
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