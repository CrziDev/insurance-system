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
    public $model = 'test' ;

    #[Validate('required')]
    public $plateNo = 'test' ;

    #[Validate('required')]
    public $make = 'test' ;

    #[Validate('required')]
    public $serialChassis = 'test' ;

    #[Validate('required')]
    public $typeBody = 'test';

    #[Validate('required')]
    public $color = 'test';

    #[Validate('required')]
    public $authorizedCapacity = 'test';

    #[Validate('required')]
    public $bltFileNo = 'test' ;

    #[Validate('required')]
    public $weightCapacity = 'test' ;

    #[Validate('required')]
    public $policyId;
    
    #[Validate('required')]
    public $dateEffective = '' ;

    #[Validate('required')]
    public $expiration = '' ;
    
    #[Validate('required')]
    public $confirmation_no = '' ;

    #[Validate('required')]
    public $official_receipt = '' ;


    public $limitLiabity = '' ;
    
    #[Validate('required')]
    public $formNumber = '' ;


    public $premiumPaidOnlimit = 'test';
    public $form_endorsement = "NOTE FOR TPL ONLY...";
}
