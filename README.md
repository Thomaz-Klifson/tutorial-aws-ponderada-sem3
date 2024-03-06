## Gerenciamento de Produtos na AWS

Este repositório contém a aplicação para gerenciar produtos em um banco de dados. A aplicação pode ser utilizada tanto com um banco de dados criado pelo próprio desenvolvedor quanto com um banco de dados RDS na AWS.

### Pré-requisitos

* Conhecimento básico de PHP e MySQL
* Conta AWS (opcional, para utilização do RDS)

### Instalação

1. Clone o repositório:

```
git clone https://github.com/seu-usuario/gerenciamento-produtos.git
```

2. (Opcional) Se for utilizar o RDS, configure os dados de acesso ao banco na pasta `inc/dbinfo.inc`.

### Utilização

1. **Com banco de dados local:**

    * Crie um banco de dados MySQL localmente.
    * Edite o arquivo `inc/dbinfo.inc` e preencha as informações de conexão com o seu banco de dados local.
    * Inicie um servidor web local (como Apache ou Nginx) e aponte a raiz do projeto para o diretório do repositório.
    * Acesse a aplicação através do seu navegador em `http://localhost/[seu_diretorio_virtual]`.

2. **Com banco de dados RDS:**

    * Crie um banco de dados RDS na AWS.
    * Anote o endpoint, nome de usuário, senha e nome do banco de dados.
    * Edite o arquivo `inc/dbinfo.inc` e preencha as informações de conexão com o seu banco RDS.
    * Implemente a sua aplicação em um servidor web na AWS (como EC2 ou Elastic Beanstalk).
    * Acesse a aplicação através do seu navegador utilizando o endereço público do seu servidor.

### Vídeo tutorial

`https://drive.google.com/file/d/1OF4Hsi2ucjFSH4v91RJ3SqnssqEJE_fG/view?usp=sharing`

### Link da aplicação desenvolvida:
http://ec2-44-194-4-55.compute-1.amazonaws.com/SamplePage.php

### Funcionalidades

A aplicação permite:

* Cadastrar novos produtos informando nome, preço, quantidade e data de adição.
* Visualizar a lista de produtos cadastrados.

### Banco de dados

A aplicação utiliza o banco de dados MySQL para armazenar os dados dos produtos. A tabela utilizada é `Produtos`, que possui as seguintes colunas:

* `id` (INT AUTO_INCREMENT PRIMARY KEY): Identificador único do produto.
* `nome` (VARCHAR(100)): Nome do produto.
* `preco` (DECIMAL(10,2)): Preço do produto.
* `quantidade` (INT): Quantidade em estoque do produto.
* `data_adicao` (DATE): Data de adição do produto.

### Considerações

* Este exemplo utiliza uma conexão básica ao banco de dados e não implementa práticas de segurança avançadas.
* Para uma aplicação em produção, é importante implementar mecanismos de autenticação e validação de dados para garantir a segurança e integridade dos dados.

