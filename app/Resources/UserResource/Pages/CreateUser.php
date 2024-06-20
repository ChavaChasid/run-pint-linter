<?php

namespace App\Resources\UserResource\Pages;

use App\Notifications\SendEmail;
use App\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make('password');

        return $data;
    }

    protected function afterCreate(): void
    {
        $user = $this->record;
        $this->sendResetPasswordEmail($user);
    }

    protected function sendResetPasswordEmail(CanResetPassword $user): void
    {
        Password::broker(Filament::getAuthPasswordBroker())->sendResetLink(
            ['email' => $user->email],
            function (CanResetPassword $user, string $token): void {
                $mailMessage = $this->mailMessage($user, $token);
                $notification = new SendEmail($mailMessage);
                $user->notify($notification);
            }
        );
    }

    protected function mailMessage(CanResetPassword $user, string $token): MailMessage
    {
        $resetPasswordURL = Filament::getResetPasswordUrl($token, $user);

        return (new MailMessage)
            ->subject('New user registration')
            ->greeting('Hello '.$user->first_name.',')
            ->line('You have successfully registered in the system,')
            ->line('Please go to the following link to reset the password')
            ->action(('Reset Password'), $resetPasswordURL);
    }
}
