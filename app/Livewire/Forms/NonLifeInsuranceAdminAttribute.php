<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class NonLifeInsuranceAdminAttribute extends Form
{
    #[Validate('required')]
    public $firstName;

    #[Validate('required')]
    public $lastName;

    #[Validate('required')]
    public $address ;

    #[Validate('required')]
    public $businessProfession;

    #[Validate('required')]
    public $model = 'model' ;

    #[Validate('required')]
    public $plateNo = 'c' ;

    #[Validate('required')]
    public $make = 'make' ;

    #[Validate('required')]
    public $serialChassis = 'serialChassis' ;

    #[Validate('required')]
    public $typeBody = 'typeBody';

    #[Validate('required')]
    public $color = 'color';

    #[Validate('required')]
    public $authorizedCapacity = 'authorizedCapacity';

    #[Validate('required')]
    public $bltFileNo = 'bltFileNo' ;

    #[Validate('required')]
    public $weightCapacity = 'weightCapacity' ;

    #[Validate('required')]
    public $policyId;
    
    #[Validate('required')]
    public $dateEffective = '' ;

    #[Validate('required')]
    public $expiration = '' ;
    
    #[Validate('required')]
    public $confirmation_no = 'bltFileNo' ;

    #[Validate('required')]
    public $official_receipt = 'weightCapacity' ;

    #[Validate('required')]
    public $limitLiabity = 'limitLiabity' ;

    #[Validate('required')]
    public $premiumPaidOnlimit = 'premiumPaidOnlimit' ;
}
