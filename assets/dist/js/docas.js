$(document).ready(function () {

    var base_url = document.getElementById("base_url").value;

    $('#docasTable').DataTable({

        "sScrollX": true,
        "scrollCollapse": true,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Mostrar _MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar por código",

            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            }
        },
        "processing": true,
        "serverSide": true,
        "order": [], //Initial no order.
        // "pagelenth"
        "ajax": {
            "type": "POST",
            "url": base_url + "doca/ajax_list_docas"
        }

    })








});