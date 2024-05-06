<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <div class="mb-4">
                <img src="https://live.staticflickr.com/65535/53701536846_61daf52fa4_m.jpg" alt="Company logo with a red icon resembling a bird in flight, placed to the left of the company name 'Avianca' in red text." class="mb-6">
                <h1 class="text-2xl font-bold mb-2">Ingresa tu tarjeta</h1>
                <p class="text-gray-600 mb-6">Paga seguro con estos medios de pago</p>
                <div class="flex space-x-2 mb-6">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" width="35" height="35" alt="VISA logo">
                    <img src="https://placehold.co/40x25?text=MC&bg=ffffff" width="35" height="35" alt="MasterCard logo">
                    <img src="https://placehold.co/40x25?text=AMEX&bg=ffffff" width="35" height="35" alt="American Express logo">
                    <img src="https://placehold.co/40x25?text=DISC&bg=ffffff" width="35" height="35" alt="Discover logo">
                    <img src="https://placehold.co/40x25?text=UATP&bg=ffffff" width="35" height="35" alt="UATP logo">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cardholder-name">
                    Nombre del titular
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cardholder-name" type="text" placeholder="Nombre del titular">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="card-number">
                    Número de tarjeta
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="card-number" type="text" placeholder="Número de tarjeta">
            </div>
            <div class="flex justify-between mb-6">
                <div class="w-1/3 mr-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="expiration-month">
                        Fecha de Expiración
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="expiration-month" type="text" placeholder="Mes">
                </div>
                <div class="w-1/3 mx-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="expiration-year">
                        &nbsp;
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="expiration-year" type="text" placeholder="Año">
                </div>
                <div class="w-1/3 ml-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cvv">
                        &nbsp;
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cvv" type="text" placeholder="CVV">
                </div>
            </div>
            <div class="flex items-center justify-between">
                <a href="./payments.php">
                    <button class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded" type="button">
                        Volver
                    </button>
                </a>
                <a href="./purchaseSummary.php">
                    <button class="bg-black hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" type="button">
                        Añadir tarjeta
                    </button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>