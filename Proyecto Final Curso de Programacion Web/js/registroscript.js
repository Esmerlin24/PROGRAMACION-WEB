document.getElementById("registroForm").addEventListener("submit", function(e){
    let nombre = document.getElementById("nombre").value.trim();
    let correo = document.getElementById("correo").value.trim();
    let pass = document.getElementById("contrasena").value.trim();
    let confirmar = document.getElementById("confirmar").value.trim();
    let mensaje = document.getElementById("mensaje");

    // Evitamos enviar si hay errores
    if(nombre === "" || correo === "" || pass === "" || confirmar === ""){
        e.preventDefault();
        mensaje.textContent = "Todos los campos son obligatorios.";
        mensaje.style.color = "red";
        return;
    }

    let regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!regexCorreo.test(correo)){
        e.preventDefault();
        mensaje.textContent = "El correo no es válido.";
        mensaje.style.color = "red";
        return;
    }

    if(pass !== confirmar){
        e.preventDefault();
        mensaje.textContent = "Las contraseñas no coinciden.";
        mensaje.style.color = "red";
        return;
    }

    // Si todo está bien, dejamos que el PHP procese
    mensaje.textContent = "Procesando registro...";
    mensaje.style.color = "blue";
});
