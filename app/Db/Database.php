<?php 
    namespace App\Db;

    use \PDO;
    use PDOException;

    class Database{

        /**
         * Host de conexão com o banco de dados
         * @var string
         */
        const HOST = 'localhost';

        /**
         * Nome do banco de dados
         * @var string
         */
        const NAME = 'db_vagas';

        /**
         * Usuário do banco
         * @var string
         */
        const USER = 'usuario';

        /**
         * Senha de acesso ao banco de dados
         * @var string
         */
        const PASS = '123456';

        /**
         * Porta de conexão com o banco de dados
         * @var string;
         */
        const PORT = '3307';

        /**
         * Nome da tabela a ser manipulada
         * @var string
         */
        private $table;

        /**
         * Instância de conexão com o banco de dados 
         * @var PDO
         */
        private $connection;

        /**
         * Define a tabela e instancia a conexão
         * @param string $table
         */
        public function __construct($table = null){
            $this->table = $table;
            $this->setConnection();
        }

        /**
         * Método responsável por criar uma conexão com o banco de dados
         */
        private function setConnection(){
            try{
                $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME.';port='.self::PORT, self::USER, self::PASS);
                
                //Configuro o PDO pra lançar um exception sempre que ocorrer algo inesperado
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }

        /**
         * Método responsável por executar queries dentro do banco de dados
         * @param string $query
         * @param array $params
         * @return PDOStatement Como não preciso instanciá-lo não preciso declará-lo
         */
        public function execute($query, $params=[]){
            try{
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement;
            } catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }

        /**
         * Método responsável por inserir dados no banco de dados
         * @param array $values [field => value]
         * @return integer ID inserido
         */
        public function insert($values){
            //DADOS DA QUERY
            $fields = array_keys($values);
            $binds = array_pad([], count($fields), '?');
            
            //MONTA A QUERY
            $query = "insert into ". $this->table . " (" .implode(',',$fields). ") values (".implode(',',$binds) .")";
            #echo "<pre>"; print_r($query); echo "</pre>"; exit;
            
            //EXECUTA O INSERT
            $this->execute($query, array_values($values));

            return $this->connection->lastInsertId();
        }

        /**
         * Método responsável por executar uma consulta no banco
         * @param string $where
         * @param string $order
         * @param string $limit
         * @return PDOStatement
         */
        public function select($where = null, $order = null, $limit = null){
            //DADOS DA QUERY
            $where = strlen($where) ? 'WHERE '.$where : '';
            $order = strlen($order) ? 'ORDER BY '.$order : '';
            $limit = strlen($limit) ? 'LIMIT ' .$limit : '';

            //MONTA A QUERY
            $query = 'select * from '.$this->table.' '.$where.' '.$order.' '.$limit;

            //EXECUTA A QUERY
            return $this->execute($query);

        }

        /**
         * Método responsável por executar atualizações no banco de dados
         * @param string $where
         * @param array $values [ field => value ]
         * @return boolean
         */
        public function update($where, $values){
            //DADOS DA QUERY
            $fields = array_keys($values);

            //MONTA A QUERY
            $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
            
            //EXECUTAR A QUERY
            $this->execute($query, array_values($values));

            //RETORNA SUCESSO
            return true;
        }

        /**
         * Método responsável por excluir dados do banco
         * @param string $where
         * @return boolean
         */
        public function delete($where){
            //MONTA A QUERY
            $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

            //EXECUTA A QUERY
            $this->execute($query);

            //RETURNA SUCESSO
            return true;
        }

    }