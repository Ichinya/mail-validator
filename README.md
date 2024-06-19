# Mail Validator


## Use Validator

### Default

```php
use Ichinya\MailValidator\Validator;

if (Validator::validate('test@test.ru')){
    echo 'Email valid';
} else {
    echo 'Email INVALID!';
}
```
### With config

* Option 1: New config class
```php
// create new class
class NewConfig extends \Ichinya\MailValidator\Config
{
    protected bool $useException = false;
    // clear standard purifications classes
    protected array $standardPurifications = [];
}

// use config
\Ichinya\MailValidator\Validator::setConfig(new NewCofig());


// use validator
if (Validator::validate('test@test.ru')){
    echo 'Email valid';
} else {
    echo 'Email INVALID!';
}
```

* Option 2: Set config
```php
use \Ichinya\MailValidator\Validator;
use \Ichinya\MailValidator\Config;

// set config
$config = newConfig();
$config->addChecker(\Ichinya\MailValidator\Checkers\RegExChecker::class);
$config->addCustomPurification(fn($value) => trim($value));

// use config
Validator::setConfig($config);

// use validator
if (Validator::validate('test@test.ru')){
    echo 'Email valid';
} else {
    echo 'Email INVALID!';
}
```

## Use Purification

```php
use \Ichinya\MailValidator\Validator;

$email = 'Test@eXcample.com';

$clearEmail = Validator::purify($email);
print_r($clearEmail); // test@excample.com
```
