<x-app-layout>
       <x-slot name="header">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Dashboard') }}
           </h2>
           
       </x-slot>

       <h1 class="text-center text-2xl font-bold">View Chart</h1>
       
       <canvas  id="myChart" width="500" height="300"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
              @foreach ($postusers as $postuser)
                             '{{ $postuser->post->title }}',
                      @endforeach
        ],
        datasets: [{
            label: ': best content',
            data: [
              @foreach ($postusers as $postuser )
                               {{ $postuser->cnt }},
                          @endforeach
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
       legend: {
				labels: {
					fontColor: "red",
					fontSize: 18
				}
			},
       // responsive: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</x-app-layout>