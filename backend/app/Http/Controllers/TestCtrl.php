<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Str;

class TestCtrl extends Controller
{
    public function index()
    {
        $user_mod = User::find(234);
        $user_mod->name = Str::random(20);
        $user_mod->save();

        dd(Activity::all()->last()->toArray());
        echo "teste";
    }
}
