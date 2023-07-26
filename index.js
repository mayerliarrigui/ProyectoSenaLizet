function cerrarSesion() {
    // Hacer una solicitud GET al archivo logout.php
    fetch('logout.php')
    .then(response => response.text())
    .then(data => {
        // Verificar si la sesión se cerró correctamente
        if (data === 'OK') {
            localStorage.clear(); // Eliminar todos los datos del localStorage
            alert('Sesión cerrada correctamente');
            window.location.href = 'ingresar.html'; // Redirigir al formulario de ingreso
        } else {
            // Hubo un error al cerrar la sesión
            alert('Error al cerrar la sesión');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

 
function redirect(url) {
    window.location.href = url;
}