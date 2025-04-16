
# 🧠  CRUD de Vagas em PHP com Orientação a Objetos

Este projeto representa um marco na minha transição do paradigma **procedural** para a **programação orientada a objetos (POO)** em PHP. Ele simula um sistema de cadastro de vagas de emprego com funcionalidades completas de CRUD (Create, Read, Update, Delete), estruturado de forma modular e com boas práticas de organização.

---

## 📚 O que eu aprendi com este projeto

Antes, meus códigos eram todos escritos de forma procedural, com tudo em um único arquivo. Neste projeto, eu aprendi a:

- ✅ Aplicar **orientação a objetos** para representar entidades e lidar com o banco de dados  
- ✅ Organizar o projeto em **pastas separadas por responsabilidade** (`Entity`, `Db`, `includes`)  
- ✅ Criar **classes com propriedades privadas**, construtores e métodos de acesso (`getters`/`setters`)  
- ✅ **Abstrair** a lógica de acesso ao banco de dados de forma genérica e reutilizável  
- ✅ Fazer a **injeção de dados dinamicamente** na query com `PDO`, permitindo maior flexibilidade  
- ✅ Separar os arquivos de interface (`formulário`, `listagem`, `header`, `footer`) para reutilização  
- ✅ Entender como funciona um fluxo completo de CRUD sem depender de frameworks  

---

## 🔍 Destaque Técnico: Abstração da Classe Database

Na pasta `app/Db`, criei uma **classe `Database` genérica**, capaz de executar queries SQL com qualquer número de campos e valores, ajustando automaticamente os placeholders da query:

```php
public function insert($tabela, $dados) {
    $campos = implode(',', array_keys($dados));
    $placeholders = implode(',', array_fill(0, count($dados), '?'));
    $query = "INSERT INTO $tabela ($campos) VALUES ($placeholders)";
    // Execução usando PDO
}
```

Isso me mostrou como é possível reduzir a repetição de código, aumentar a flexibilidade e aplicar abstração com PHP OO de forma inteligente.

---

## 📁 Estrutura de Arquivos

```plaintext
CRUD-OOP-VAGAS/
├── app/
│   ├── Db/
│   │   └── Database.php         # Classe para operações com o banco (insert, update, delete, select)
│   └── Entity/
│       └── Vaga.php             # Classe que representa a entidade "Vaga" com atributos e métodos
│
├── includes/
│   ├── confirmar-exclusao.php  # Modal para confirmação de exclusão
│   ├── footer.php              # Rodapé padrão
│   ├── formulario.php          # Formulário de criação/edição
│   ├── header.php              # Cabeçalho da aplicação
│   └── listagem.php            # Tabela com as vagas cadastradas
│
├── vendor/                     # Pasta gerada pelo Composer
├── cadastrar.php               # Lógica de criação de nova vaga
├── editar.php                  # Lógica de edição de vaga
├── excluir.php                 # Lógica de exclusão de vaga
├── index.php                   # Página principal com listagem
├── composer.json               # Gerenciador de dependências
├── composer.lock
└── README.md
```

---

## ⚙️ Funcionalidades

- ➕ Criar uma nova vaga  
- 📄 Listar todas as vagas cadastradas  
- ✏️ Editar uma vaga existente  
- ❌ Excluir uma vaga com confirmação  

---

# 🗄️ Estrutura da Tabela no Banco de Dados
Este projeto utiliza uma única tabela chamada vagas. Abaixo está o script SQL necessário para criá-la:

```sql
CREATE TABLE `vagas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `ativo` enum('s','n') DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
);
```

💡 O campo ativo usa um enum para representar se a vaga está ativa ('s') ou não ('n').
O campo data é preenchido automaticamente com a data/hora da criação da vaga.

---

## 🧰 Tecnologias Utilizadas

- PHP 8+  
- MySQL  
- PDO para acesso ao banco  
- HTML5 + Bootstrap (interface)  
- Composer para estrutura e dependências  
- Paradigma POO (Orientado a Objetos)  

---

## 📷 Prévia

![CRUD em ação](./includes/previa-projeto.mp4)

---

## 📈 Minha Evolução

Antes, eu escrevia código misturando lógica e HTML em um único arquivo.  
Agora, sei estruturar um CRUD completo usando POO, com abstração, organização modular e separação de responsabilidades. Este aprendizado prepara o terreno para evoluir para padrões mais avançados como MVC, PSR-4, SOLID e integração com frameworks modernos.

---

## 📌 Este projeto é parte da minha evolução como desenvolvedor.

---

## 👨‍💻 Autor

Desenvolvido para fins de estudo por **@faber-studies**  
🎓 Estudante de Engenharia de Software  
🔗 [github.com/faber-studies](https://github.com/faber-studies) | 📸 [Instagram](https://instagram.com/fabio.estudos)

> ⚠️ Este projeto foi desenvolvido com base no conteúdo do canal do GitHub [@william-costa](https://github.com/william-costa), seguindo passo a passo junto com o professor, com foco total em compreender cada linha de código e os fundamentos da programação orientada a objetos em PHP.  
>  
> Embora o projeto original **não tenha sido criado por mim do zero**, foi utilizado como base para **aprendizado prático**, com modificações e adaptações feitas por mim com o objetivo de reforçar o entendimento, testar variações e praticar boas práticas de desenvolvimento.  
>  
> Além do material original, **busquei complementos e tirei dúvidas com outras fontes**, como vídeos no YouTube, fóruns de programação e ferramentas como o **ChatGPT**, o que me ajudou a superar dificuldades específicas e aprofundar meu conhecimento durante o processo de construção do projeto.
