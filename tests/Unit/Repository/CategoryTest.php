<?php

namespace Tests\Unit\Repository;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $category;
    protected $categoryRepository;

    public function loadSetup()
    {
        $this->category = Category::factory()->make();
        $this->categoryRepository = new CategoryRepository($this->category);
    }

    public function testCurdRepoCate()
    {

        $this->loadSetup();

        //test Store
        $data_store = [
            'name' => $this->category->name,
            'description' => $this->category->description,
            'image' => $this->category->image,
            'active' => $this->category->active,
        ];

        $category_store = $this->categoryRepository->store($data_store);

        $this->assertInstanceOf(Category::class, $category_store);
        $this->assertEquals($this->category['name'], $category_store->name);
        $this->assertEquals($this->category['description'], $category_store->description);
        $this->assertEquals($this->category['image'], $category_store->image);
        $this->assertEquals($this->category['active'], $category_store->active);


        //test Update
        $data_update = [
            'name' => $this->category->name,
            'description' => $this->category->description,
            'image' => $this->category->image,
            'active' => $this->category->active,
        ];

        $category_updated = $this->categoryRepository->update($category_store->id, $data_update);

        $this->assertEquals(true, $category_updated);

        //test Find
        $category_find = $this->categoryRepository->find($category_store->id);

        $this->assertInstanceOf(Category::class, $category_find);

        //test Delete
        $category_del = $this->categoryRepository->delete($category_find->id);
        $this->assertEquals(true, $category_del);
    }
}