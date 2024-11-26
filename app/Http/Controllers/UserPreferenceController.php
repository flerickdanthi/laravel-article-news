<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    // Store or update user preferences
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'category' => 'nullable|string', 
            'sources' => 'nullable|string',  
            'author' => 'nullable|string'   
        ]);
    
        // Store or update the user's preferences
        $userPreference = Preference::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'category' => $request->category,
                'sources' => $request->sources,
                'author' => $request->author
            ]
        );
    
        return response()->json($userPreference, 200);
    }
    



    // Get user preferences
    public function show()
{
    $preferences = Preference::where('user_id', Auth::id())->first();
    return response()->json($preferences, 200);
}

}
