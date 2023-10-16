# BlacoSystem
Visão Geral:

Este aplicativo é uma plataforma de denúncia ao racismo, desenvolvida usando as linguagens JavaScript, PHP por meio dos frameworks jQuery e PHP. O projeto é inicialmente um website convertido em uma Progressive Web App (PWA). Ele permite que os usuários relatem incidentes de racismo de forma rápida e fornece uma interface para a gestão de denúncias.

Instalação:

Requisitos:

- Servidor web com suporte ao PHP.
- Banco de dados MySQL.

- Clone o repositório do aplicativo do GitHub:
```bash
    git clone https://github.com/seu-usuario/nome-do-repositorio.git
```

- Importe o arquivo SQL fornecido [(database.sql)] (https://drive.google.com/file/d/1v49QwXoZaxDWzsL65ROBhYXhFi5aLLjQ/view?usp=sharing)para criar o banco de dados.
- Configure as credenciais do banco de dados no arquivo application/config/database.php.

Uso:

- Acesse o aplicativo através do navegador. --> https://blaco.com.br/
- Instale o app a partir da modal ou utilize apenas o website

Funcionalidades Principais:

- Página Inicial: Tenha uma visão geral das funcionalidades do aplicativo.
- Denunciar: Preencha o formulário de denúncia, incluindo detalhes e evidências.
- Mapa: Acesse as delegacias da cidade e veja a mais próxima de sua localização.
- Aba didática: Aprenda ou divulgue sobre conceitos e leis que lidam com o racismo no Brasil.
- Gerenciamento de Denúncias: Administre as denúncias recebidas por meio de planilhas e dashboards.
- Login: Acesse a área de usuário ou de administração com autenticação.

Arquitetura:

O aplicativo é construído usando o framework CodeIgniter, que segue uma arquitetura MVC (Model-View-Controller). As principais partes incluem:

- Model: Lida com a lógica de negócios e interage com o banco de dados.
- View: Responsável pela interface do usuário e apresentação dos dados.
- Controller: Gerencia a comunicação entre a Model e a View.
- Pasta utils: Contém arquivos JS e CSS que irão tratar do uso dos usuários

Progressive Web App (PWA):

Este aplicativo também é uma PWA, o que significa que os usuários podem instalá-lo em seus dispositivos móveis e acessá-lo offline. Ele oferece uma experiência de aplicativo nativo com funcionalidades offline.

Contribuição:

*Se desejar contribuir para o projeto, siga as diretrizes de contribuição no arquivo CONTRIBUTING.md.*

Resolução de Problemas:
*Em caso de problemas ou dúvidas, entre em contato com nossa equipe de suporte em suporte@blaco.com.br*
