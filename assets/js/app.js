//Notificacion en Pantalla
function mostrarNotificacion(mensaje, clase) {

    const notificacion = document.createElement('div');
    notificacion.classList.add(clase, 'notificacion', 'sombra');
    notificacion.textContent = mensaje;


    //Formulario
    //Parametros: insertBefore(Lo que quieres insertar, y antes del donde ).
    formulario.insertBefore(notificacion, document.querySelector('lista-cursos'));

    //Ocultar y Mostrar la notificacion
    setTimeout(() => {
        notificacion.classList.add('visible');
        setTimeout(() => {
            notificacion.classList.remove('visible');
            setTimeout(() => {
                notificacion.remove();
            }, 500);
        }, 3000);
    }, 100);
}
//Solo en Categoria. Colocar el texto del select seleccionado en el textbox de la categoria.
// if (document.querySelector("#inputSelect")) {
//     var opcionElegida = document.querySelector("#inputSelect");
//     var nombre = document.querySelector("#nombre");
//     opcionElegida.addEventListener('change', () => {
//         var selected = opcionElegida.options[opcionElegida.selectedIndex].text;
//         nombre.value = selected;
//     });
// }


$(document).ready(function() {
    $('#guardar-registro').on('submit', function(e) {
        e.preventDefault();
        var datos = $(this).serializeArray();
        var tipoDeAccion = "";
        var primerTexto = "";
        var segundoTexto = "";
        var tercerTexto = "";
        console.log(datos);
        Swal.fire({
            title: '¿Estás seguro/a?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            //Si se oprimio "Si, eliminar" entonces:
            if ((result.value)) {
                $.ajax({
                    //Todos estos keys son de ajax en jquery (type, data, url)
                    type: $(this).attr('method'),
                    data: datos,
                    url: $(this).attr('action'),
                    dataType: 'json',
                    success: function(data) {
                        //console.log('Succes: ' + data);
                        var resultado = data;
                        console.log(data);
                        if (resultado.respuesta == 'exito') {
                            Swal.fire(
                                '¡Correcto!',
                                '¡Se creó correctamente!',
                                'success'
                            );
                            setTimeout(() => {
                                window.location.href = 'dashboard.php';
                            }, 2000);
                        } else if (resultado.respuesta == 'editado') {
                            Swal.fire(
                                '¡Correcto!',
                                '¡Se editó correctamente!',
                                'success'
                            );
                            setTimeout(() => {
                                window.location.href = 'dashboard.php';
                            }, 2000);
                        } else if (resultado.respuesta == 'evento-creado-exitosamente') {
                            Swal.fire(
                                '¡Correcto!',
                                '¡El evento se creó correctamente!',
                                'success'
                            )

                        } else if (resultado.respuesta == 'evento-editado') {
                            Swal.fire(
                                '¡Correcto!',
                                '¡El evento se editó correctamente!',
                                'success'
                            )

                        } else if (resultado.respuesta == 'categoria-creada-exitosamente') {
                            Swal.fire(
                                '¡Correcto!',
                                '¡La categoría se creó correctamente!',
                                'success'
                            )
                        } else if (resultado.respuesta == 'categoria-editada') {
                            Swal.fire(
                                '¡Correcto!',
                                '¡La categoría se edito correctamente!',
                                'success'
                            )
                        } else if (resultado.respuesta == 'registrado-creado-exitosamente') {
                            Swal.fire(
                                '¡Correcto!',
                                '¡El registrado se creó correctamente!',
                                'success'
                            )
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: '¡Error!',
                                text: '¡Algo salió mal. Por favor vuelve a intentarlo!'
                            })
                        }
                    },
                    error: console.log('Error')
                });
            } //.then((result))
        })
    }); // $('#guardar-registro')

    /*Se ejecuta cuando hay un archivo */
    $('#guardar-registro-archivo').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this);
        console.log(datos);

        Swal.fire({
            title: '¿Estás seguro/a?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí ',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            //Si se oprimio "Si, eliminar" entonces:
            if ((result.value)) {
                $.ajax({
                    //Todos estos keys son de ajax en jquery (type, data, url)
                    type: $(this).attr('method'),
                    data: datos,
                    url: $(this).attr('action'),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    async: true,
                    cache: false,
                    success: function(data) {
                        console.log('Succes: ' + data);
                        var resultado = data;
                        console.log(data);
                        if (resultado.respuesta == 'exito') {
                            Swal.fire(
                                '¡Correcto!',
                                '¡El libro se creó correctamente!',
                                'success'
                            )
                        } else if (resultado.respuesta == 'editado') {
                            Swal.fire(
                                '¡Correcto!',
                                '¡El libro se editó correctamente!',
                                'success'
                            )
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: '¡Error!',
                                text: '¡Algo salió mal. Por favor vuelve a intentarlo!'
                            })
                        }
                    },
                    error: console.log('Error')
                });
            } //.then((result))
        })
    }); //  $('#guardar-registro-archivo')

    //Eliminar un registro:
    $('.borrar_registro').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');
        // console.log(id);
        // console.log(tipo);
        Swal.fire({
                title: '¿Estás seguro/a?',
                text: "No se podrá recuperar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar.',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                //Si se oprimio "Si, eliminar" entonces:
                if ((result.value)) {
                    $.ajax({
                        type: 'post',
                        data: {
                            'id': id,
                            'registro': 'eliminar'
                        },
                        url: 'modelo-' + tipo + '.php',
                        success: function(data) {
                            //console.log("Aqui data dentro de sucess " + data);
                            var resultado = JSON.parse(data);
                            // console.log(resultado);
                            if (resultado.respuesta == 'eliminado') {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'Se ha eliminado correctamente.',
                                    'success'
                                )
                                jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('.card-user').remove();
                            } else if (resultado.respuesta == 'eliminado-tipo-examen') {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'Se ha eliminado correctamente.',
                                    'success'
                                )
                                jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('.card-user').remove();
                            } else if (resultado.respuesta == 'eliminado-examen') {
                                Swal.fire(
                                        '¡Eliminado!',
                                        'Se ha eliminado correctamente.',
                                        'success'
                                    )
                                    //Eliminar del DOM la categoria.
                                jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('.row').remove();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: '¡Algo salió mal!'
                                })
                            }
                        }
                    });
                }
            }) //.then((result) 


    }); // $('.borrar_registro')
}); //Documente Read