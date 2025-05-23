<?php 
    $mensagem = '';
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação Executada com sucesso</div>';
                break;
            case 'error':
                $mensagem = '<div class="alert alert-danger">Ação não executada</div>';
                break;
        }
    }

    $resultados = '';

    foreach ($vagas as $vaga) {
        $resultados .= '<tr>
                            <td>' . $vaga->id . '</td>
                            <td>' . $vaga->titulo . '</td>
                            <td>' . $vaga->descricao . '</td>
                            <td>' . ($vaga->ativo == 's' ? 'Ativo' : 'Inativo') . '</td>
                            <td>' . date('d/m/Y \à\s H:i', strtotime($vaga->data)) . '</td>
                            <td>
                                <a href="editar.php?id=' . $vaga->id . '">
                                    <button type="button" class="btn btn-primary btn-sm me-2">Editar</button>
                                </a>
                                <a href="excluir.php?id=' . $vaga->id . '">
                                    <button type="button" class="btn btn-danger btn-sm">Excluir</button>
                                </a>
                            </td>
                        </tr>';
    }

    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                        <td colspan="6" class="text-center">Nenhuma vaga encontrada</td>
                                                       </tr>';
?>

<main class="mt-3">
    <?= $mensagem ?>

    <section class="mb-3">
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova vaga</button>
        </a>
    </section>

    <section>
        <table class="table bg-light text-dark table-hover rounded-3 overflow-hidden">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?= $resultados ?>
            </tbody>
        </table>
    </section>
</main>
