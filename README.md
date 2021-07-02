## IDempiere Web Service for Laravel 8

this project is Idempiere 8 Web Service Library for Laravel 8.

this code encapsulate SOAP request to Idempiere web service.

#### Predefined Route for ModelADService

this is example using predefined web service client Garden World

- Query Data [http://localhost:8000/idempierews/query?name=QueryBPartner](http://localhost:8000/idempierews/query?name=QueryBPartner)
- Read Data [http://localhost:8000/idempierews/read?name=ReadBPartner&id=117](http://localhost:8000/idempierews/read?name=ReadBPartner&id=117)
- Get List [http://localhost:8000/idempierews/list?name=GetListSalesRegions](http://localhost:8000/idempierews/list?name=GetListSalesRegions)

## Requirement

- [PHP >= 7.3](http://php.net/)
- [Laravel 8](https://github.com/laravel/framework)

## Quick Installation

on your laravel root folder, execute    

````
$ composer require uthadehikaru/idempiere-ws
````

## Configuration

````
$ php artisan vendor:publish --provider="Uthadehikaru\IdempiereWS\IdempiereWSServiceProvider"
````

setting your web service configuration on your `config/idempierews.php` file.

to override default configuration, you can add to end of your `.env` file. remove # to override default configuration

````
#IDEMPIEREWS_HOST=
#IDEMPIEREWS_USER=
#IDEMPIEREWS_PASS=
#IDEMPIEREWS_CLIENT=
#IDEMPIEREWS_ORG=
#IDEMPIEREWS_WH=
#IDEMPIEREWS_ROLE=
````

## Usage Example



## License

The MIT License (MIT). Please see [License File](https://github.com/uthadehikaru/idempierews/blob/master/LICENSE.md) for more information.