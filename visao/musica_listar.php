        <h3><a href="index.php">Voltar</a></h3>
        <h3><a href="index.php?controlador=musica&acao=novo">Nova Musica</a></h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Banda</th>
                    <th>Album</th>
                    <th>Data Lançamento</th>
                    <th>Genero</th>
                    <th>Operação</th>
                </tr>
            </thead>

        <?php
            for ($i=0; $i < count($data['musicas']); $i++) {
                $ms = $data['musicas'][$i];
        ?>

            <tr>
                <td><?php echo $ms['id']; ?></td>
                <td><?php echo $ms['nome']; ?></td>
                <td><?php echo $ms['banda']; ?></td>
                <td><?php echo $ms['album']; ?></td>
                <td><?php echo $ms['data_lancamento']; ?></td>
                <td><?php echo $ms['genero']; ?></td>
                <td>
                    <a href="index.php?controlador=musica&acao=editar&id=<?php echo $ms['id']; ?>">
                        editar
                    </a>
                    <a href="index.php?controlador=musica&acao=excluir&id=<?php echo $ms['id']; ?>">
                        excluir
                    </a>
                </td>
            </tr>

        <?php
            }
        ?>
        </table>