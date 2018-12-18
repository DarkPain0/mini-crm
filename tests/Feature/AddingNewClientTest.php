<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Client;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AddingNewClientTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test that guest users cannot create client and is redirected to login
     */
    public function test_guest_user_cannot_create_client_redirected_to_login(): void
    {
        $this->get(route('clients.create'))
             ->assertRedirect('/login');
    }
    
    public function test_client_first_name_is_required()
    {
        $this->signIn();
        $client = make(Client::class)->getOriginal();
        $this->post(route('clients.store'), $client)
             ->assertStatus(422);
        $this->assertDatabaseMissing('clients', $client);
        
    }
}
