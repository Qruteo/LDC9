<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;

class AdminExportController extends Controller
{
    public function export(): Response
    {
        $users = User::select('name', 'email', 'role')->get();

        $csv = "\xEF\xBB\xBF";
        $csv .= "Nama,Email,Role\n";

        foreach ($users as $user) {
            $csv .= '"' . str_replace('"', '""', $user->name) . '",';
            $csv .= '"' . str_replace('"', '""', $user->email) . '",';
            $csv .= '"' . str_replace('"', '""', $user->role) . '"' . "\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="data-users.csv"',
        ]);
    }
}