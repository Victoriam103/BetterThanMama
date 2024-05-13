function setCookie(nombre, valor, diasExpiracion) {
    let fecha = new Date();
    fecha.setTime(fecha.getTime() + (diasExpiracion * 24 * 60 * 60 * 1000));
    let expira = "expires=" + fecha.toUTCString();
    document.cookie = nombre + "=" + valor + ";" + expira + ";path=/";
  }
  function getCookie(nombre) {
  let nombreCookie = nombre + "=";
  let cookies = document.cookie.split(';');
  for (let i = 0; i < cookies.length; i++) {
    let c = cookies[i].trim();
    if (c.indexOf(nombreCookie) == 0) {
      return c.substring(nombreCookie.length, c.length);
    }
  }
  return "";
}

function deleteCookie(nombre) {
    document.cookie = nombre + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  }

  // Crear una cookie llamada "usuario" con el valor "Juan" y una duración de 30 días
setCookie("usuario", "Juan", 30);

// Leer la cookie llamada "usuario"
let usuario = getCookie("usuario");
console.log("Usuario:", usuario);

// Eliminar la cookie llamada "usuario"
deleteCookie("usuario");

function mostrarBanner() {
    let consentimiento = getCookie("consentimientoCookies");
    if (consentimiento == "") {
      document.getElementById("cookieBanner").style.display = "block";
    }
  }
  
  function aceptarCookies() {
    setCookie("consentimientoCookies", "aceptado", 365);
    document.getElementById("cookieBanner").style.display = "none";
    // Aquí puedes agregar las cookies que deseas configurar al aceptar.
  }
  
  function rechazarCookies() {
    setCookie("consentimientoCookies", "rechazado", 365);
    document.getElementById("cookieBanner").style.display = "none";
    // Aquí puedes agregar las cookies que deseas eliminar al rechazar.
  }
  
  // Llama a la función mostrarBanner() cuando la página se cargue por completo.
  document.addEventListener("DOMContentLoaded", mostrarBanner);

  function crearCookies() {
    let consentimiento = getCookie("consentimientoCookies");
    if (consentimiento == "aceptado") {
      // Aquí puedes agregar las cookies que deseas configurar al aceptar.
      // Por ejemplo: setCookie("usuario", "Juan", 30);
    }
  }
  
  // Llama a la función crearCookies() cuando la página se cargue por completo.
  document.addEventListener("DOMContentLoaded", crearCookies);
  
  
