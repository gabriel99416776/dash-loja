<div class="grafico">
    <canvas id="graficoMesBar"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxMesBar = document.getElementById('graficoMesBar');

    new Chart(ctxMesBar, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<style>
    .grafico {
        position: relative;
        width: 100%;
        height: 350px;
    }

    @media(max-width:768px) {
        .grafico {
            height: 200px;
            width: 100%;
        }
    }
</style>