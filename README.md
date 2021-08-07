# Management
A proposta para esse projeto foi o desenvolvimento de uma aplicação PHP que realizasse desde o cadatro do usuário até sua remoção no banco de dados, ou seja, CRUD completo. Por isso a aplicação possui as funcionalidade de:
- Cadastro;
- Autenticação;
- Edição dos dados do usuário;
- Pesquisa por usuários;
- Remoção de usuário.<br/>

Para o front-end foi esperado páginas completas.<br/><br/>

## :sparkles: Front-end

<img align="right" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg" alt="HTML5" width="30" height="30" style="margin-left: auto"/>

### Estrutura

A páginas são estruturadas semanticamente através do HTML5.

<img align="right" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/sass/sass-original.svg" alt="Sass" width="30" height="30"/><img align="right" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/bootstrap-plain.svg" alt="Bootstrap5" width="30" height="30"/><img align="right" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original.svg" alt="CSS3" width="30" height="30"/>

### Estilos

Há muitos estilos escritos independentemente para cada tema da aplicação. No entanto, o _core_ dos estilos é o Bootstrap5, manipulado através do Sass para extrair apenas o necessário à aplicação.

<img align="right" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/jquery/jquery-plain-wordmark.svg" alt="jQuery" width="30" height="30"/><img align="right" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="JavaScript" width="30" height="30"/>

### Scripts
Em todos os scripts é utilizado o jQuery, tanto para interação com o DOM quanto para requisições ***Ajax***.<br/><br/>

## :gear: Back-end

<img align="right" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/composer/composer-original.svg" alt="Composer" width="30" height="30"/><img align="right" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="PHP" width="30" height="30"/>

### Código

Todo o back-end funciona em PHP(POO) utilizando o Composer e obedecendo a estrutura ***MVC***. Não há uso de _framework_, ou seja, é PHP puro, mas recebe auxilio de alguns _packages_ para rotas, _views_ e minificação de arquivos. Nas camadas do aplicativo e painel administrativo pode ser obeservado todo o ***CRUD*** e **autenticação** funcionando.

<img align="right" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/apache/apache-original-wordmark.svg" alt="Apache" width="30" height="30"/>

### Servidor

O servidor é o Apache.

<img align="right" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="MySQL" width="30" height="30"/>

### Bando de Dados

O bando de dados utilizado é o MySQL.<br/><br/>

## :open_book: Especificações

- Ambiente padrão do XAMPP;
- O arquivo "datamodel.sql" contém as instruções necessárias para a criação das tabelas.
- O diretório da _index_ é "C:\xampp\htdocs\management" (no Windows);
- A URL base utilizada durante todo o desenvolvimento foi "http\://localhost/management" (não foi utilizado SSL local);<br/><br/>

## Deployment

O deploy do projeto está hospedado no InfinityFree no link: <a href="http://management.infinityfreeapp.com/" target="_blank">http\://management.infinityfreeapp.com/</a>.<br/><br/>

## :v: Direitos

Desenvolvido e publicado por [Marcelo Tomazelli](https://github.com/marcelotomazelli).
