<?php

namespace App\Helper;

use App\Models\EmailConfiguration;

class MailHelper
{
    public static function setMailConfig()
    {
        $mailConfig     =       EmailConfiguration::first();

        $config     =       [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => $mailConfig->host,
            'port' => $mailConfig->port,
            'encryption' => $mailConfig->encryption,
            'username' => $mailConfig->username,
            'password' => $mailConfig->password,
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ];
        config(['mail.mailers.smtp' => $config]);
        config(['mail.from.address' => $mailConfig->email]);
    }
}
