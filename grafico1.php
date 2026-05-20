<?php
include 'bd.php';

/*
|--------------------------------------------------------------------------
| BAIRROS COM MAIS PEDIDOS HOJE
|--------------------------------------------------------------------------
*/

$sql = "
SELECT 
    e.bairro,
    COUNT(*) as total
FROM tbl_transacao t
INNER JOIN enderecos e 
    ON t.id_endereco = e.id
WHERE DATE(t.data_pedido) = CURDATE()
GROUP BY e.bairro
ORDER BY total DESC
LIMIT 5
";

$stmt = $pdo->query($sql);

$labels = [];
$dados = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $labels[] = $row['bairro'];
    $dados[] = $row['total'];
}
?>

<div class="grafico">
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = <?php echo json_encode($labels); ?>;
    const dados = <?php echo json_encode($dados); ?>;

    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pedidos',
                data: dados,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 205, 86)',
                    'rgb(201, 203, 207)',
                    'rgb(54, 162, 235)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

<style>
    .grafico {
        position: relative;
        width: 100%;
        height: 400px;
    }

    @media(max-width:768px) {
        .grafico {
            height: 320px;
            width: 100%;
        }
    }
</style>