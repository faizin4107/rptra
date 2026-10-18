<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Password;
// use App\Models\User;

#[Layout('layouts.guest')] 
class ForgotPassword extends Component
{
    #[Rule('required|email')]
    public $email = '';

    public $status = '';

    public function sendResetLink()
    {
        $this->validate();

        // Mengirim link reset password via Laravel Broker
        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            $this->status = __($status);
            $this->reset('email');
        } else {
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
