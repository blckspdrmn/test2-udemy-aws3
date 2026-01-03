<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * API Test Controller
 *
 * APIをテストするための専用ページを表示するコントローラー
 */
class ApiTestController extends Controller
{
    /**
     * APIテストページを表示
     *
     * GET /api/test
     *
     * @return View
     */
    public function index(): View
    {
        return view('api.test');
    }
}
