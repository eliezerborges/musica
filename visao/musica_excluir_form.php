<?php
    $ms = isset($data['musicas']) ? $data['musicas'] : new Musica();
    $al = isset($data['albuns']) ? $data['albuns'] : new Album();
    $bd = isset($data['bandas']) ? $data['bandas'] : new Banda();

    $erro = isset($data['erro']) ? $data['erro'] : '';

?>

        <form>
                <fieldset>
                    <legend>Excluir Musica</legend>
                    <input type="hidden" name='id' value="<?php echo $ms->getId(); ?>" disabled />
                    <input type="hidden" name='id' value="<?php echo $ms->getId(); ?>" />
                    <p>
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php echo $ms->getNomeMusica();?>"/>
                    </p>
                    <p>
                        <label>Album:</label>
                        <select name="id_album">
                            <?php
                                for ($i=0; $i < count($data['albuns']); $i++) {
                                    $al = $data['albuns'][$i];
                            ?>
                                <option value="<?php echo $al['id_album']; ?>"
                                    <?php
                                        if($ms->getIdBanda() == $al['id_album']){ echo "selected";}
                                    ?>
                                ><?php echo $al['nome']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label>Banda:</label>
                        <select name="id_banda">
                            <?php
                                for ($i=0; $i < count($data['bandas']); $i++) {
                                    $bd = $data['bandas'][$i];
                            ?>
                                <option value="<?php echo $bd['id_banda']; ?>"
                                    <?php
                                        if($ms->getIdBanda() == $bd['id_banda']){ echo "selected";}
                                    ?>
                                ><?php echo $bd['nome']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </p>
                    
                    <p>
                        <label>Data de Lançamento</label>
                        <input type="text" name="data_lancamento" value="<?php echo $ms->getData_lancamento();?>"/>
                    </p>
                    <p>
                        <label>Genero</label>
                        <input type="text" name="genero" value="<?php echo $ms->getGenero();?>"/>
                    </p>
                    <a href="index.php?controlador=musica">Cancelar</a> -
                    <a href="index.php?controlador=musica&acao=excluir&confirmado=sim&id=<?php echo $ms->getId();?>">Excluir</a>
            </fieldset>
        </form>