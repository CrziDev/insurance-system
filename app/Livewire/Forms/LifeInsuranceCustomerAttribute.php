<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LifeInsuranceCustomerAttribute extends Form
{
    #[Validate('required')]
    public $protection_package;
    #[Validate('required')]
    public $allowance_package;
    #[Validate('required')]
    public $mobile_number;
    #[Validate('required')]
    public $telephone_number;
    #[Validate('required')]
    public $date_of_birth;
    #[Validate('required')]
    public $place_of_birth;
    #[Validate('required')]
    public $nationality;
    #[Validate('required')]
    public $email_address;
    #[Validate('required')]
    public $name_of_trustee;
    #[Validate('required')]
    public $tin;
    #[Validate('required')]
    public $other_id;
    #[Validate('required')]
    public $gender;
    #[Validate('required')]
    public $permanent_official_mail_address;
    #[Validate('required')]
    public $occupation;
    #[Validate('required')]
    public $source_of_funds;
    
}
