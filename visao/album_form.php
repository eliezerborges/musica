<?php
    $al = isset($data['albuns']) ? $data['albuns'] : new Album();
    $bd = isset($data['bandas']) ? $data['bandas'] : new Banda();

    $erro = isset($data['erro']) ? $data['erro'] : '';

?>

        <form action="index.php?controlador=album&acao=<?php echo $data['acao'];?>" method="POST">
            <fieldset>
                <legend>Novo Album</legend>
                <p class="error"><?php echo $erro; ?></p>
                <p>
                    <label>Banda:</label>
                    <select name="id_banda">
                        <option value="">Selecione...</option>
                        <?php
                            for ($i=0; $i < count($data['bandas']); $i++) {
                                $bd = $data['bandas'][$i];
                        ?>
                            <option value="<?php echo $bd['id_banda']; ?>"
                                <?php
                                    if($al->getIdBanda() == $bd['id_banda']){ echo "selected";}
                                ?>
                            ><?php echo $bd['nome']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </p>
                <input type="hidden" name='id_album' value="<?php echo $al->getId(); ?>" />
                <p>
                    <label>Nome</label>
                    <input type="text" name="nome" value="<?php echo $al->getNome();?>"/>
                </p>
                
                <p>
                    <label>Data lancamento</label>
                    <input type="date" name="data_lancamento" value="<?php echo $al->getData_lancamento();?>"/>
                </p>
                
                <input type="submit" value="Salvar"/>
                <a href="index.php?controlador=album">Cancelar</a>
            </legend>
        </form>