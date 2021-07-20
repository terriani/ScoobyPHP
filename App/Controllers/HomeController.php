<?php

namespace Scooby\Controllers;

class HomeController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index(): void
    {
        if (getenv('IS_API') === 'true') {
            $this->json(['Wellcome' => $GLOBALS['WELLCOME_MSG']]);
        }
        $this->setTitle('Wellcome');
        $this->view('Pages', 'home', [
            'wellcomeMessage' =>  $GLOBALS['WELLCOME_MSG']
        ]);
    }
}
