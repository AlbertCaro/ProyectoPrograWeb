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

function sendDataDelete(data, message, error, interactor) {
    $.ajax({
        data: data,
        type: 'post',
        url: '../interactors/'+interactor+'/delete.php',
        success: function (response) {
            if (response === '1') {
                swal('Eliminado', message, 'success').then(function (value) {
                    generateTable(interactor);
                });
            } else {
                swal('Error', error, 'error').then(function (value) {
                    generateTable(interactor);
                });
            }
        }
    });
}

function generateTable(interactor) {
    sendData({
        "search" : $('#search').val()
    }, '../interactors/'+interactor+'/table.php');
}

function showDetail(id, field, event, interactor) {
    event.preventDefault();
    sendDataDiv({
            id : id
        }, '../interactors/'+interactor+'/detail.php',
        field);
    document.getElementById("detail_button_"+id)
        .setAttribute('onclick', 'hideDetail("'+id+'","#detail_'+id+'", event, "'+interactor+'")');
    document.getElementById("image_"+id)
        .setAttribute('src', '../assets/img/minus.png');
}

function hideDetail(id, field, event, interactor) {
    event.preventDefault();
    $(field).html("");
    document.getElementById("detail_button_"+id)
        .setAttribute('onclick', 'showDetail("'+id+'", "#detail_'+id+'", event, "'+interactor+'")');
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
            sendDataDelete({
                    "id": id
                }, object.charAt(0).toUpperCase() + object.slice(1)+' eliminado correctamente.',
                'No se ha podido eliminar el '+object+' correctamente.',
                interactor)
        }
    });
}