<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AddAvatarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_members_can_add_avatars()
    {
        $this->json('POST', 'api/users/{user_id}/avatar')
            ->assertStatus(401);
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        $this->signIn();

        $this->json('POST', 'api/users/' . auth()->id() . '/avatar', [
            'avatar' => 'not-an-image'
        ])->assertStatus(422);
    }

    /** @test */
    public function a_user_may_add_an_avatar_to_their_profile()
    {
        $this->signIn();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->json('POST', 'api/users/' . auth()->id() . '/avatar', [
            'avatar' => $file
        ]);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());

        $this->assertEquals(asset('avatars/' . $file->hashName()), auth()->user()->avatar_path);
    }
}
