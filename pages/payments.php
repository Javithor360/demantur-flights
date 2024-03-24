<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar y confirmar reserva</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row justify-between bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Left side -->
            <div class="w-full lg:w-2/3 p-8">
                <h2 class="text-2xl font-semibold mb-6">Pagar y confirmar reserva</h2>
                <p class="text-sm text-gray-600 mb-2">Elige tu método de pago favorito.</p>
                
                <!-- Card Details -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Datos de la tarjeta</h3>
                    <div class="flex space-x-2 mb-4">
                        <img src="https://placehold.co/40x25" alt="Visa logo" class="h-6">
                        <img src="https://placehold.co/40x25" alt="MasterCard logo" class="h-6">
                        <img src="https://placehold.co/40x25" alt="American Express logo" class="h-6">
                        <img src="https://placehold.co/40x25" alt="Diners Club logo" class="h-6">
                        <img src="https://placehold.co/40x25" alt="Discover logo" class="h-6">
                        <img src="https://placehold.co/40x25" alt="UATP logo" class="h-6">
                    </div>
                    <input type="text" placeholder="Ingresar tu tarjeta" class="w-full p-4 border rounded-lg mb-4">
                </div>

                <!-- Billing Details -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Datos de facturación</h3>
                    <input type="email" placeholder="Correo electrónico" class="w-full p-4 border rounded-lg mb-4">
                    <input type="text" placeholder="Dirección de residencia" class="w-full p-4 border rounded-lg mb-4">
                    <input type="text" placeholder="Ciudad" class="w-full p-4 border rounded-lg mb-4">
                    <select class="w-full p-4 border rounded-lg mb-4">
                        <option>País</option>
                    </select>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start mb-6">
                    <input type="checkbox" id="terms" class="mr-2">
                    <label for="terms" class="text-sm">He leído y acepto las condiciones del <a href="#" class="text-blue-600">contrato de transporte</a> y las restricciones sobre <a href="#" class="text-blue-600">mercancías peligrosas</a>.</label>
                </div>

                <!-- Payment Button -->
                <div class="flex items-center">
                    <button class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50">
                        Confirmar y pagar
                    </button>
                    <p class="text-sm text-green-600 ml-4"><i class="fas fa-lock mr-1"></i>Usamos 3D Secure para verificar tu información y asegurar que tu compra sea segura.</p>
                </div>
            </div>

            <!-- Right side -->
            <div class="w-full lg:w-1/3 bg-gray-200 p-8">
                <h3 class="text-lg font-semibold mb-4">Resumen de compra</h3>
                <div class="mb-6">
                    <h4 class="text-sm font-semibold mb-2">Vuelos</h4>
                    <div class="mb-4">
                        <p class="text-sm mb-1">San Salvador a Barcelona</p>
                        <p class="text-sm text-gray-600">27 marzo 2024</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs bg-pink-600 text-white px-2 py-1 rounded">classic</span>
                            <div class="flex items-center">
                                <span class="text-sm">02:15</span>
                                <i class="fas fa-plane-departure mx-2 text-gray-400"></i>
                                <span class="text-sm">07:40</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm mb-1">Barcelona a San Salvador</p>
                        <p class="text-sm text-gray-600">07 abril 2024</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs bg-blue-600 text-white px-2 py-1 rounded">light</span>
                            <div class="flex items-center">
                                <span class="text-sm">14:00</span>
                                <i class="fas fa-plane-arrival mx-2 text-gray-400"></i>
                                <span class="text-sm">05:54</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm">1 Adulto</p>
                </div>
                <div class="flex justify-between items-center mb-6">
                    <a href="#" class="text-blue-600 text-sm">Ver detalle</a>
                    <i class="fas fa-chevron-down text-gray-400"></i>
                </div>
                <div class="flex justify-between items-center font-semibold">
                    <p>Total a pagar</p>
                    <p>USD 2.705,91</p>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center text-sm text-gray-600 py-4">
        Copyright © Avianca 2024
    </footer>
</body>
</html>