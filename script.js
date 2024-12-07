document.getElementById('formActualizarDatos').addEventListener('submit', function (event) {
    // Evitar el envío tradicional del formulario (recarga de página)
    event.preventDefault();

    // Simulamos el proceso de actualización de datos
    const mensaje = document.getElementById('mensaje');
    mensaje.innerHTML = 'Datos actualizados correctamente.';

    // Aquí podrías agregar una lógica para actualizar los datos en el servidor si fuera necesario

    // Si quieres limpiar el formulario después de la actualización
    document.getElementById('formActualizarDatos').reset();
});
