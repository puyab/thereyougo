<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ResetPasswordForm extends Component
{
    #[Validate('required')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

    public string $step = 'send-email';

    public function render(): View
    {
        return view('livewire.reset-password-form');
    }

    public function submit(): void
    {
    }
}
