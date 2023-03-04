<?php
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;

Route::get("comment", [CommentsController::class, "index"]);

Route::post("comment/save/{user_id}", [CommentsController::class, "save"]);
