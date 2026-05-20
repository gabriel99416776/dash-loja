<div class="grafico">
    <canvas id="graficoMes"></canvas>
</div>

<script>
const ctxMes = document.getElementById('graficoMes');

new Chart(ctxMes, {
    type: 'line',
    data: {
        labels: ['Jan', 'Fev', 'Mar'],
        datasets: [{
            label: 'Vendas',
            data: [30, 50, 80],
            borderWidth: 2,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

