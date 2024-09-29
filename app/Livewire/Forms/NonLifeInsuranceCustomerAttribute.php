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
    public $businessProfession = 'test' ;

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

    public $premiumPaidOnlimit;
    public $limitLiabity;

    public $form_endorsement;

}
