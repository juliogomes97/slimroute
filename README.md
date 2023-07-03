## SlimRoute

O SlimRoute é um pequeno e simples sistema de rotas

### Como utilizar?

Primeiro de tudo iniciamos a class Route:

``` php
$route = new Route;
```

### Criação de uma simples rota

Neste caso abaixo, mostre uma rota para página inicial da aplicação

``` php
// Iniciar o controlador LandingController como página inicial
$route->get('', \SlimRoute_Test\Controllers\LandingController::class, 'hello');
```

### URL com parametros

Aqui estou a dizer que quero uma parametro que seja uma numero

``` php
// Exemplo de buscar parametros na url
$route->add('GET', '/utilizador/{user_id:[0-9]+}', \SlimRoute_Test\Controllers\UserController::class, 'get');
```

### Adicionar uma pagina onde nenhuma rota for encontrada

O method fallback será chamado caso nenhumas das rotas forem encontradas.

``` php
$route->fallback(\SlimRoute_Test\Controllers\NotFoundController::class, 'get');
```

### Metodos

O metodos existentes são os seguintes: ``` get() ```, ``` post() ```, ``` put() ```, ``` patch() ``` e ``` delete() ```.

Todos esse metodos tem com parametros: 1º ``` uri ```, 2º ``` nome do controlador ```, 3º ``` nome do metodo ```.

Caso queira adicionar outro tipo de http request method a rota é só chamar a função ``` add() ```, nesse metodo tem um parametro a mais que os outros anteriores: 1º ``` (GET, POST, ...) ```, 2º ``` uri ```, 3º ``` nome do controlador ```, 4º ``` nome do metodo ```;
