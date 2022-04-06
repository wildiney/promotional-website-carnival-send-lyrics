$(document).ready(function () {
    console.log("ready");
    // LOGIN PAGE
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus();
    });

    // FORM ENREDO
    $('#data-de-nascimento').mask('00/00/0000');

    // FORM LOGIN
    $("#form_login").submit(function () {
        if ($("#data-de-nascimento").val() === "" || $("#matricula").val() === "") {
            alert("Preencha todos os campos!")
            return false;
        } else {
            return true;
        }
    });

    // Input File
    $("#file").change(function () {
        $("#inputFileName").val($("#file").val());
    });

    $("#inputFileName").click(function () {
        $("#file").trigger('click');
    });

    $('[data-toggle="popover"]').popover({html: true})

});