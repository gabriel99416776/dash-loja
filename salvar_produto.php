<?php

include 'bd.php';

$nome_prod = $_POST['nome_prod'];
$desc_prod = $_POST['desc_prod'];
$valor_prod = $_POST['valor_prod'];
$cor = $_POST['cor'];
$categoria = $_POST['categoria'];
$frete_gratis = $_POST['frete_gratis'];

$promo_destaque = !empty($_POST['promo_destaque'])
    ? $_POST['promo_destaque']
    : 0;
$img_prod = str_replace('data:image/jpeg;base64,', '', $_POST['img_prod']);
$img_prod2 = str_replace('data:image/jpeg;base64,', '', $_POST['img_prod2']);
$img_prod3 = str_replace('data:image/jpeg;base64,', '', $_POST['img_prod3']);

$img_prod = str_replace('data:image/png;base64,', '', $img_prod);
$img_prod2 = str_replace('data:image/png;base64,', '', $img_prod2);
$img_prod3 = str_replace('data:image/png;base64,', '', $img_prod3);
$tamanhos = $_POST['tamanho'] ?? [];
$estoques = $_POST['estoque'] ?? [];

$sql = "INSERT INTO produtos_principais (
    img_prod,
    desc_prod,
    nome_prod,
    promo_destaque,
    frete_gratis,
    valor_prod,
    img_prod2,
    img_prod3,
    cor,
    categoria
) VALUES (
    :img_prod,
    :desc_prod,
    :nome_prod,
    :promo_destaque,
    :frete_gratis,
    :valor_prod,
    :img_prod2,
    :img_prod3,
    :cor,
    :categoria
)";

$stmt = $pdo->prepare($sql);

$stmt->execute([

    ':img_prod' => $img_prod,
    ':desc_prod' => $desc_prod,
    ':nome_prod' => $nome_prod,
    ':promo_destaque' => $promo_destaque,
    ':frete_gratis' => $frete_gratis,
    ':valor_prod' => $valor_prod,
    ':img_prod2' => $img_prod2,
    ':img_prod3' => $img_prod3,
    ':cor' => $cor,
    ':categoria' => $categoria

]);

$id_produto = $pdo->lastInsertId();

if (!empty($tamanhos)) {

    foreach ($tamanhos as $index => $tamanho) {

        $estoque = $estoques[$index];

        if (!empty($tamanho)) {

            $sql_variacao = "INSERT INTO produtos_variacoes (
                id_produto,
                tamanho,
                estoque
            ) VALUES (
                :id_produto,
                :tamanho,
                :estoque
            )";

            $stmt_variacao = $pdo->prepare($sql_variacao);

            $stmt_variacao->execute([

                ':id_produto' => $id_produto,
                ':tamanho' => $tamanho,
                ':estoque' => $estoque

            ]);
        }
    }
}

echo "
<script>
    alert('Produto cadastrado com sucesso!');
    window.location='cadastrar_prod.php';
</script>
";
