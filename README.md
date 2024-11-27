# Gerenciador de Tarefas - CakePHP 5

## Descrição

Este é um sistema de gerenciamento de tarefas desenvolvido em **CakePHP 5.x**, com funcionalidades de **login**, **cadastro**, **edição** e **exclusão de tarefas**. Além disso, o sistema envia notificações por **e-mail** quando uma tarefa é criada e é possível exportar os dados no formato **xlsx**.

## Observação:
Gostaria de destacar que este projeto foi desenvolvido após apenas 4 dias de estudo do CakePHP, sendo minha primeira experiência com este framework. Por esse motivo, é possível que o projeto não esteja completamente alinhado com as melhores práticas recomendadas para CakePHP, já que minha experiência maior e recente está focada no Laravel.

## Versão Laravel  

Desenvolvi uma versão aprimorada deste projeto utilizando o framework **Laravel**, que gostaria de destacar como o principal foco a ser considerado neste teste. Essa versão inclui algumas funcionalidades extras. Você pode conferir o repositório no GitHub:  
[Manager Task List - Laravel](https://github.com/calesj/manager-task-list-laravel)

## Referências  

Nesta seção estão listados os materiais e recursos que foram utilizados como referência durante o desenvolvimento deste projeto.

- [Curso de CakePHP no YouTube](https://www.youtube.com/watch?v=1F3DffI3eHs&list=PLyugqHiq-SKf8m05vApCcvpJQ-uPBDxbN)
- [Como utilizar o pacote PhpSpreadsheet / excel com CakePHP 4](https://sab-exp.medium.com/how-to-use-phpspreadsheet-with-cakephp-4-71c0a65cc698)
- [Aula Autenticação com CakePHP](https://www.youtube.com/watch?v=xtiK-dlDOTA)
- [Criando arquivos Excel XLSX com a lib PHPSpreadsheet - WDEV](https://www.youtube.com/watch?v=H9nWjmRcrIQ)


## Funcionalidades

- Login de usuarios.
- Edição e exclusão de tarefas.
- Exibição e filtragem de tarefas.
- Exportação de dados para **Excel**.
- Envio de notificações por **e-mail**.

## Requisitos

- **PHP 8 ou superior**.
- **CakePHP 5.x**.
- **Composer** para gerenciamento de dependências.

## Instalação

### Passo 1: Clonar o Repositório

Clone o repositório do GitHub para a sua máquina local:

```bash
git clone https://github.com/calesj/manager-task-list-cakephp.git
cd manager-task-list-cakephp
```

### Passo 2: Instalar as Dependências

Instale as dependências do projeto usando o Composer:

```bash
composer install
```

### Passo 3: Configuração do Banco de Dados

- Crie um banco de dados MySQL (ou outro de sua escolha) com o nome de sua preferência.
- Configure a conexão com o banco de dados no arquivo ``` config/app_local.php ```:

```bash
    'Datasources' => [
        'default' => [
            'host' => 'localhost',

            'username' => 'root',
            'password' => '',

            'database' => 'cake_tasklist',

            'url' => env('DATABASE_URL', null),
        ],

        ...
    ],
```

### Passo 4: Configuração do Envio de E-mail

- Configure as credenciais de envio de e-mail no arquivo  ``` config/app.php ``` na chave ``` email ```:
#### Utilizei o smtp do gmail para o teste

```bash
    'EmailTransport' => [
        'default' => [
            'className' => MailTransport::class,
            /*
             * The keys host, port, timeout, username, password, client and tls
             * are used in SMTP transports
             */
            'host' => 'localhost',
            'port' => 25,
            'timeout' => 30,
            /*
             * It is recommended to set these options through your environment or app_local.php
             */
            //'username' => null,
            //'password' => null,
            'client' => null,
            'tls' => false,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],

        'email' => [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'username' => 'seu email',
            'password' => 'sua senha de app',
            'tls' => true,
            'className' => 'Smtp',
        ],
    ],
```


### Passo 5: Rodando as Migrations e Seeders
- Rodar as migrations:
```bash
bin/cake migrations migrate
```

- Rodar os seeders:
  - Criar um usuário padrão
    ```bash
    bin/cake migrations seed --seed UsersSeed
    ```
  - Criar dados falsos para tarefas
    ```bash
    bin/cake migrations seed --seed TasksSeed
    ```


### Passo 6: Acessando o Projeto

```bash
php -S localhost:8000
```

### Tela Inicial
Basta fazer o login
![image](https://github.com/user-attachments/assets/df53e430-f74c-42c4-b641-3ee6ddac02bb)

### Acessando as tarefas:

![image](https://github.com/user-attachments/assets/bba19053-d96e-4837-9a75-ccafdd347a2f)

### Ao clicar em exportar:

![image](https://github.com/user-attachments/assets/5d9d15ea-565d-4235-a806-73723796880c)

### Filtragem ( Nesse caso por todas que estiverem concluida)

![image](https://github.com/user-attachments/assets/9a91686c-e4c2-4930-a70f-e7eddafd80d6)

### Cadastrar Tarefa
![image](https://github.com/user-attachments/assets/19a5e09c-7a9b-43e9-982d-cc862105f4a0)

Email Recebido:
![image](https://github.com/user-attachments/assets/ced58318-597f-41f1-9eb1-7dbf1681cb15)


### Editar Tarefa
![image](https://github.com/user-attachments/assets/cceea426-4f4c-4d38-8042-4db5a7248d9b)

### Excluir Tarefa
![image](https://github.com/user-attachments/assets/996c52e7-21f6-45ea-8a32-734a720b2587)





