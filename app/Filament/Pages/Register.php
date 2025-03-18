<?php

namespace App\Filament\Auth;

use Filament\Pages\Page;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class Register extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-add';
    protected static string $view = 'filament.auth.register';

    public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);
        return redirect()->route('filament.admin.dashboard'); // Redirect ke dashboard
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->password()->required(),
            ]);
    }
}

