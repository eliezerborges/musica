<?php
    $al = isset($data['albuns']) ? $data['albuns'] : new Album();
    $bd = isset($data['bandas']) ? $data['bandas'] : new Banda();

    $erro = isset($data['erro']) ? $data['erro'] : '';

?>

        <form>
                <fieldset>
                    <legend>Excluir Album</legend>
                    <input type="hidden" name='id' value="<?php echo $al->getId(); ?>" disabled />
                    <p>
                    <label>Banda:</label>
                        <select name="id_banda">
                            <option value="">Selecione...</option>
                            <?php
                                for ($i=0; $i < count($data['bandas']); $i++) {
                                    $bd = $data['bandas'][$i];
                            ?>
                                <option value="<?php echo $bd['id_banda']; ?>"><?php echo $bd['nome']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php echo $al->getNome();?>"/>
                    </p>
                    <p>
                        <label>Data Lancamento</label>
                        <input type="text" name="data_lancamento" value="<?php echo $al->getData_Lancamento();?>"/>
                    </p>
                    <a href="index.php?controlador=banda">Cancelar</a> -
                    <a href="index.php?controlador=album&acao=excluir&confirmado=sim&id_album=<?php echo $al->getId();?>">Excluir</a>
            </fieldset>
        </form>