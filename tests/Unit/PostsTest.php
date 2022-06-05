<?php

namespace Tests\Unit;

use App\Models\Posts;
use App\Models\User;
use Tests\TestCase;

class PostsTest extends TestCase
{

    /** @test */
    public function test_post_created_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $postData = [
            "title" => "Nasi Padang",
            "content" => "Makanan khas yang berasal dari daerah padang",
            "image" => "",
            "user_id" => $user->id,
            "category_id" => "1"
        ];

        $this->json('POST', 'api/v1/posts', $postData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                "posts" => [
                    "title" => "Nasi Padang",
                    "content" => "Makanan khas yang berasal dari daerah padang",
                    "image" => "",
                    "user_id" => $user->id,
                    "category_id" => "1"
                ],
                "message" => "Created successfully"
            ]);
    }

    public function test_post_listed_posts_successfully()
    {

        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        Posts::factory()->create([
            "title" => "Pisang Ijo",
            "content" => "Makanan khas Indonesia yang berasal dari daerah Sulawesi Selatan",
            "image" => "",
            "user_id" => $user->id,
            "category_id" => "1",
        ]);

        $this->json('GET', 'api/v1/posts', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "posts" => [
                    [
                        "id" => 1,
                        "title" => "Pisang Ijo",
                        "content" => "Makanan khas Indonesia yang berasal dari daerah Sulawesi Selatan",
                        "image" => "",
                        "user_id" => $user->id,
                        "category_id" => "1"
                    ]
                ],
                "message" => "Retrieved successfully"
            ]);
    }

    public function test_post_get_detail_post_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $postData = Posts::factory()->create([
            "title" => "Pisang Ijo",
            "content" => "Makanan khas Indonesia yang berasal dari daerah Sulawesi Selatan",
            "image" => "",
            "user_id" => $user->id,
            "category_id" => "1"
        ]);

        // dd($postData);

        $this->json('GET', 'api/v1/posts/' . $postData->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "posts" => [
                    "title" => "Pisang Ijo",
                    "content" => "Makanan khas Indonesia yang berasal dari daerah Sulawesi Selatan",
                    "image" => "",
                    "user_id" => $user->id,
                    "category_id" => "1"
                ],
                "message" => "Retrieved successfully"
            ]);
    }

    public function test_post_update_post_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $postData = Posts::factory()->create([
            "title" => "Pisang Ijo",
            "content" => "Makanan khas Indonesia yang berasal dari daerah Sulawesi Selatan",
            "image" => "",
            "user_id" => $user->id,
            "category_id" => "1"
        ]);

        $payload = [
            "title" => "Soto Jepara",
            "content" => "Makanan khas Indonesia yang berasal dari daerah Jawa",
            "image" => ""
        ];

        $this->json('POST', 'api/v1/posts/' . $postData->id , $payload, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "posts" => [
                    "title" => "Soto Jepara",
                    "content" => "Makanan khas Indonesia yang berasal dari daerah Jawa",
                    "image" => ""
                ],
                "message" => "Updated successfully"
            ]);
    }

    public function test_post_delete_post_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $postData = Posts::factory()->create([
            "title" => "Pisang Ijo",
            "content" => "Makanan khas Indonesia yang berasal dari daerah Sulawesi Selatan",
            "image" => "",
            "user_id" => $user->id,
            "category_id" => "1"
        ]);

        $this->json('DELETE', 'api/v1/posts/' . $postData->id, [], ['Accept' => 'application/json'])
            ->assertStatus(204);
    }
}
