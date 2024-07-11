<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\ListingController;

// All Listins
Route::get('/', [ListingController::class,'index']);

// Shw Create Job form
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');

// Single Listing
Route::get('/listings/{listing}',[ListingController::class,'show']);

// Store job form data
Route::post('/listings',[ListingController::class,'store']);

// Show Edit Form
Route::get('/listings/{listing}/edit',[ListingController::class,'edit']);

// Update Listing
Route::put('/listings/{listing}',[ListingController::class,'update']);
