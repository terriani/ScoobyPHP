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
        if (IS_API) {
            $this->json(['Wellcome' => $this->i18n::translate('msg', 'WELLCOME_MSG')]);
        }
        $this->view(
            'Pages',
            'home',
            [
                'wellcomeMessage' => $this->i18n::translate('msg', 'WELLCOME_MSG')
            ],
            'Wellcome'
        );
    }
}
