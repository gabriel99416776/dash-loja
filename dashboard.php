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
                        <h3>1020</h3>
                        <p>Novos Pedidos</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-group'></i>
                    <span class="text">
                        <h3>2834</h3>
                        <p>Vendas Hoje</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-dollar-circle'></i>
                    <span class="text">
                        <h3>R$2543.00</h3>
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
                            <tr>
                                <td>
                                    <img src="https://placehold.co/600x400/png">
                                    <p>Micheal John</p>
                                </td>
                                <td>18-10-2021</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="https://placehold.co/600x400/png">
                                    <p>Ryan Doe</p>
                                </td>
                                <td>01-06-2022</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="https://placehold.co/600x400/png">
                                    <p>Tarry White</p>
                                </td>
                                <td>14-10-2021</td>
                                <td><span class="status process">Process</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="https://placehold.co/600x400/png">
                                    <p>Selma</p>
                                </td>
                                <td>01-02-2023</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="https://placehold.co/600x400/png">
                                    <p>Andreas Doe</p>
                                </td>
                                <td>31-10-2021</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
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
                        <h3>1020</h3>
                        <p>Pedidos No Mes</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-group'></i>
                    <span class="text">
                        <h3>2834</h3>
                        <p>Vendas No Mes</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-dollar-circle'></i>
                    <span class="text">
                        <h3>R$2543.00</h3>
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
                <div class="todo">
                    <div class="head">
                        <h3>Bairros com mais pedidos no dia</h3>
                        <i class='bx bx-plus icon'></i>
                        <i class='bx bx-filter'></i>

                    </div>
                    <?php include 'graficomensal2.php'; ?>
                </div>
            </div>