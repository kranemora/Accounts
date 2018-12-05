# Accounts plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

Incluir en el archivo composer.json del proyecto

```
"repositories": [
      {
          "type": "vcs",
          "url": "https://github.com/kranemora/accounts.git"
      },
      {
          "type": "vcs",
          "url": "https://github.com/kranemora/custom.git"
      },
      {
          "type": "vcs",
          "url": "https://github.com/kranemora/plugin-app-installer.git"
      }
],
```

The recommended way to install composer packages is:

```
composer require cakephp-extended/accounts
```

Luego de instalar el plugin, cree la base de datos ejecutando el siguiente comando:

```
bin/cake migrations migrate -p Accounts
```

Configure el passwordHasher en el archivo bootstrap.php modificando:

```
Configure::write('Accounts.passwordHasher', ['DefaultPasswordHasher', 'Auth'])
```
El valor de la variable Account.passwordHasher debe contener los argumentos para la función App::className, que permitirá importar los archivos requeridos