<?php
include 'bd.php';

/*
|--------------------------------------------------------------------------
| PEDIDOS HOJE
|--------------------------------------------------------------------------
*/
$sqlPedidosHoje = "
SELECT COUNT(*) as total
FROM tbl_transacao
WHERE DATE(data_pedido) = CURDATE()
";

$stmt = $pdo->query($sqlPedidosHoje);
$pedidosHoje = $stmt->fetch(PDO::FETCH_ASSOC)['total'];


/*
|--------------------------------------------------------------------------
| VENDAS HOJE
|--------------------------------------------------------------------------
*/
$sqlVendasHoje = "
SELECT SUM(quantidade_itens) as total
FROM tbl_transacao
WHERE DATE(data_pedido) = CURDATE()
AND status_pagamento = 'approved'
";

$stmt = $pdo->query($sqlVendasHoje);
$vendasHoje = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

if (!$vendasHoje) {
    $vendasHoje = 0;
}


/*
|--------------------------------------------------------------------------
| TOTAL VENDIDO HOJE
|--------------------------------------------------------------------------
*/
$sqlTotalHoje = "
SELECT SUM(valor_total) as total
FROM tbl_transacao
WHERE DATE(data_pedido) = CURDATE()
AND status_pagamento = 'approved'
";

$stmt = $pdo->query($sqlTotalHoje);
$totalHoje = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

if (!$totalHoje) {
    $totalHoje = 0;
}


/*
|--------------------------------------------------------------------------
| PEDIDOS MÊS
|--------------------------------------------------------------------------
*/
$sqlPedidosMes = "
SELECT COUNT(*) as total
FROM tbl_transacao
WHERE MONTH(data_pedido) = MONTH(CURDATE())
AND YEAR(data_pedido) = YEAR(CURDATE())
";

$stmt = $pdo->query($sqlPedidosMes);
$pedidosMes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];


/*
|--------------------------------------------------------------------------
| VENDAS MÊS
|--------------------------------------------------------------------------
*/
$sqlVendasMes = "
SELECT SUM(quantidade_itens) as total
FROM tbl_transacao
WHERE MONTH(data_pedido) = MONTH(CURDATE())
AND YEAR(data_pedido) = YEAR(CURDATE())
AND status_pagamento = 'approved'
";

$stmt = $pdo->query($sqlVendasMes);
$vendasMes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

if (!$vendasMes) {
    $vendasMes = 0;
}


/*
|--------------------------------------------------------------------------
| TOTAL MÊS
|--------------------------------------------------------------------------
*/
$sqlTotalMes = "
SELECT SUM(valor_total) as total
FROM tbl_transacao
WHERE MONTH(data_pedido) = MONTH(CURDATE())
AND YEAR(data_pedido) = YEAR(CURDATE())
AND status_pagamento = 'approved'
";

$stmt = $pdo->query($sqlTotalMes);
$totalMes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

if (!$totalMes) {
    $totalMes = 0;
}
/*
|--------------------------------------------------------------------------
| PEDIDOS PENDENTES
|--------------------------------------------------------------------------
*/
$sqlPedidosPendentes = "
SELECT 
    id,
    id_usuario,
    data_pedido,
    status_pedido
FROM tbl_transacao
WHERE status_pedido = 'pendente'
ORDER BY id DESC
LIMIT 10
";

$stmtPedidos = $pdo->query($sqlPedidosPendentes);
$pedidosPendentes = $stmtPedidos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Painel Geral</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Painel Geral</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Home</a>
                    </li>
                </ul>
            </div>

        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <h3><?php echo $pedidosHoje; ?></h3>
                    <p>Novos Pedidos</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3><?php echo $vendasHoje; ?></h3>
                    <p>Vendas Hoje</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-dollar-circle'></i>
                <span class="text">
                    <h3>R$<?php echo number_format($totalHoje, 2, ',', '.'); ?></h3>
                    <p>Total Vendidos Hoje</p>
                </span>
            </li>
        </ul>


        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Pedidos Pendentes</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data do Pedido</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($pedidosPendentes as $pedido) { ?>

                            <?php

                            $sqlUsuario = "
        SELECT nome, foto_64
        FROM usuarios
        WHERE id = :id
        ";

                            $stmtUsuario = $pdo->prepare($sqlUsuario);

                            $stmtUsuario->execute([
                                ':id' => $pedido['id_usuario']
                            ]);

                            $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

                            ?>

                            <tr>

                                <td>
                                    <?php if (!empty($usuario['foto_64'])) { ?>

                                        <img src="data:image/jpeg;base64,<?php echo $usuario['foto_64']; ?>">

                                    <?php } else { ?>

                                        <img src="https://placehold.co/100x100/png">

                                    <?php } ?>

                                    <p>
                                        <?php echo $usuario['nome'] ?? 'Usuário'; ?>
                                    </p>
                                </td>

                                <td>
                                    <?php
                                    echo date(
                                        'd/m/Y H:i',
                                        strtotime($pedido['data_pedido'])
                                    );
                                    ?>
                                </td>

                                <td>

                                    <?php

                                    $status = strtolower($pedido['status_pedido']);

                                    if ($status == 'pendente') {

                                        echo '<span class="status pending">Pendente</span>';
                                    } elseif ($status == 'aprovado') {

                                        echo '<span class="status completed">Aprovado</span>';
                                    } else {

                                        echo '<span class="status process">' . ucfirst($status) . '</span>';
                                    }

                                    ?>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <div class="todo">
                <div class="head">
                    <h3>Bairros com mais pedidos no dia</h3>
                    <i class='bx bx-plus icon'></i>
                    <i class='bx bx-filter'></i>

                </div>
                <?php include 'grafico1.php'; ?>
            </div>
        </div>


        <h1>Controle Mensal</h1>
        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <h3><?php echo $pedidosMes; ?></h3>
                    <p>Pedidos No Mes</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3><?php echo $vendasMes; ?></h3>
                    <p>Vendas No Mes</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-dollar-circle'></i>
                <span class="text">
                    <h3>R$<?php echo number_format($totalMes, 2, ',', '.'); ?></h3>
                    <p>Total Vendidos No Mes</p>
                </span>
            </li>
        </ul>
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Pedidos Pendentes</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>
                <?php include 'graficomensal1.php'; ?>
            </div>

        </div>
    </main>
    <!-- MAIN -->
    </section>
    <!-- CONTENT -->


    <script src="script.js"></script>
</body>

</html>