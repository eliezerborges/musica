<?php
    $bd = isset($data['bandas']) ? $data['bandas'] : new Banda();

    $erro = isset($data['erro']) ? $data['erro'] : '';

?>

        <form>
                <fieldset>
                    <legend>Excluir Banda</legend>
                    <input type="hidden" name='id' value="<?php echo $bd->getId(); ?>" disabled />
                    <input type="hidden" name='id' value="<?php echo $bd->getId(); ?>" />
                    <p>
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php echo $bd->getNomeBanda();?>"/>
                    </p>
                    <p>
                        <label>Guitarrista</label>
                        <input type="text" name="guitarrista" value="<?php echo $bd->getGuitarrista();?>"/>
                    </p>
                    <p>
                        <label>Vocalista</label>
                        <input type="text" name="vocalista" value="<?php echo $bd->getVocalista();?>"/>
                    </p>
                    <p>
                        <label>Baterista</label>
                        <input type="text" name="baterista" value="<?php echo $bd->getBaterista();?>"/>
                    </p>
                    <p>
                        <label>Genero</label>
                        <input type="text" name="genero" value="<?php echo $bd->getGenero();?>"/>
                    </p>
                    <a href="index.php?controlador=banda">Cancelar</a> -
                    <a href="index.php?controlador=banda&acao=excluir&confirmado=sim&id_banda=<?php echo $bd->getId();?>">Excluir</a>
            </fieldset>
        </form>