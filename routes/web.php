<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use Tests\TestCase;

Route::get('/test', [SurveyController::class, 'show']);
Route::post('/test', [SurveyController::class, 'submit']);

class ExampleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}