## SlimRoute

O SlimRoute é um pequeno sistema de rotas

### Como utilizar?

Primeiro de tudo iniciamos a class Route:

``` php
$route = new Route;
```

em seguida criamos um rota, aqui vou mostrar um exemplo de como criamos uma rota, neste caso será para pagina inicial da aplicação:

Ao criar uma rota, a função tem sempre o parametro ``` HttpRequest ```

``` php
$route->get('', function($request) {
    echo 'Ola Mundo!';
});
```

### Adicionar parametros na URL

Neste exemplo mostro como podemos passar um parametro pela URL, o nome do parametro da URL tem que ser igual ao parametro da função como no exemplos abaixo:

``` php
$route->get('/utilizador/{id:[0-9]+}', function($request, $id) {
    echo 'Utilizador ID: ' . $id;
});
```

## Adicionar uma pagina onde nenhuma rota for encontrada

o method fallback será chamado caso nenhumas das rotas forem encontradas.

``` php
$route->fallback(function($request){
    echo 'Página não encontrada!'
});
```

## Outros exemplos

``` php
$route->post('/utilizador/{user_id:[0-9]+}/posts', function($request, $user_id) {
    echo json_encode([
        'user_id'   => $user_id,
        'posts'     => [
            'Hello World',
            'SlimRoute',
            'Github'
        ]
    ]);
});
```

``` php
$route->get('/utilizador/{user_id:[0-9]+}/post/{post_name:[a-zA-Z]+}', function($request, $user_id, $post_name) {
    echo 'Utilizador: ' . $user_id;
    echo '<br>';
    echo 'Postagem: ' . $post_name;
});
```
