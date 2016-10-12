        <h3><a href="index.php">Voltar</a></h3>
        <h3><a href="index.php?controlador=album&acao=novo">Novo Album</a></h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Banda</th>
                    <th>Data Lancamento</th>
                </tr>
            </thead>

        <?php
            for ($i=0; $i < count($data['albuns']); $i++) {
                $al = $data['albuns'][$i];
        ?>

            <tr>
                <td><?php echo $al['id_album']; ?></td>
                <td><?php echo $al['nome']; ?></td>
                <td><?php echo $al['banda']; ?></td>
                <td><?php echo $al['data_lancamento']; ?></td>
                <td>
                    <a href="index.php?controlador=album&id_album=<?php echo $al['id_album']; ?>&acao=editar">
                        editar
                    </a>
                    <a href="index.php?controlador=album&acao=excluir&id_album=<?php echo $al['id_album']; ?>">
                        excluir
                    </a>
                </td>
            </tr>

        <?php
            }
        ?>
        </table>