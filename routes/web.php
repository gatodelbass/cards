<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::get('/welcome', [App\Http\Controllers\LoginController::class, 'welcome'])->name('welcome');
Route::get('/', [App\Http\Controllers\LoginController::class, 'welcome'])->name('welcome');

// Route::get('/welcome', function () {

//     Route::get('addCards/{collectionId}', [App\Http\Controllers\CollectionController::class, 'addCards'])->name('addCards');

//     return Inertia::render('Welcome');
// });
// Route::get('/', function () {
//     return Inertia::render('Welcome');
// });



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('index', [App\Http\Controllers\LoginController::class, 'index'])->name('login.index');

    Route::get('addCards/{collectionId}', [App\Http\Controllers\CollectionController::class, 'addCards'])->name('addCards');
    Route::get('addNewCard', [App\Http\Controllers\CollectionController::class, 'addNewCard'])->name('addNewCard');

    Route::get('manageCards/{collectionId}', [App\Http\Controllers\CollectionController::class, 'manageCards'])->name('manageCards');
    Route::get('manageCollection/{collectionId}', [App\Http\Controllers\CollectionController::class, 'manageCollection'])->name('manageCollection');
    Route::get('createFromDirectory/{collectionId}', [App\Http\Controllers\CollectionController::class, 'createFromDirectory'])->name('createFromDirectory');

    Route::get('saveCardName/{cardId}/{cardName}', [App\Http\Controllers\CollectionController::class, 'saveCardName'])->name('saveCardName');
    Route::post('saveCardImage', [App\Http\Controllers\CollectionController::class, 'saveCardImage'])->name('saveCardImage');
    Route::get('saveCardLayout/{cardId}/{cardLayout}', [App\Http\Controllers\CollectionController::class, 'saveCardLayout'])->name('saveCardLayout');
    Route::get('changeAllLayout/{collectionId}/{layout}', [App\Http\Controllers\CollectionController::class, 'changeAllLayout'])->name('changeAllLayout');
    Route::post('saveCardOrder', [App\Http\Controllers\CollectionController::class, 'saveCardOrder'])->name('saveCardOrder');

    Route::post('submitCollection', [App\Http\Controllers\CollectionController::class, 'submitCollection'])->name('submitCollection');
    Route::get('setCover/{collectionId}/{cardId}', [App\Http\Controllers\CollectionController::class, 'setCover'])->name('setCover');
    Route::get('buyCollection/{collectionId}', [App\Http\Controllers\CollectionController::class, 'buyCollection'])->name('buyCollection');

    //ADMIN
    Route::get('previewAlbum/{collectionId}', [App\Http\Controllers\CollectionController::class, 'previewAlbum'])->name('previewAlbum');
    Route::get('adminIndex', [App\Http\Controllers\AdminController::class, 'adminIndex'])->name('adminIndex');
    Route::get('submittedCollections', [App\Http\Controllers\AdminController::class, 'submittedCollections'])->name('submittedCollections');
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::get('activateCollection/{collectionId}', [App\Http\Controllers\CollectionController::class, 'activateCollection'])->name('activateCollection');
    Route::get('errorsCollection/{collectionId}', [App\Http\Controllers\CollectionController::class, 'errorsCollection'])->name('errorsCollection');
    Route::resource('collections', App\Http\Controllers\CollectionController::class);
    Route::resource('avatars', App\Http\Controllers\AvatarController::class);
    Route::get('batchCollection/{collectionId}', [App\Http\Controllers\AdminController::class, 'batchCollection'])->name('batchCollection');
    Route::get('saveCardName/{cardId}/{cardName}', [App\Http\Controllers\AdminController::class, 'saveCardName'])->name('saveCardName');
    Route::get('saveCardLayout/{cardId}/{cardLayout}', [App\Http\Controllers\AdminController::class, 'saveCardLayout'])->name('saveCardLayout');
    Route::get('battle/{collectionId}', [App\Http\Controllers\CollectionController::class, 'battle'])->name('battle');


    Route::get('cards/index/{collectionId}', [App\Http\Controllers\CardController::class, 'index'])->name('cards.index');
    Route::get('cards/create/{collectionId}', [App\Http\Controllers\CardController::class, 'create'])->name('cards.create');
    Route::post('cards/store', [App\Http\Controllers\CardController::class, 'store'])->name('cards.store');
    Route::get('cards/show/{contact}', [App\Http\Controllers\CardController::class, 'show'])->name('cards.show');
    Route::get('cards/edit/{contact}', [App\Http\Controllers\CardController::class, 'edit'])->name('cards.edit');
    Route::put('cards/update/{card}', [App\Http\Controllers\CardController::class, 'update'])->name('cards.update');
    Route::delete('cards/destroy/{contact}', [App\Http\Controllers\CardController::class, 'destroy'])->name('cards.destroy');
    Route::get('setFilter/{type}/{filter}/{cardId}', [App\Http\Controllers\CardController::class, 'setFilter'])->name('setFilter');


    Route::get('redeemTickets', [App\Http\Controllers\RedeemController::class, 'redeemTickets'])->name('redeemTickets');
    Route::get('redeemBoxes', [App\Http\Controllers\RedeemController::class, 'redeemBoxes'])->name('redeemBoxes');
    Route::get('redeemBox', [App\Http\Controllers\RedeemController::class, 'redeemBox'])->name('redeemBox');
    Route::get('redeemCards/{quantity}', [App\Http\Controllers\RedeemController::class, 'redeemCards'])->name('redeemCards');
    Route::get('redeemGold', [App\Http\Controllers\RedeemController::class, 'redeemGold'])->name('redeemGold');
    Route::get('buyTickets/{quantity}', [App\Http\Controllers\RedeemController::class, 'buyTickets'])->name('buyTickets');
    Route::get('redeemPrizes/{prizeId}', [App\Http\Controllers\RedeemController::class, 'redeemPrizes'])->name('redeemPrizes');


    Route::get('sellUserCard/{userCardId}', [App\Http\Controllers\PlayerController::class, 'sellUserCard'])->name('sellUserCard');
    Route::get('sellSelectedCards', [App\Http\Controllers\PlayerController::class, 'sellSelectedCards'])->name('sellSelectedCards');
    Route::get('changeStatusUserCard/{userCardId}/{statusToChange}', [App\Http\Controllers\PlayerController::class, 'changeStatusUserCard'])->name('changeStatusUserCard');
    Route::get('filterUserCards', [App\Http\Controllers\PlayerController::class, 'filterUserCards'])->name('filterUserCards');
    Route::get('sellCardsByStatus/{statusToSell}', [App\Http\Controllers\PlayerController::class, 'sellCardsByStatus'])->name('sellCardsByStatus');


    //PLAYER
    Route::get('playerProfile', [App\Http\Controllers\PlayerController::class, 'playerProfile'])->name('playerProfile');
    Route::get('playerCards', [App\Http\Controllers\PlayerController::class, 'playerCards'])->name('playerCards');
    //Route::get('userCards', [App\Http\Controllers\PlayerController::class, 'userCards'])->name('userCards');
    Route::post('filterPlayerCards', [App\Http\Controllers\PlayerController::class, 'filterPlayerCards'])->name('filterPlayerCards');


    Route::get('playerAvatars', [App\Http\Controllers\PlayerController::class, 'playerAvatars'])->name('playerAvatars');
    Route::get('selectAvatar/{userAvatarId}', [App\Http\Controllers\PlayerController::class, 'selectAvatar'])->name('selectAvatar');
    Route::get('sellUserAvatar/{userAvatarId}', [App\Http\Controllers\PlayerController::class, 'sellUserAvatar'])->name('sellUserAvatar');
    Route::get('players', [App\Http\Controllers\PlayerController::class, 'players'])->name('players');

    //ALBUM
    Route::get('albumIndex', [App\Http\Controllers\PlayerController::class, 'albumIndex'])->name('albumIndex');
    Route::get('albumPage/{collectionId}', [App\Http\Controllers\PlayerController::class, 'albumPage'])->name('albumPage');
    Route::get('pasteCard/{cardId}', [App\Http\Controllers\PlayerController::class, 'pasteCard'])->name('pasteCard');
    Route::get('refreshAlbumPage/{collectionId}', [App\Http\Controllers\PlayerController::class, 'refreshAlbumPage'])->name('refreshAlbumPage');

    //EXCHANGES
    Route::get('exchangeBag', [App\Http\Controllers\ExchangeController::class, 'exchangeBag'])->name('exchangeBag');
    Route::post('exchangeBag', [App\Http\Controllers\ExchangeController::class, 'exchangeBag'])->name('exchangeBag');
    Route::get('getAvailableCards/{playerCardId}', [App\Http\Controllers\ExchangeController::class, 'getAvailableCards'])->name('getAvailableCards');
    Route::get('createTrade/{ownerCardId}/{playerCardId}', [App\Http\Controllers\ExchangeController::class, 'createTrade'])->name('createTrade');
    Route::get('incomingExchanges', [App\Http\Controllers\ExchangeController::class, 'incomingExchanges'])->name('incomingExchanges');
    Route::get('outgoingExchanges', [App\Http\Controllers\ExchangeController::class, 'outgoingExchanges'])->name('outgoingExchanges');
    Route::get('acceptExchange/{tradeId}', [App\Http\Controllers\ExchangeController::class, 'acceptExchange'])->name('acceptExchange');
    Route::get('rejectExchange/{tradeId}', [App\Http\Controllers\ExchangeController::class, 'rejectExchange'])->name('rejectExchange');
    Route::get('getExchangeCards/{filter}', [App\Http\Controllers\ExchangeController::class, 'getExchangeCards'])->name('getExchangeCards');
});

Route::get('help', [App\Http\Controllers\AdminController::class, 'help'])->name('help');
Route::get('helpSpanish', [App\Http\Controllers\AdminController::class, 'helpSpanish'])->name('helpSpanish');

//Route::get('profileIndex', [App\Http\Controllers\LoginController::class, 'profileIndex'])->name('profileIndex');
Route::get('loginForm', [App\Http\Controllers\LoginController::class, 'loginForm'])->name('loginForm');
Route::post('loginUser', [App\Http\Controllers\LoginController::class, 'loginUser'])->name('loginUser');
Route::get('logoutUser', [App\Http\Controllers\LoginController::class, 'logoutUser'])->name('logoutUser');
Route::get('registerForm', [App\Http\Controllers\LoginController::class, 'registerForm'])->name('registerForm');
Route::post('registerUser', [App\Http\Controllers\LoginController::class, 'registerUser'])->name('registerUser');
Route::get('registerVerify/{id}', [App\Http\Controllers\LoginController::class, 'registerVerify'])->name('registerVerify');
Route::get('afterRegister', [App\Http\Controllers\LoginController::class, 'afterRegister'])->name('afterRegister');
Route::get('changePasswordForm', [App\Http\Controllers\LoginController::class, 'changePasswordForm'])->name('changePasswordForm');
Route::post('changePasswordLogued', [App\Http\Controllers\LoginController::class, 'changePasswordLogued'])->name('changePasswordLogued');
Route::put('updateUserData', [App\Http\Controllers\LoginController::class, 'updateUserData'])->name('updateUserData');

//forgot password
Route::get('forgotPassword', [App\Http\Controllers\LoginController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('sendPasswordCode', [App\Http\Controllers\LoginController::class, 'sendPasswordCode'])->name('sendPasswordCode');
Route::post('checkRememberCode', [App\Http\Controllers\LoginController::class, 'checkRememberCode'])->name('checkRememberCode');
Route::post('changePassword', [App\Http\Controllers\LoginController::class, 'changePassword'])->name('changePassword');


Route::get('exploreCollections', [App\Http\Controllers\CollectionController::class, 'exploreCollections'])->name('exploreCollections');
Route::get('getResults', [App\Http\Controllers\CollectionController::class, 'getResults'])->name('getResults');

Route::get('emoji', [App\Http\Controllers\AdminController::class, 'emoji'])->name('emoji');




require __DIR__ . '/auth.php';
