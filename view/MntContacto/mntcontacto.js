var tabla;

function init(){
    $("#contacto_form").on("submit",function(e){
        guardaryeditar(e);
    });

}
$(document).ready(function(){


    tabla=$('#contacto_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
        ],
    "ajax":{
        url: '../../controller/contacto.php?op=listar',
        type : "get",
        dataType : "json",
        error: function(e){
            console.log(e.responseText);

        }
    },
    "bDestroy": true,
    "responsive": true,
    "bInfo": true,
    "iDisplayLength": 10,
    "order":[[0, "asc" ]],
    "languaje": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
    }).DataTable();
});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#contacto_form")[0]);

    $.ajax({
        url: "../../controller/contacto.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            console.log(datos);
            $('#contacto_form')[0].reset();
            $("#modalmantenimiento").modal('hide');
            $('#contacto_data').DataTable().ajax.reload();

            swal.fire(
                'Registro!',
                'Se registro correctamente.',
                'success'
            )
        }
    });

}

function editar(id){
    console.log(id)

}

function eliminar(id){
    swal.fire({
        title: 'Agenda',
        text: "¿Desea Eliminar el Contacto?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../../controller/contacto.php?op=eliminar", {id:id},function (data){

            });
            $('#contacto_data').DataTable().ajax.reload();

            swal.fire(
                'Eliminado!',
                'El registro se eliminó correctamente.',
                'success'
            )
        }
    })

}

$(document).on("click","#btnnuevo",function(){
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
});
init();
