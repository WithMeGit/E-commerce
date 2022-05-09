<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\WishList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        if ($this->model) {
            $this->setModel($this->model);
        }
    }

    public function setModel(string $modelClass): self
    {
        $this->model = app($modelClass);

        return $this;
    }

    protected function getModel()
    {
        if ($this->model instanceof Model) {
            return $this->model;
        }
        throw new ModelNotFoundException(
            'You must declare your repository $model attribute with an Illuminate\Database\Eloquent\Model '
                . 'namespace to use this feature.'
        );
    }

    public function getAll()
    {
        return $this->getModel()->paginate(5);
    }

    public function store($attributes = [])
    {
        $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $model = $this->find($id);
        $model->update($attributes);
    }

    public function find($id)
    {
        return $this->getModel()->find($id);
    }

    public function delete($id)
    {
        $this->getModel()->find($id)->delete($id);
        return TRUE;
    }

    public function getCategoryActive()
    {
        return Category::all()->where('active', '=', 1);
    }

    public function countItem($request)
    {
        $orderCount = Order::where('user_id', '=', Auth::user()->id)->count();
        $request->session()->put('orderCount', $orderCount);
        $wishlistCount = WishList::where('user_id', '=', Auth::user()->id)->count();
        $request->session()->put('wishlistCount', $wishlistCount);
        $cartCount = Cart::where('user_id', '=', Auth::user()->id)->count();
        $request->session()->put('cartCount', $cartCount);
    }
}