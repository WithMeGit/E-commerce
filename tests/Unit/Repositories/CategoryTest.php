<?php

namespace Tests\Unit\Repositories;

use App\Models\Category;

use App\Models\User;
use App\Repositories\Category\CategoryRepository;
use Database\Factories\CategoryFactory;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    protected $category;

    public function setUp(): void
    {
        // parent::setUp();
        // exit;
        $this->category = Category::factory()->make();
        // dd("12312");

        // $this->categoryRepository = new CategoryRepository($this->category);
    }

    public function tearDown(): void
    {
        // parent::tearDown();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStore()
    {
        $data = [
            'name' => "erwer",
            'description' => "qwewqeqw",
            'image' => "wqeqwe",
            'active' => 1,
        ];
        dd($data);
        // $category = $this->categoryRepository->store($data);
        // $this->assertInstanceOf(Category::class, $category);
        // $this->assertEquals($this->category['name'], $category->name);
        // $this->assertEquals($this->category['description'], $category->description);
        // $this->assertEquals($this->category['image'], $category->image);
        // $this->assertEquals($this->category['active'], $category->active);
    }
}