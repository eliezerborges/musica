<?php
    $bd = isset($data['bandas']) ? $data['bandas'] : new Banda();

    $erro = isset($data['erro']) ? $data['erro'] : '';

?>

        <form action="index.php?controlador=banda&acao=<?php echo $data['acao']?>" method="POST">
            <fieldset>
                <legend>Nova Banda</legend>
                <p class="error"><?php echo $erro; ?></p>
                <input type="hidden" name='id_banda' value="<?php echo $bd->getId(); ?>" />
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
                <input type="submit" name="salvar" value="Salvar"/>
                <a href="index.php?controlador=banda">Cancelar</a>
            </legend>
        </form>