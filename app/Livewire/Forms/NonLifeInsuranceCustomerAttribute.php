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
    public $businessProfession = 'businessProfession' ;

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

}
