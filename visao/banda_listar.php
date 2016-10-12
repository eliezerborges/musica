        <h3><a href="index.php">Voltar</a></h3>
        <h3><a href="index.php?controlador=banda&acao=novo">Nova Banda</a></h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Banda</th>
                    <th>Guitarrista</th>
                    <th>Vocalista</th>
                    <th>Baterista</th>
                    <th>Genero</th>
                    <th>Operação</th>
                </tr>
            </thead>

        <?php
            for ($i=0; $i < count($data['bandas']); $i++) {
                $bd = $data['bandas'][$i];
        ?>

            <tr>
                <td><?php echo $bd['id_banda']; ?></td>
                <td><?php echo $bd['nome']; ?></td>
                <td><?php echo $bd['guitarrista']; ?></td>
                <td><?php echo $bd['vocalista']; ?></td>
                <td><?php echo $bd['baterista']; ?></td>
                <td><?php echo $bd['genero']; ?></td>
                <td>
                    <a href="index.php?controlador=banda&acao=editar&id_banda=<?php echo $bd['id_banda']; ?>">
                        editar
                    </a>
                    <a href="index.php?controlador=banda&acao=excluir&id_banda=<?php echo $bd['id_banda']; ?>">
                        excluir
                    </a>
                </td>
            </tr>

        <?php
            }
        ?>
        </table>