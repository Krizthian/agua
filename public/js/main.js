$(document).ready(function() {
                      $.fn.dataTable.ext.errMode = 'none';
                      $('#tabla').DataTable({
                          dom: 'Bfrtip',
                          searching: false, // Oculta la barra de búsqueda
                          info: false, // Oculta la información de paginación
                          paginate: false, // Oculta la información de paginación
                          language: {
                              "emptyTable": "No hay datos disponibles",
                              "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                              "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                              "infoFiltered": "(filtrado de _MAX_ entradas totales)",
                              "lengthMenu": "Mostrar _MENU_ entradas",

                          },
                                      initComplete: function () {
                                     $('.dt-buttons').addClass('float-end mb-3'); // Agrega la clase float-end al contenedor de botones
                          },
                          buttons: [
                              {
                                  extend: 'pdfHtml5',
                                  className: 'btn btn-danger',
                                  text: '<i class="fas fa-file-pdf"></i>',
                                  titleAttr: 'Exportar a PDF'

                              },
                              {
                                  extend: 'excelHtml5',
                                  className: 'btn btn-success',
                                  text: '<i class="fas fa-file-excel"></i>',
                                  titleAttr: 'Exportar a Excel'

                              },
                              {
                                  extend: 'print',
                                  className: 'btn btn-info',
                                  text: '<i class="fas fa-print"></i>',
                                  titleAttr: 'Imprimir'

                              },                              
                          ]
                      });
});