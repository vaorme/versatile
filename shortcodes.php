<?php

// shorcode sin parametros: [shortcode_name]
// shorcode con parametros: [shortcode_name nameparam="uno"]

// Custom shortcode con parametros
function shortcode_portafolio($parametros){ // Si se quiere trabajar sin parametros solo eliminar "$parametros"
    
    // Obtener parametros
    $parametros['nameparam'];

    ob_start();

    // contenido plugin
    
    return ob_get_clean();

}
add_shortcode('shortcode_name', 'shortcode_portafolio');
?>