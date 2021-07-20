<?php

namespace Scooby\Controllers;

use Scooby\Http\HttpErrorResponse;

class NotfoundController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index(): void
    {
        if (IS_API == 'true') {
            $this->json([HttpErrorResponse::httpGetErrorCode() => HttpErrorResponse::httpGetErrorMsg()], (int) HttpErrorResponse::httpGetErrorCode());
        }
        $this->setTitle('Oppss - ' . HttpErrorResponse::httpGetErrorCode());
        $this->view('Error', '404', [
            'httpErrorCode' => HttpErrorResponse::httpGetErrorCode(),
            'httpErrorMessage' => HttpErrorResponse::httpGetErrorMsg(),
        ]);
    }
}
