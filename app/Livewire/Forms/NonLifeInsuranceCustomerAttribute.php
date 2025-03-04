<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class NonLifeInsuranceCustomerAttribute extends Form
{
    #[Validate('required')]
    public $firstName = 'firstName';

    #[Validate('required')]
    public $lastName = 'lastName';

    #[Validate('required')]
    public $address = 'address' ;

    #[Validate('required')]
    public $businessProfession = '' ;

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

    public $premiumPaidOnlimit;
    public $limitLiabity;

    public $form_endorsement = "NOTE FOR TPL ONLY...";

}
