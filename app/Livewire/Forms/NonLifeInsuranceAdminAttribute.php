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
    public $model = '' ;

    #[Validate('required')]
    public $plateNo = '' ;

    #[Validate('required')]
    public $make = '' ;

    #[Validate('required')]
    public $serialChassis = '' ;

    #[Validate('required')]
    public $typeBody = '';

    #[Validate('required')]
    public $color = '';

    #[Validate('required')]
    public $authorizedCapacity = '';

    #[Validate('required')]
    public $bltFileNo = '' ;

    #[Validate('required')]
    public $weightCapacity = '' ;

    #[Validate('required')]
    public $policyId;
    
    #[Validate('required')]
    public $dateEffective = '' ;

    #[Validate('required')]
    public $expiration = '' ;
    
    #[Validate('required')]
    public $confirmation_no = '' ;

    
    #[Validate('required')]
    public $motoNum = '' ;

    #[Validate('required')]
    public $official_receipt = '' ;


    public $limitLiabity = '' ;
    
    #[Validate('required', 'unique:non_life_insurances')]
    public $formNumber = '';
    

    public $premiumPaidOnlimit = '';
    public $form_endorsement = "NOTE FOR TPL ONLY...";
}
