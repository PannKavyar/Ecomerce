<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function index()
    {
        $totalProducts = Products::count();
        $totalCategories = Category::count();
        $totalBrands = Brand::count();

        $totalAllUsers = User::count();
        $totalUsers = User::where('role_as', '0')->count();
        $totalAdmins = User::where('role_as', '1')->count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', $todayDate)->count();
        $thisMonthOrders = Order::whereMonth('created_at', $thisMonth)->count();
        $thisYearOrders = Order::whereYear('created_at', $thisYear)->count();
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalBrands',
            'totalAllUsers',
            'totalUsers',
            'totalAdmins',
            'totalOrders',
            'todayOrders',
            'thisMonthOrders',
            'thisYearOrders'
        ));
    }
}
