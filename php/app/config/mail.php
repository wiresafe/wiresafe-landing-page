<?php
/**
 * PHP raw framework
 *
 * @version 1.0.0
 * @author Habib Hadi <me@habibhadi.com>
 */

$config['mail'] = [
    'smtp' => [
        'host' => 'smtp.sparkpostmail.com',
        'username' => 'SMTP_Injection',
        'password' => '',
        'secure' => 'tls',
        'port' => 587,
        'from' => [
            'name' => '',
            'email' => '',
        ]
    ],

    'admin' => [
        'email' => 'hadicse@gmail.com',
        'name' => 'Habib Hadi'
    ]
];
