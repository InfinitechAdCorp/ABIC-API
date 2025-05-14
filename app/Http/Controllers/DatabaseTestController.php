<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Exception;

class DatabaseTestController extends Controller
{
    public function test()
    {
        try {
            // Try fetching tables as a basic connection test
            $tables = Schema::getAllTables();
            return view('dbtest', ['status' => 'Database connection successful!', 'tables' => $tables]);
        } catch (Exception $e) {
            return view('dbtest', ['status' => 'Connection failed: ' . $e->getMessage(), 'tables' => []]);
        }
    }
}
