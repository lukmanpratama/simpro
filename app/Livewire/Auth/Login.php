<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Title('Login')]
#[Layout('layouts.guest')]
class Login extends Component
{
    #[Rule('required', 'email')]
    public string $email ='';

    #[Rule('required')]
    public string $password ='';

    public function login()
    {
        if (Auth::attempt( $this->validate()))
        {
            if (auth()->user()->role == 'admin')
            {
                return redirect()->route('admin.home');
            }
            else if (auth()->user()->role == 'manager')
            {
                return redirect()->route('manager.home');
            }
            else if (auth()->user()->role == 'team')
            {
                return redirect()->route('team.home');
            }
            else if (auth()->user()->role == 'owner')
            {
               return redirect()->route('owner.home');
            }
            else
            {
                Auth::logout();
                return redirect()->route('login');
            }
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
