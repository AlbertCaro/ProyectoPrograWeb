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

function sendDataDelete(data, url, message, error) {
    $.ajax({
        data: data,
        type: 'post',
        url: url,
        success: function (response) {
            if (response === '1') {
                swal('Eliminado', message, 'success').then(function (value) {
                    generateTable();
                });
            } else {
                swal('Error', error, 'error').then(function (value) {
                    generateTable();
                });
            }
        }
    });
}