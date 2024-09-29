<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LifeInsuranceCustomerAttribute extends Form
{
    #[Validate('required')]
    public $protection_package = [];
    #[Validate('required')]
    public $allowance_package = [];
    #[Validate('required')]
    public $full_name = 'test';
    #[Validate('required')]
    public $mobile_number = 'test';
    #[Validate('required')]
    public $telephone_number = 'test';
    #[Validate('required|date')]
    public $date_of_birth = 'test';
    #[Validate('required')]
    public $place_of_birth = 'test';
    #[Validate('required')]
    public $nationality = 'test';
    #[Validate('required')]
    public $email_address = 'test';
    #[Validate('required')]
    public $name_of_trustee = 'test';
    #[Validate('required')]
    public $name_of_beneficiary = 'test';
    #[Validate('required')]
    public $tin = 'test';
    #[Validate('required')]
    public $other_id = 'test';
    #[Validate('required')]
    public $gender = 'Male';
    #[Validate('required')]
    public $civil_status = 'Widowed';
    #[Validate('required')]
    public $permanent_official_mail_address = 'test';
    #[Validate('required')]
    public $occupation = 'test';
    #[Validate('required')]
    public $source_of_funds = 'test';

    
}
