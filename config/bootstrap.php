<?php
use Cake\Core\Configure;

Configure::write('Accounts.passwordHasher', ['DefaultPasswordHasher', 'Auth']);

if (!Configure::check('Accounts.Datasources.default.prefix')) {
    Configure::write('Accounts.Datasources.default.prefix', 'accounts_');
}

