<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Brevo\Client\Configuration;
use Brevo\Client\Api\ContactsApi;
use Brevo\Client\Model\CreateContact;

class RegisterUserToBrevo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ContactsApi $apiInstance;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user
    ) {
    }

    private function initializeClient()
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', config('brevo.key'));
        $this->apiInstance = new ContactsApi(
            new \GuzzleHttp\Client,
            $config,
        );
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->initializeClient();

        $contact = new CreateContact([
            'email' => $this->user->email,
            'attributes' => [
                'FIRSTNAME' => $this->user->profile->first_name,
                'LASTNAME' => $this->user->profile->last_name,
                'SMS' => $this->user->profile->telephone,
                'LOCATION' => '',
                'COMPANY' => '',
                'ROLE' => ''
            ]
        ]);

        try {
            $result = $this->apiInstance->createContact($contact);
            $result['id'];
        } catch (\Exception $e) {
            info('Exception when calling ContactsApi->createContact: ' . $e->getMessage());
        }
    }
}
