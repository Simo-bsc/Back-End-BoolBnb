@extends('layouts.app')

@section('page-title', 'BoolBnb | Dashboard')

@section('main-content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="dashboard-content">
    <h1 class="m-3 text-center mb-5">
        Ciao <strong class="name_color">{{ $user->first_name }}</strong> questa è la tua dashboard!
    </h1>
   <div class="dashboard">
      <div class="container text-center py-3">
         @if (count($apartments) == 0)
            <div class="container w-100 py-5 text-center">
                  <h1 class="p-4">
                     Aggiungi il tuo primo appartamento.
                  </h1>
   
                  <a href="{{ route('admin.apartments.create') }}"
                     class="btn btn-outline-success fw-bold w-50 @if($activeLink === 'create') activeLink @endif">
                     Diventa host
                  </a>
            </div>
   
         @else
   
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-6 gx-3">
                  <div class="border_col d-flex flex-column h-100">
                     <h2 class="text-center p-3 title_bg"><strong>Informazioni generali</strong></h2> 
                     <div>
                        @if (count($apartments) > 0)
   
                        <h3 class="text-center m-auto py-5">
                           Hai un totale di
                           <strong class="name_color">
                                 @php
                                 echo $apartments->count();
                                 @endphp
                           </strong>
                           appartamenti nel tuo account.
                        </h3>
   
                        {{-- <h3 class="text-center m-auto py-3">
                           Hai un totale di <strong class="name_color">***</strong> appartamenti sponsorizzati.
                        </h3> --}}
   
                        <p class="fs-5 m-auto py-4 fst-italic">"Puoi gestire i tuoi appartamenti nella sezione "I tuoi appartamenti", oppure <a href="{{ route('admin.apartments.index') }}">CLICCA QUI <i class="fa-solid fa-arrow-left"></i></a>." </p>
                        @endif
                     </div>
                  </div>
                  
               </div>
   
               <div class="col-sm-12 col-md-12 col-lg-6 gx-3">
                  <div class="border_col d-flex flex-column h-100">
                     <h2 class="text-center p-3 title_bg"> <strong>Statistiche generali</strong></h2>
                     <p class="fs-5">Qui sotto trovi un grafico che rappresenta tutte le visualizzazioni e i messaggi ricevuti nell'ultimo mese di tutti gli appartamenti in tuo possesso.</p>
                     <p class="fs-4">Visualizzazioni totali degli ultimi 12 mesi: <strong class="name_color"> {{ $totalViews }} </strong></p>
                     <p class="fs-4">Messaggi ricevuti totali degli ultimi 12 mesi: <strong class="name_color"> {{ $totalMessages }} </strong> </p>
                     <p class="fs-5 fst-italic">"Per visualizzare tutte le statistiche per un'appartamento specifico, <a href="{{ route('admin.statistics.index') }}">CLICCA QUI <i class="fa-solid fa-arrow-left"></i></a>."</p>
                     <div class="responsive_chart">
                           <canvas id="myChart"></canvas>
                     </div>
                  </div>
               </div>
               
            </div>
   
         @endif
      </div>
   </div>
</div>
@endsection

<script>

   //DATI VISUALIZZAZIONI
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
                                size: 20,
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
