# BLACO
<p align="center"><img align="center" width="200px" src="/utils/img/logo-blaco-branca.svg"/></p>
<p align="center">
  <img src="https://skillicons.dev/icons?i=php,js,jquery,bootstrap,html,css&perline=3" />
  <br/>
  <a href="https://github.com/BlacoDenuncia/BlacoSystem/releases/download/beta/BLACO.-.Tecnologia.Antirracista.apk"><kbd>🔵 download</kbd></a> <a href="https://blaco.com.br"><kbd>🟢 website</kbd></a>
</p>
<br></br>

## :question: O que é o BLACO?

Este aplicativo é uma plataforma de denúncia ao racismo, projetado para auxiliar vítimas inicialmente da região de Contagem. Você pode conferir o funcionamento em <a href="https://blaco.com.br"><kbd>blaco.com.br</kbd></a>

O nome da aplicação surgiu de nome anterior do projeto: Black Consciousness. Após recebermos alguns feedbacks, decidimos "abrasileirar" o nome, facilitando a pronuncia e dando nossa própria identidade ao projeto.

## 🔥 Funcionalidades

- Visualize todas as delegacias da região e saiba a mais próxima da sua localização atual
- Possibilidade de login, preenchimento de dados previamente para reutilizar mais tarde e acesso a denúncias anteriores
- Por meio do preenchimento de um formulário, possibilitamos a denúncia e realizamos o envio de uma cópia dos dados no email pessoal
- Uma página de conteúdos dinamica e informativa
- Para administradores, tenha acesso a dados de denúncias recentes e crie novos posts de conteúdos

## :dizzy: Propósito

Este projeto iniciou-se durante o Curso Técnico em Informática da FUNEC com o objetivo de ser apresentado na Mostra de Tecnologia da instituição. Durante os dois anos de desenvolvimento o projeto se expandiu e o grupo se comprometeu em continuar desenvolvendo e aprimorando o projeto, o que envolve aumentar o conhecimento técnico e humano nas diversas áreas relacionadas.

O propósito do projeto é, acima de tudo, permitir que pessoas que se sintam inseguras de denunciar casos repugnantes de discriminação racial e racismo façam a denúncia de forma rápida, segura e se desejado, anônima. Almejamos, também, que o software tenha integração com orgãos de defesa e segurança nacional como a Polícia Civil, Polícia Federal e/ou polícia militar.

## ⚠️ Limitações
- As atualizações no código podem não ser exibidas automaticamento por conta do armazenamento de cache da PWA
- O armazenamento de dados e informações AINDA não possui alto nível de segurança 

## :dna: Estrutura do projeto
- O projeto segue o padrão de design MVC, onde separamos o Model ( tratamento de dados e ações no Banco de Dados ), Views ( a interface ) e Controller ( Lógica da aplicação )
- O projeto utiliza o framework CodeIgniter. As configurações de banco de dados, de url e autoload são feitas na pasta /config e serão especificadas na seção configurando
- As views são carregadas em cada controller utilizando a biblioteca Template, que as carrega a partir de uma página principal
- Arquivos de imagem, scripts e estilos podem ser encontrados na pasta /utils

## :grey_exclamation: Como rodar localmente

### Avisos importantes: 
- A aplicação utiliza as APIS do google maps e do tiny editor. As chaves de API estão armazenadas no servidor próprio e para usar as funcionalidades do mapa e de criação de posts, você deve configurar suas próprias chaves e inclui-las em um arquivo .env no diretório principal.
  
### Requisitos

- Servidor web com suporte ao PHP 8 +.
- Banco de dados MySQL.

- Clone o repositório do aplicativo do GitHub:
```bash
    git clone https://github.com/BlacoDenuncia/BlacoSystem.git
```

- Importe o arquivo SQL fornecido [(database.sql)] (https://drive.google.com/file/d/1v49QwXoZaxDWzsL65ROBhYXhFi5aLLjQ/view?usp=sharing) para criar o banco de dados.

## Configurações
### Configurando o ambiente CodeIgniter
Faça as configurações de url base no arquivo /application/config/config.php. Atualize, por exemplo, para https://localhost/. Essa configuração é necessária para que os caminhos de arquivos funcionem adquadamente.

Configure as credenciais de banco de dados para permitir acesso do PHP no arquivo /application/config/database.php incluindo nome do banco de dados, username e password. Em um servidor localhost padrão pode configurar como abaixo:
```bash
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'database_name',
```
- A biblioteca template já está instalada e configurada nesse repositório.

### Bibliotecas
O projeto utiliza de bibliotecas PHP como PHPMailer, PHPOffice/phpspreadsheet, phpdotenv e dropzone.
Faça a instalação local de cada uma delas. Recomendamos a instalação por meio do composer.
Referências:
- [(Como instalar o composer)] (https://getcomposer.org/download/)
- [(Instalação PHPMailer)] (https://github.com/PHPMailer/PHPMailer)
- [(Instalação PHPOffice)] (https://github.com/PHPOffice/PhpSpreadsheet)
- [(Instalação phpdotenv)] (https://github.com/vlucas/phpdotenv/blob/master/README.md)
- [(Instalação dropzone)] (https://docs.dropzone.dev/getting-started/installation/composer)

### Progressive Web App (PWA):

Este aplicativo também é uma PWA, o que significa que os usuários podem instalá-lo em seus dispositivos móveis e acessá-lo offline. Ele oferece uma experiência de aplicativo nativo com funcionalidades offline.

O arquivo de configuração dos metadados da PWA localiza-se no diretório principal ( manifest.json ) e o arquivo de configurações, como de cache, na mesma pasta, chama-se sw.js

## :satellite: Tecnologias utilizadas
CodeIgniter 3 
Bootstrap 5 
JQuery 3 
PHP 8 
Google Maps API 
Tiny Editor API 
Dropzone.js

- Utilizamos o conceito de PWA para permitir que o app seja instalado a partir do Chrome e possa ser colocado em lojas de aplicativos

## :bulb: Contribuição:
Se desejar contribuir para o projeto:

- Tenha em mente que precisará de acesso às suas próprias chaves de API para algumas das funcionalidades.
- Faça um fork do projeto e abra um pull request detalhando as mudanças.
- No caso de ter encontrado algum bug, tente abrir uma issue para correção dos desenvolvedores do aplicativo.

Resolução de Problemas:

*Em caso de problemas ou dúvidas, entre em contato com nossa equipe de suporte em suporte@blaco.com.br*
