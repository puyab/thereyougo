<?php

namespace App\Jobs;

use App\Models\Profile;
use Brevo\Client\Api\ContactsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\UpdateContact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncUserToBrevo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ContactsApi $apiInstance;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $email, public Profile $profile)
    {
        //
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

        $updatedContact = new UpdateContact([
            'attributes' => [
                'FIRSTNAME' => $this->profile->first_name,
                'LASTNAME' => $this->profile->last_name,
                'SMS' => $this->profile->telephone,
                'LOCATION' => $this->profile->location,
                'COMPANY' => $this->profile->company,
                'ROLE' => $this->profile->role,
            ]
        ]);

        try {
            $this->apiInstance->updateContact($this->email, $updatedContact);
        } catch (\Exception $e) {
            info('Exception when calling ContactsApi->updateContact: ' . $e->getMessage());
        }
    }
}
