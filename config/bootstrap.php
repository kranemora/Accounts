<?php
use Cake\Core\Configure;

if (!Configure::check('Accounts.Datasources.default.prefix')) {
    Configure::write('Accounts.Datasources.default.prefix', 'accounts_');
}