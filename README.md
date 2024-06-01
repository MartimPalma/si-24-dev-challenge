# RedLight Summer Internship 2024 - Dev Challenge

Descrição de alguns pontos do projeto:

PERFIS:
 - um utilizador pode ter dois perfis (user e admin), caso seja admin puderá adicionar, eliminar ou editar restaurantes ou francesinhas. 
 - por defeito um novo registo, é associado um perfil user. Podendo ser mudado no phpmyadmin.

MAIN GOALS:
 - todos os main goals, definidos para este projeto, foram realizados com sucesso.


SOME EXTRAS:
 - Para eliminar com soft deletable, criei uma coluna na BD , tanto na tabela francesinhas como restautantes.
 - Caso a entidade "deleted", tenha valor 1, não será mostrada na listagem de francesinhas ou restaurantes do website. <br> Ainda assim continuará na BD pudendo ser recuperada, alterando o valor para 0.
 - Todos os extras foram incorporados no projeto, com exceção do upload de foto na inserção de uma francesinha.<br>A foto associada a uma nova francesinha será uma foto padrão

# Guia de Instalação do XAMPP e Configuração de Projetos

Este documento fornece um passo a passo detalhado para instalar e configurar o XAMPP no seu sistema, bem como para configurar um projeto web e importar uma base de dados no phpMyAdmin.

<details>
  <summary><strong>Guia de Instalação do XAMPP</strong></summary>

## Baixar o XAMPP

1. Acesse o site oficial do XAMPP: [https://www.apachefriends.org/](https://www.apachefriends.org/).
2. Escolha a versão adequada para o seu sistema operacional (Windows, Linux, ou macOS).
3. Clique no botão de download correspondente.

## Executar o Instalador

1. Localize o arquivo baixado na sua pasta de Downloads.
2. Clique duas vezes no arquivo do instalador para iniciar o processo de instalação.
3. No Windows, pode ser necessário confirmar que deseja permitir que o programa faça alterações no seu dispositivo.

## Processo de Instalação

1. **Bem-vindo ao instalador**:
   - Clique em "Next" na tela de boas-vindas.

2. **Seleção de componentes**:
   - Deixe todos os componentes essenciais (Apache, MySQL, PHP, phpMyAdmin, etc.) selecionados.
   - Clique em "Next".

3. **Escolha do diretório de instalação**:
   - Escolha a pasta de instalação (padrão: `C:\xampp`).
   - Clique em "Next".

4. **Seleção de idioma**:
   - Escolha o idioma da instalação (Inglês ou Alemão).
   - Clique em "Next".

5. **Pronto para instalar**:
   - Clique em "Next" para iniciar a instalação.

6. **Instalação**:
   - Aguarde até que todos os arquivos sejam copiados e configurados.

## Finalizando a Instalação

1. **Tela de conclusão**:
   - Certifique-se de que a opção para iniciar o painel de controle do XAMPP está marcada.
   - Clique em "Finish".

## Configurar e Iniciar o XAMPP

1. **Abrir o painel de controle do XAMPP**:
   - O painel de controle do XAMPP será aberto automaticamente. Você também pode abri-lo manualmente pelo ícone na área de trabalho ou menu iniciar.

2. **Iniciar os serviços**:
   - No painel de controle, clique em "Start" ao lado de "Apache" e "MySQL".
   - As luzes indicadoras ao lado desses serviços devem ficar verdes, indicando que estão em execução.

3. **Configuração adicional (opcional)**:
   - Configure o phpMyAdmin, ajuste as configurações do PHP ou configure um domínio virtual conforme necessário.

## Verificação

1. **Testar a instalação**:
   - Abra o seu navegador e digite `http://localhost/`.
   - Você deve ver a página inicial do XAMPP, confirmando que a instalação foi bem-sucedida.

  ---

Este guia cobre os passos essenciais para instalar e configurar o XAMPP no seu sistema. Se precisar de mais informações ou ajuda adicional, consulte a documentação oficial do XAMPP no site [Apache Friends](https://www.apachefriends.org/).

</details>

<details>
  <summary><strong>Guia para Configurar um Projeto no XAMPP e Importar uma Base de Dados no phpMyAdmin</strong></summary>

## Configurar o Projeto no XAMPP

1. **Copiar os arquivos do projeto para o diretório do XAMPP**:
   - Navegue até a pasta onde você extraiu os arquivos do projeto.
   - Copie a pasta do projeto para o diretório `htdocs` dentro da pasta de instalação do XAMPP (geralmente `C:\xampp\htdocs\`).
   - Caso não encontre nenhuma pasta `htdocs` , crie uma e faça o passo anterior.

## Importar a Base de Dados no phpMyAdmin

1. **Iniciar o MySQL no XAMPP**:
   - Abra o painel de controle do XAMPP.
   - No painel de controle, clique em "Start" ao lado de "Apache" e "MySQL".

2. **Acessar o phpMyAdmin**:
   - Abra o seu navegador e digite `http://localhost/phpmyadmin`.

3. **Criar uma nova base de dados**:
   - Na interface do phpMyAdmin, clique em "Base de dados".
   - Digite o nome da nova base de dados (redlight).
   - Clique em "Criar".

4. **Importar o arquivo SQL**:
   - Selecione a base de dados recém-criada na lista à esquerda.
   - Clique na aba "Importar".
   - Clique em "Escolher arquivo" e selecione o arquivo SQL que contém a estrutura e os dados da base de dados.
   - Clique em "Executar".

## Verificar a Configuração

1. **Acessar o projeto no navegador**:
   - Abra o seu navegador e digite `http://localhost/nome_do_projeto`, onde `nome_do_projeto` é o nome da pasta do seu projeto dentro do diretório `htdocs`.

  ---

Este guia cobre os passos essenciais para descarregar e configurar um projeto web no XAMPP e importar uma base de dados no phpMyAdmin. Se precisar de mais informações ou ajuda adicional, consulte a documentação oficial do XAMPP e do phpMyAdmin.
</details>
