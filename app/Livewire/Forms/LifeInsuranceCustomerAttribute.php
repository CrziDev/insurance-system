<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LifeInsuranceCustomerAttribute extends Form
{
    #[Validate('required')]
    public $protection_package = ['Deluxe'];
    #[Validate('required')]
    public $allowance_package = ['Superior'];
    #[Validate('required')]
    public $mobile_number = 's';
    #[Validate('required')]
    public $telephone_number = 's';
    #[Validate('required')]
    public $date_of_birth = 's';
    #[Validate('required')]
    public $place_of_birth = 's';
    #[Validate('required')]
    public $nationality = 's';
    #[Validate('required')]
    public $email_address = 's';
    #[Validate('required')]
    public $name_of_trustee = 's';
    #[Validate('required')]
    public $name_of_beneficiary = 's';
    #[Validate('required')]
    public $tin = 's';
    #[Validate('required')]
    public $other_id = 's';
    #[Validate('required')]
    public $gender = 'Male';
    #[Validate('required')]
    public $civil_status = 'Widowed';
    #[Validate('required')]
    public $permanent_official_mail_address = 's';
    #[Validate('required')]
    public $occupation = 's';
    #[Validate('required')]
    public $source_of_funds = 's';

    
}
