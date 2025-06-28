<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Http\Middleware\IsAdmin;

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'totalUsers' => User::count(),
        ];
        return view('admin.index', compact('data'));
    }
}
