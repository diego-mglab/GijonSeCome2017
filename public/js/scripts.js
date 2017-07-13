/**
 * Created by Diego on 13/07/2017.
 */

/* Configuración de la tabla de los listados */

$(function () {
    $('#list').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "stateSave": true,
        "responsive": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });
});
