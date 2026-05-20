<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
</head>
<style>
    .form-card {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        margin-top: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
    }

    .input-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .input-group input,
    .input-group textarea,
    .input-group select {
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 10px;
        outline: none;
    }

    textarea {
        resize: none;
        height: 120px;
    }

    .btn {
        background: #3C91E6;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        cursor: pointer;
    }

    .tamanho-item {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .preview-imagens {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .preview-imagens img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    .modal-bg {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .modal {
        background: #fff;
        width: 90%;
        max-width: 500px;
        padding: 25px;
        border-radius: 15px;
    }

    .modal input {
        width: 100%;
        margin-bottom: 15px;
    }
</style>

<body>
    <?php include 'navbar.php'; ?>

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Cadastrar Produto</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Cadastrar Produto</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="index.php">Inicio</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="form-card">

            <form action="salvar_produto.php" method="POST">

                <div class="form-grid">

                    <div class="input-group">
                        <label>Nome do Produto</label>
                        <input type="text" name="nome_prod">
                    </div>

                    <div class="input-group">
                        <label>Valor</label>
                        <input type="number" step="0.01" name="valor_prod">
                    </div>

                    <div class="input-group">
                        <label>Cor</label>
                        <input type="text" name="cor">
                    </div>

                    <div class="input-group">
                        <label>Categoria</label>
                        <input type="text" name="categoria">
                    </div>

                    <div class="input-group">
                        <label>Frete Gratis</label>
                        <select name="frete_gratis">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label>Promoção</label>
                        <select id="selectPromocao">
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>

                    <div class="input-group" id="campoPromocao" style="display:none;">
                        <label>Valor Promoção</label>
                        <input type="number" step="0.01" name="promo_destaque">
                    </div>

                </div>

                <div class="input-group" style="margin-top:20px;">
                    <label>Descrição</label>
                    <textarea name="desc_prod"></textarea>
                </div>

                <hr style="margin:25px 0;">

                <h3>Tamanhos e Estoque</h3>

                <div id="listaTamanhos"></div>

                <button type="button" class="btn" onclick="adicionarTamanho()">
                    + Adicionar Tamanho
                </button>

                <hr style="margin:25px 0;">

                <button type="button" class="btn" onclick="abrirModal()">
                    Upload Imagens
                </button>

                <div class="preview-imagens" id="previewImagens"></div>

                <input type="hidden" name="img_prod" id="img_prod">
                <input type="hidden" name="img_prod2" id="img_prod2">
                <input type="hidden" name="img_prod3" id="img_prod3">

                <br><br>

                <button type="submit" class="btn">
                    Salvar Produto
                </button>

            </form>

        </div>

        <!-- MODAL -->
        <div class="modal-bg" id="modalImagem">

            <div class="modal">

                <h2>Upload de Imagens</h2>

                <input type="file" id="file1">
                <input type="file" id="file2">
                <input type="file" id="file3">

                <button class="btn" onclick="salvarImagens()">
                    Avançar
                </button>

            </div>

        </div>

    </main>
    <!-- MAIN -->
    </section>
    <!-- CONTENT -->


    <script src="script.js"></script>
    <script>
        const selectPromocao = document.getElementById('selectPromocao');
        const campoPromocao = document.getElementById('campoPromocao');

        selectPromocao.addEventListener('change', () => {

            if (selectPromocao.value == "1") {
                campoPromocao.style.display = 'flex';
            } else {
                campoPromocao.style.display = 'none';
            }

        });

        function adicionarTamanho() {

            const div = document.createElement('div');

            div.classList.add('tamanho-item');

            div.innerHTML = `
    
        <input type="text" 
               name="tamanho[]" 
               placeholder="Tamanho P/M/G">

        <input type="number" 
               name="estoque[]" 
               placeholder="Estoque">

        <button type="button" onclick="this.parentElement.remove()">
            X
        </button>

    `;

            document.getElementById('listaTamanhos').appendChild(div);

        }

        function abrirModal() {

            document.getElementById('modalImagem').style.display = 'flex';

        }

        function converterBase64(file, callback) {

            const reader = new FileReader();

            reader.onload = function(e) {

                callback(e.target.result);

            }

            reader.readAsDataURL(file);

        }

        function salvarImagens() {

            const file1 = document.getElementById('file1').files[0];
            const file2 = document.getElementById('file2').files[0];
            const file3 = document.getElementById('file3').files[0];

            const preview = document.getElementById('previewImagens');

            preview.innerHTML = '';

            if (file1) {

                converterBase64(file1, (base64) => {

                    document.getElementById('img_prod').value = base64;

                    preview.innerHTML += `
                <img src="${base64}">
            `;

                });

            }

            if (file2) {

                converterBase64(file2, (base64) => {

                    document.getElementById('img_prod2').value = base64;

                    preview.innerHTML += `
                <img src="${base64}">
            `;

                });

            }

            if (file3) {

                converterBase64(file3, (base64) => {

                    document.getElementById('img_prod3').value = base64;

                    preview.innerHTML += `
                <img src="${base64}">
            `;

                });

            }

            document.getElementById('modalImagem').style.display = 'none';

        }
    </script>
</body>

</html>