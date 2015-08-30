<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class AcceptanceHelper extends \Codeception\Module
{

    public function aSiteAdministrator()
    {
        return [
            'name' => 'Bradshaw Matikinye',
            'email' => 'joshua@matikinye.com',
            'password' => 'joshua',
            'is_admin' => true
        ];
    }

    public function siteUser()
    {
        return [
            'name' => 'Joshua Matikinye',
            'email' => 'jbmatikinye@gmail.com',
            'password' => 'joshua',
            'is_admin' => false
        ];
    }

}
