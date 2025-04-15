<?php
    namespace App\Entity;
    
    use \App\Db\Database;
    use \PDO;

    class Vaga{

        /**
         * Identificador único da vaga
         * @var integer
         */
        public $id;

        /**
         * Título da vaga
         * @var string
         */
        public $titulo;

        /**
         * Descrição da vaga (pode conter html)
         * @var string
         */
        public $descricao;

        /**
         * Define se a vaga está ativa
         * @var string(s/n)
         */
        public $ativo;

        /**
         * Data de publicação da vaga
         * @var string
         */
        public $data;

        /**
         * Método responsável por cadastrar uma nova vaga
         * @return boolean
         */
        public function cadastrar(){
            //DEFINIR A DATA
            $this->data = date('Y-m-d H:i:s');

            //INSERIR A VAGA NO BANCO DE DADOS
            $obDatabase = new Database('vagas');
           
             //ATRIBUIR O ID DA VAGA NA INSTÂNCIA
            $this->id = $obDatabase->insert([
                'titulo'    =>$this->titulo,
                'descricao' =>$this->descricao,
                'ativo'     =>$this->ativo,
                'data'      =>$this->data
            ]);
            #echo "<pre>"; print_r($this); echo "</pre>"; exit;
           
            return true;   
        }

        /**
         * Método responsável por obter as vagas do banco de dados
         * @param string $where
         * @param string $order
         * @param string $limit
         * @return array
         */

         /**
          * Método responsável por atualizar a vaga no banco de dados
          * @return boolean
          */
        public function atualizar(){
            return (new Database('vagas'))->update('id = '.$this->id, [
                'titulo'    =>$this->titulo,
                'descricao' =>$this->descricao,
                'ativo'     =>$this->ativo,
                'data'      =>$this->data
            ]);
        }

        /**
         * Método responsável por excluir a vaga do banco de dados
         * @return boolean
         */
        public function excluir(){
            return (new Database('vagas'))->delete('id='.$this->id);
        }

        public static function getVagas($where = null, $order = null, $limit = null){
            return (new Database('vagas'))->select($where, $order, $limit)
                                          ->fetchALL(PDO::FETCH_CLASS, self::class);
        }

        /**
         * Método responsável por buscar uma vaga com base em seu id
         * @param integer $id
         * @return Vaga
         */
        public static function getVaga($id){
            return (new Database('vagas'))->select('id = '.$id)
                                          ->fetchObject(self::class);
        }
    }