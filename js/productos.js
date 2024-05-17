document.addEventListener("DOMContentLoaded", function() {
    // Fetch para obtener los productos de la API cuando el DOM esté completamente cargado
    fetch("http://localhost/api.php")
        .then(response => response.json())
        .then(data => {
            // Selección del contenedor donde se mostrarán los productos
            const productosContainer = document.getElementById("productos-container");
            
            // Interación sobre los datos obtenidos de la API
            data.forEach(producto => {
                // Creación del contenedor para cada producto
                const productoDiv = document.createElement("div");
                productoDiv.classList.add("producto");

                // Creación del elemento para el nombre del producto
                const nombre = document.createElement("h3");
                nombre.textContent = producto.nombre;

                // Creación del elemento para la descripción del producto
                const descripcion = document.createElement("p");
                descripcion.textContent = producto.descripcion;

                // Creación del elemento para el precio del producto
                const precio = document.createElement("p");
                precio.textContent = "Precio: $" + producto.precio;

                // Creación del elemento para la imagen del producto
                const imagen = document.createElement("img");
                imagen.src = producto.imagen;

                // Agregar los elementos al contenedor del producto
                productoDiv.appendChild(nombre);
                productoDiv.appendChild(descripcion);
                productoDiv.appendChild(precio);
                productoDiv.appendChild(imagen);

                // Agregar el contenedor del producto al contenedor principal
                productosContainer.appendChild(productoDiv);
            });
        });
});
