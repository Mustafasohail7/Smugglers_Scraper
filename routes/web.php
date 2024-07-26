<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterStoreController;
use App\Http\Controllers\ScraperController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['auth','roles:admin']],function(){ 

});
Route::get('/', function () {
    return redirect('/home');
});

Route::get('/ifram', function () {
    return view('iframe');
});

Route::post('/custom-login', function (Request $request) {
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $response = Http::post('https://api.smugglers-system.dev/api/authentication/public/auth/token/', [
        'username' => $request->username,
        'password' => $request->password,
    ]);

    if ($response->successful()) {
        $data = $response->json()['results'];
        $token = $data['access'];

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            // Create new user if not found
            $user = new User();
            // $user->name = $data['name']; // Adjust as per your API response structure
            $user->email = $data['email'];
            $user->password = bcrypt($request->password); // Store the hashed password
            // Add other necessary fields here
            $user->save();
        } else {
            // Update user details if found
            // $user->name = $data['name']; // Adjust as per your API response structure
            $user->password = bcrypt($request->password); // Store the hashed password
            // Update other necessary fields if needed
            $user->save();
        }

        // // Create or update user in local database
        // $user = User::updateOrCreate(
        //     // ['username' => $data['username']],
        //     [
        //         // 'name' => $data['name'],
        //         'email' => $data['email'],
        //         'password' => bcrypt($request->password), // Store the hashed password
        //         // Add other necessary fields here
        //     ]
        // );

        // Log the user in
        Auth::login($user);

        // Store the token in the session or wherever needed
        session(['auth_token' => $token]);

        return redirect('/home');
    } else {
        return back()->withErrors(['username' => 'Invalid credentials or unable to authenticate.']);
    }
})->name('custom-login');



Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/scrape', [ScraperController::class,'index']);
Route::post('/registerstore', [RegisterStoreController::class, 'registerstore']);
Auth::routes([]);

Route::group(['middleware'=>['auth','roles:user']],function(){ 
});


// Route::controller(SearchController::class)->group(function(){

//     Route::get('demo-search', 'index');

//     Route::get('autocomplete', 'autocomplete')->name('autocomplete');

// });
