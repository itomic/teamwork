# Laravel 5 Teamwork PM API Bridge

![teamwork-graphic](https://cloud.githubusercontent.com/assets/2628905/7765016/853f462c-001e-11e5-90ac-389bf1a6c2fe.jpg)

[![Build Status](https://travis-ci.org/nigelheap/teamwork.svg?branch=master)](https://travis-ci.org/nigelheap/teamwork)
![Release](https://img.shields.io/github/release/nigelheap/teamwork.svg?style=flat)
![License](https://img.shields.io/packagist/l/nigelheap/teamwork.svg?style=flat)

This is a simple PHP Client that can connect to the [Teamwork](http://www.teamwork.com) API. This package was developed to be used with [Laravel 5](http://www.laravel.com) but can also be used stand alone as well. I hope this helps you automate and extend Teamwork to integrate even more into your business! Have fun and good luck. :metal:

This fork also includes updates for laravel 5.5 and 5.6

## Origional

Laravel 5 Teamwork PM API Bridge http://rossedman.github.io/teamwork/


## Installation

Just add this to your `composer.json` and then run `composer update`.

```
"nigelheap/teamwork": "~5.5"
```

You can also simply add it like this

```
composer require "nigelheap/teamwork:~5.5"
```

## Laravel Setup

This wrapper comes with support for `Laravel 5`. This includes a service provider as well as a facade for easy access.
Once this package is pulled into your project just add this to your `config/app.php` file.
```php
'providers' => [
    ...
    'NigelHeap\Teamwork\TeamworkServiceProvider',
],
```

and then add the facade to your `aliases` array

```php
'aliases' => [
    ...
    'Teamwork' => 'NigelHeap\Teamwork\Facades\Teamwork',
],
```

### Configuration

If you are using Laravel then add a `teamwork` array to your `config/services.php` file

```php
...
'teamwork' => [
    'key'  => 'YourSecretKey',
    'url'  => 'YourTeamworkUrl'
],
```

### Use

If you are using the Facade with Laravel youc an easily access Teamwork like this

```php
Teamwork::people()->all();
```

If you want to use dependency injection to make your application easy to test the Service Provider binds `NigelHeap\Teamwork\Factory`. Here is an example of how to use it with dependency injection

```php
Route::get('/test', function(NigelHeap\Teamwork\Factory $teamwork) {
   $activity = $teamwork->activity()->latest();
});
```

## Configuration Without Laravel

If you are not using Laravel you can instantiate the class like this

```php
require "vendor/autoload.php";

use GuzzleHttp\Client as Guzzle;
use NigelHeap\Teamwork\Client;
use NigelHeap\Teamwork\Factory as Teamwork;

$client     = new Client(new Guzzle, 'YourSecretKey', 'YourTeamworkUrl');
$teamwork   = new Teamwork($client);
```

You are ready to go now!

* * *

## Examples

Not all of the Teamwork API is supported yet but there is still a lot you can do! Below are some examples of how you can access Projects, Companies, and more. To work with a specific Object pass in the ID to perform actions on it. Data can be passed through for creating and editing.

**To see more examples [visit the docs](http://nigelheap.github.io/teamwork/)**

```php
// create a project
$teamwork->project()->create([
    "name" => "My New Amazing Project",
    "description" => "This is a project that I will dedicate my whole life too",
    "companyId" => "999"
]);

// get the latest activity on a project
$teamwork->project($projectID)->activity();
```

## Roadmap

#### 1.1 Release

- [X] Add Support For `Comments`
- [ ] Add Support For `Permissions`
- [ ] Add Support For `Time` Endpoint

#### 1.2 Release

- [ ] Add Support For `Categories`
- [ ] Add Support For `People Status`
- [ ] Add Support For `Files`
- [ ] Add Support For `Notebooks`
