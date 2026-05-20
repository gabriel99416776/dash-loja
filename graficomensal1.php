<?php
include 'bd.php';

/*
|--------------------------------------------------------------------------
| VENDAS DOS ÚLTIMOS 12 MESES
|--------------------------------------------------------------------------
*/

$sql = "
SELECT 
    MONTH(data_pedido) as mes,
    YEAR(data_pedido) as ano,
    SUM(valor_total) as total
FROM tbl_transacao
WHERE status_pagamento = 'approved'
GROUP BY YEAR(data_pedido), MONTH(data_pedido)
ORDER BY YEAR(data_pedido), MONTH(data_pedido)
";

$stmt = $pdo->query($sql);

$meses = [
    1 => 'Jan',
    2 => 'Fev',
    3 => 'Mar',
    4 => 'Abr',
    5 => 'Mai',
    6 => 'Jun',
    7 => 'Jul',
    8 => 'Ago',
    9 => 'Set',
    10 => 'Out',
    11 => 'Nov',
    12 => 'Dez'
];

$labels = [];
$dados = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $labels[] = $meses[$row['mes']] . '/' . $row['ano'];
    $dados[] = $row['total'];
}
?>

<div class="grafico">
    <canvas id="graficoMes"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labelsMes = <?php echo json_encode($labels); ?>;
    const dadosMes = <?php echo json_encode($dados); ?>;

    const ctxMes = document.getElementById('graficoMes');

    new Chart(ctxMes, {
        type: 'line',
        data: {
            labels: labelsMes,
            datasets: [{
                label: 'Vendas Mensais',
                data: dadosMes,
                borderWidth: 2,
                tension: 0.3,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
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
        }
    }
</style>