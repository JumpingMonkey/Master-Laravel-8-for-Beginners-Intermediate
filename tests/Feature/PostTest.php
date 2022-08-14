<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No posts found!');
    }

    public function testSee1BlogPostWhenThereIs1()
    {
        //Arrange
        $post = $this->createDummyBlogPost();

        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText('New blog post title!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New blog post title!'
        ]);
    }

    public function testStoreValid()
    {
        $params = [
            'title' => 'Valid title!',
            'content' => 'At least 10 characters!'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was created!');
    }

    public function testStoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValid()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New blog post title!',
            'content' => 'New blog post content!',
            'id' => $post->id,
            'created_at' => $post->created_at,
        ]);

        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed'
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was updated!');
        $this->assertDatabaseMissing('blog_posts', [
            'title' => 'New blog post title!',
            'content' => 'New blog post content!',
        ]);
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new named title',
            'content' => 'Content was changed'
        ]);
    }

    public function testDelete()
    {
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New blog post title!',
            'content' => 'New blog post content!',
            'id' => $post->id,
        ]);

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Post was deleted!');
        $this->assertDatabaseMissing('blog_posts', [
            'title' => 'New blog post title!',
            'content' => 'New blog post content!',
            'id' => $post->id,
        ]);


    }

    private function createDummyBlogPost() : BlogPost
    {
        $post = new BlogPost();
        $post->title = 'New blog post title!';
        $post->content = 'New blog post content!';
        $post->save();
        return $post;
    }
}