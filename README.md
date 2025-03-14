
# Projeto Laravel com Controle de Acesso e Permissões

Este projeto foi desenvolvido com Laravel e foi projetado para gerenciar roles (papéis) e permissões. Ele inclui um usuário administrador por padrão e um role de admin, que são criados por meio de seeders. Siga os passos abaixo para baixar, configurar e executar o projeto corretamente.

## Passos para Instalar e Executar

1. **Clonar o projeto do GitHub para sua máquina local**:
   - Clone o repositório usando o comando:
     ```bash
     git clone https://github.com/amdress/autoGestorPermissions.git
     ```
2. **Instalar as dependências PHP**:
   - Este projeto requer que você instale as dependências PHP definidas no arquivo `composer.json`. Execute o seguinte comando para instalar todas as dependências necessárias:
     ```bash
     composer install
     ```
   - Abra o arquivo `.env` e configure os valores necessários, como a conexão com o banco de dados. Certifique-se de atualizar esses valores conforme sua configuração local (por exemplo, o nome do banco de dados "autogestor").
   - Laravel precisa de uma chave única para a aplicação, que é salva no arquivo `.env`. Execute o seguinte comando para gerar esta chave:
     ```bash
     php artisan key:generate
     ```

3. **Instalar as dependências JavaScript**:
   - Este projeto utiliza o Laravel Breeze e seu sistema de autenticação que usa o Tailwind CSS. Portanto, instale as dependências JavaScript com o comando:
     ```bash
     npm install
     ```
   - É recomendado compilar com:
     ```bash
     npm run dev
     ```

4. **Executar as migrações para criar as tabelas no banco de dados**:
   - Execute o comando para criar as tabelas:
     ```bash
     php artisan migrate
     ```

5. **Criar os roles e o usuário admin com o Seeder**:
   - O projeto inclui roles e um usuário administrador por padrão, que são criados através de seeders. Execute o comando para inserir esses dados iniciais no banco de dados:
     ```bash
     php artisan db:seed
     ```

6. **Iniciar o servidor local de desenvolvimento**:
   - Depois de tudo configurado, inicie o servidor de desenvolvimento local do Laravel com o seguinte comando:
     ```bash
     php artisan serve
     ```
   - Em uma outra janela do terminal, execute:
     ```bash
     npm run dev
     ```

## Como Usar o Projeto

Ao iniciar o sistema, você verá um formulário para fazer login. O usuário padrão é:

- **Usuário**: `admin@example`
- **Senha**: `password123`

Dentro da aplicação, você verá seções como o **Dashboard**, **Users**, **Roles**, **Permissions**, e a seção de **Articles**, onde será possível testar os roles e permissões.

### Funções do Administrador

Como administrador, você tem o poder de:

- Criar, editar, excluir e listar **Usuários**.
- Criar, editar, excluir e listar **Roles**.
- Criar, editar, excluir e listar **Permissões**.

Se desejar criar permissões para a seção de **Articles**, elas devem ser:

- `view articles`
- `edit articles`
- `delete articles`
- `create articles`

Depois de criar essas permissões, volte à lista de permissões e você verá as permissões criadas. Vá para a seção de **Roles**, selecione **Editar** no role "Admin", e verá uma lista de permissões já selecionadas. Os novos permissões que você criou estarão lá, e basta marcá-los para dar ao administrador acesso completo ao CRUD de artigos.

### Criar Novos Usuários

Ao criar um novo usuário, ele não terá nenhum role atribuído por padrão. Você, como administrador, precisará criar um role, atribuir permissões a esse role e, em seguida, atribuir esse role ao usuário.

Se um usuário criar uma conta em uma janela anônima, você precisará acessar o painel administrativo, criar um role para ele (se necessário), atribuir permissões ao role e, por fim, atribuir o role ao novo usuário ou atribuir um role existente.

### Seções de Produtos, Marcas e Categorias

Além de **Articles**, o projeto inclui as seções de **Products**, **Brands** e **Categories**, onde você pode apenas criar permissões do tipo `view[]` (exemplo: `view brands`). O mesmo se aplica a **Products** e **Categories**.

---

Este projeto foi criado com o objetivo de uma entrevista de trabalho para uma empresa. Todos os direitos reservados.

Contato: amdresscavacal@gmail.com
