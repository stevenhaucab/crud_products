$(document).on('click', '.eliminar', function(e) {
    e.preventDefault(); 
    let fila = $(this).closest('tr');
    let idElement = $(this).data('id');
    let nameElement = $(this).attr('name');
    let typeElement = $(this).data('type');
    let route = $(this).data('route');

    Swal.fire({
        title: '¿Estás seguro?',
        text: `Vas a eliminar ${typeElement}: ${nameElement}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/${route}/${idElement}`,
                method: 'POST',
                dataType: 'json',
                data: { id: idElement },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            '¡Eliminado!',
                            `${typeElement} con el nombre ${nameElement} ha sido eliminado exitosamente.`,
                            'success'
                        );
                        fila.remove();
                    } else {
                        Swal.fire(
                            'Error',
                            response.message || `No se pudo eliminar ${typeElement}.`,
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error',
                        'Hubo un problema al procesar la solicitud.',
                        'error'
                    );
                }
            });
        }
    });
});
