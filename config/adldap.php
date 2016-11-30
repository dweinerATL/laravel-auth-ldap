<?php

use Adldap\Adldap;

return [
    'account_suffix' => '@mydomain.local',
    'base_dn' => 'DC=mydomain,DC=local',
    'domain_controllers' => [
        'dc01.mydomain.local',
        'dc02.mydomain.local',
    ],
    'admin_username' => null,
    'admin_password' => null,
    'real_primarygroup' => true,
    'use_ssl' => false,
    'use_tls' => false,
    'recursive_groups' => true,
    'ad_port' => Adldap::ADLDAP_LDAP_PORT,
];
