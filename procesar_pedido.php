<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Capturar los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre'] ?? 'Cliente');
    $pizza = $_POST['pizza'] ?? '';
    $cantidad = intval($_POST['cantidad'] ?? 1);

    // 2. Estructura de control Switch para el precio unitario
    $precio_unitario = 0;
    switch ($pizza) {
        case "Pepperoni Clásica": $precio_unitario = 189.00; break;
        case "Mexicana Especial": $precio_unitario = 210.00; break;
        case "Hawaiana Real":    $precio_unitario = 195.00; break;
    }
    
    // 3. Estructura de control: If/Else para el descuento matemático
    $subtotal = $precio_unitario * $cantidad;
    $descuento = 0;
    $promo = "No aplicó descuento. Recuerda que por la compra de 3 pizzas te damos un 10% de descuento.";

    if ($cantidad >= 3) {
        $descuento = $subtotal * 0.10;
        $promo = "¡Felicidades! Por la compra de 3 o más pizzas te damos un 10% de descuento.";
    }

    $total = $subtotal - $descuento;

    // 4. Redirección todas las variables 
    header("Location: pedido_confirmado.html?cliente=" . urlencode($nombre) . 
           "&pizza=" . urlencode($pizza) . 
           "&cant=" . $cantidad . 
           "&sub=" . $subtotal . 
           "&desc=" . $descuento . 
           "&tot=" . $total . 
           "&promo=" . urlencode($promo));
    exit();

} else {
    header("Location: contacto.html");
    exit();
}
?>