<?php
    $ms = isset($data['musicas']) ? $data['musicas'] : new Musica();
    $al = isset($data['albuns']) ? $data['albuns'] : new Album();
    $bd = isset($data['bandas']) ? $data['bandas'] : new Banda();

    $erro = isset($data['erro']) ? $data['erro'] : '';

?>

        <form action="index.php?controlador=musica&acao=<?php echo $data['acao']?>" method="POST">
            <fieldset>
                <legend>Nova Musica</legend>
                <p class="error"><?php echo $erro; ?></p>
                <input type="hidden" name='id' value="<?php echo $ms->getId(); ?>" />
                <p>
                    <label>Nome</label>
                    <input type="text" name="nome" value="<?php echo $ms->getNomeMusica();?>"/>
                </p>
                <p>
                    <label>Album:</label>
                    <select name="id_album">
                        <option value="">Selecione...</option>
                        <?php
                            for ($i=0; $i < count($data['albuns']); $i++) {
                                $al = $data['albuns'][$i];
                        ?>
                            <option value="<?php echo $al['id_album']; ?>"
                                <?php
                                    if($ms->getIdAlbum() == $al['id_album']){ echo "selected";}
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
                        <option value="">Selecione...</option>
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
                    <input type="date" name="data_lancamento" value="<?php echo $ms->getData_lancamento();?>"/>
                </p>
                <p>
                    <label>Genero</label>
                    <input type="text" name="genero" value="<?php echo $ms->getGenero();?>"/>
                </p>
                <input type="submit" name="salvar" value="Salvar"/>
                <a href="index.php?controlador=musica">Cancelar</a>
            </legend>
        </form>