# lake

### Instalação
1. Faça o clone do repositório com `git clone git@github.com:VivianeQuinaia/lake.git`.
2. Copie o arquivo `.env.dist` para `.env` (`cp .env.dist .env`) e preencha os dados que faltam.
3. Utilize o comando `docker-compose build` para realizar o pull das imagens.
4. Execute seus containers com o comando `docker-compose up -d`.
5. Entre no container `docker-compose exec php-fpm bash` ou `make php` e execute o comando `composer install`.
___

###Configurações
As configurações necessárias são:
```dotenv
PHP_PORT=8072

NETWORK_DEFAULT=lake-network
```
___

### Casos de uso

#### Modules/Birds/Finder
Esse caso de uso é responsável por retornar a quantidade de patos amarelos 
ou a quantidade de aves que não são patos.
```php
<?php

use App\Repositories\YellowDuckRepository;
use App\Lake\Modules\Birds\Finder\UseCase;

class TestClass
{
    public function test()
    {
        $useCase = new UseCase(
            new YellowDuckRepository()
        );

        $useCase->execute();
        $useCase->getResponse();
    }
}
```
___

### Testes unitários
PHPUnit
Para executar os testes unitários:
- Execute `make test`.
___
### VERSION
Acesse [VERSION](./VERSION).
