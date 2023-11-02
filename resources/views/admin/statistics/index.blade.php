@extends('layouts.app')

@section('page-title', 'BoolBnb | Statistiche')

@section('main-content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php
    $selectedApartmentId = $_GET['apartment_id'] ?? null;
    $selectedApartment = null;

    if ($selectedApartmentId) {
        foreach ($apartments as $apartment) {
            if ($apartment->id == $selectedApartmentId) {
                $selectedApartment = $apartment;
                break;
            }
        }
    }
@endphp

<div class="container">
    <div class="row mt-3">
        <div>
            <h1 class="m-3 text-center mb-5">LE TUE <strong class="name_color">STATISTICHE</strong></h1>
        </div>

        <form class="mt-2" id="myForm" action="{{ route('admin.statistics.index') }}" method="GET">
            @csrf
            <div class="col-sm-12 col-md-12 col-lg-4 gx-5 m-auto py-3">
                <select class="form-select" aria-label="Default select example" name="apartment_id" onchange="this.form.submit()">
                    <option selected>Scegli l'appartamento da visualizzare</option>
                        @foreach ($apartments as $apartment)
                        <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
                        @endforeach
                </select>
            </div>
        </form>
    </div>
    
    <div class="row mt-5 d-flex justify-content-center">
        <div class="responsive_chart graphic">
            @if ($selectedApartment)
            <h3><strong>{{ $selectedApartment->title }}</strong></h3>
            @endif
            <canvas id="myChart"></canvas>
        </div>
    </div>  
</div>

@endsection

<script>

    // DATI VISUALIZZAZIONI
    const data = <?php echo json_encode($data); ?>;

    const labels = data.map(item => {
    const dateParts = item.label.split('-'); // Dividi la data in un array [anno, mese, giorno]
    return `${dateParts[1]}-${dateParts[0]}`; // Restituisci il mese e l'anno nel formato desiderato
    });
    const values = data.map(item => item.data);

    // DATI MESSAGGI    
    const dataMess = <?php echo json_encode($dataMess); ?>;

    const labelss = dataMess.map(item => item.label);
    const valuess = dataMess.map(item => item.data);

    
    
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('myChart');

    const views = new Chart(ctx, {
    type: 'bar',
    data: {
            labels: labels,
            datasets: [{
                label: 'Visualizzazioni',
                data: values,
                borderWidth: 2,
                backgroundColor:[
                            '#f26419'
                            ],
                borderColor: '#F6AE2D',
                borderRadius: 5,
            },
            {
                label: 'Messaggi',
                data: valuess,
                borderWidth: 2,
                backgroundColor:[
                            '#2f4858'
                            ],
                borderColor: '#33658A',
                borderRadius: 5,
            }
        ]
    },
        options: {
            responsive: true, 
            maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Ultimi 12 mesi',
                            color: 'black',
                            font: {
                                family: 'Nunito',
                                size: 30,
                                weight: 'bold',
                                lineHeight: 1.2,
                            },
                        }
                    },
                }
        }
    });
});

</script> 