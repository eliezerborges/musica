public function listar() {
        $al = new Album();
        $data['albuns'] = $al->all();
        $albuns_com_bandas = $this->nomesBandas($data['albuns']);
        $this->render('visao/album_listar.php', $albuns_com_bandas);
    }

    public function nomesBandas($data){
       for ($i=0; $i < count($data['albuns']); $i++) {
            $db = Database::getInstance()->getConnection();
            $sql = 'SELECT nome FROM bandas WHERE id_banda = :id_banda ';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_banda', $data['id_banda'], PDO::PARAM_STR);

            $stmt->execute();
            $res= $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
