<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * カテゴリ一覧を取得
     */
    public static function index()
    {
        return response(Category::get());
    }
}
