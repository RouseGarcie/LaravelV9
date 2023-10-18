<x-app-layout>
    <x-slot name="header">

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="background: cadetblue; color: #ffffff">
                        {!! trans('sistema.proyeccion') !!}
                       "{{old('nombre', $prod['nombre'])}}"
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-2">
                                <label>{!! trans('sistema.sku') !!}: </label><code>"{{old('sku', $prod['sku'])}}"</code>
                            </div>
                            <div class="col-2">
                                <label >{!! trans('sistema.precioDolares') !!}: </label><code> "{{old('precioDolares', $prod['precioDolares'])}}"</code>
                                <input hidden id="precioDolares" value="{{old('precioDolares', $prod['precioDolares'])}}">
                            </div>
                            <div class="col-2">
                                <label>{!! trans('sistema.precioPesos') !!}: </label><code>"{{old('precioPesos', $prod['precioPesos'])}}"</code>
                                <input hidden id="precioPesos" value="{{old('precioPesos', $prod['precioPesos'])}}">
                            </div>
                            <div class="col-2">
                                <label>{!! trans('sistema.puntos') !!}: </label><code>"{{old('puntos', $prod['puntos'])}}"</code>
                            </div>
                            <div class="col-2">
                                <label>{!! trans('sistema.descripcionCorta') !!}: </label><code>"{{old('descripcionCorta', $prod['descripcionCorta'])}}"</code>
                            </div>
                            <div class="col-2">
                                <label>{!! trans('sistema.descripcionLarga') !!}: </label><code>"{{old('descripcionLarga', $prod['descripcionLarga'])}}"</code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>


    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">




                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script >
    const ctx = document.getElementById('myChart');

    let precioDolares = document.getElementById('precioDolares').value;
    let precioPesos = document.getElementById('precioPesos').value;
    const pesos = [];
    const dolares = [];

    var aumento = 0
    for (let i = 0; i < 6; i++) {
      aumento += 2
        console.log(aumento, "***")

        dolares.push(precioDolares)
        pesos.push(precioPesos)

        precioDolares = parseInt(precioDolares)+(aumento/100);
        precioDolares += i;

        precioPesos = parseInt(precioPesos)+(aumento/100);
        precioPesos += i;

    }
    console.log(pesos, "pesos")

    const data = {
        labels: ['Octubre', 'Noviembre', 'Diciembre', 'Enero', 'Febrero', 'Marzo'],
        datasets: [
            {
                label: "Pesos",
                backgroundColor: 'rgba(232,163,234,0.89)',
                borderColor: 'rgb(17,215,223)',
                data: pesos,
            },
            {
                label: "Dolares",
                backgroundColor: 'rgba(108,185,167,0.8)',
                borderColor: 'rgb(131,193,23)',
                data: dolares,
            }
        ]
    };



    new Chart(ctx, {
        type: 'bar',
        data: data,

        options: {
            animations: {
                tension: {
                    duration: 100000000,
                    easing: 'easeOutSine',
                    from: 1,
                    to: 0,
                    loop: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                    /*min: 0,
                    max: 100 */
                }
            }
        }
    });
</script>

