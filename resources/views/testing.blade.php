<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    .sauce input[type="radio"]:checked+label {
        background: #e7b800;
        color: white;
        box-shadow: 0 0 10px 4px rgba(211, 47, 47, 0.4);
        transform: scale(1.02);
    }
</style>


<body>

    <div class="">
        <h3 class="text-center">Pilih Saus</h3>
        <div class="sauce flex justify-center gap-3 mt-5">
            <input type="radio" name="sauce" id="sauce-bbq" value="barbeque" class="hidden" checked>
            <label for="sauce-bbq"
                class="py-2 px-4 border border-solid border-yellow-300 bg-yellow-200 cursor-pointer transition-all duration-300 ease-out shadow-md text-base text-slate-700 hover:-translate-y-1 hover:shadow-lg">
                Saus Barbaque
            </label>

            <input type="radio" name="sauce" id="sauce-mushroom" value="mushroom" class="hidden">
            <label for="sauce-mushroom"
                class="py-2 px-4 border border-solid border-yellow-300 bg-yellow-200 cursor-pointer transition-all duration-300 ease-out shadow-md text-base text-slate-700 hover:-translate-y-1 hover:shadow-lg">
                Saus Mushroom
            </label>

            <input type="radio" name="sauce" id="sauce-blackpepper" value="blackpepper" class="hidden">
            <label for="sauce-blackpepper"
                class="py-2 px-4 border border-solid border-yellow-300 bg-yellow-200 cursor-pointer transition-all duration-300 ease-out shadow-md text-base text-slate-700 hover:-translate-y-1 hover:shadow-lg">
                Saus Blackpepper
            </label>
        </div>
    </div>

</body>

</html>
