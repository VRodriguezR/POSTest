// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "dom":
						"<'row'" +
						"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
						"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
						">" +

						"<'table-responsive'tr>" +

						"<'row'" +
						"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
						"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
						">",
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "Nada encontrado - disculpe",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "Ningun registro disponible",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "search": "Buscar:",
        "paginate": {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": {
            "sortAscending": ": activar para ordenar a coluna en orden ascendente",
            "sortDescending": ": activar para ordenar a coluna en orden descendente"},
        }
  });
});
