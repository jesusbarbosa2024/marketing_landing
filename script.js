document.querySelector("form").addEventListener("submit", function(event) {
    event.preventDefault();
    alert("¡Mensaje enviado con éxito! Nos pondremos en contacto contigo.");
});
function descargarExcel() {
    let nombre = document.getElementById("nombre").value;
    let correo = document.getElementById("correo").value;
    let mensaje = document.getElementById("mensaje").value;

    if (!nombre || !correo || !mensaje) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    let data = [
        ["Nombre", "Correo", "Mensaje"],
        [nombre, correo, mensaje]
    ];

    let ws = XLSX.utils.aoa_to_sheet(data);
    let wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Clientes");

    XLSX.writeFile(wb, "clientes.xlsx");

    document.getElementById("formulario").reset();
}
