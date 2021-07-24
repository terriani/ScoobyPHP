<?php

//Controller gerado automaticamente via - Scooby-CLI em dateNow

namespace Scooby\Controllers;

class $name extends Controller
{
    /**
     * Exibe todos os registros
     *
     * @return void
     */
    public function index(): void
    {
         $this->view("Pages", "", []);
    }

    /**
     * Exibe o formulário de novo registro
     *
     * @return void
     */
    public function create(): void
    {
        $this->view("Pages", "", []);
    }

    /**
     * Salva o novo registro no banco de dados
     *
     * @return void
     */
    public function store()
    {
        //Logica para salvar os dados no banco
    }

    /**
     * Mostra um registro específico buscanco pelo seu id
     *
     * @param array $data
     * @return void
     */
    public function show(Request $request): void
    {
        $id = $request->getParams()->id;
        $this->view("Pages", "", []);
    }

    /**
     * Exibe o furmulário de edição de um registro específico
     * buscando pelo seu id
     *
     * @param array $data
     * @return void
     */
    public function edit(Request $request): void
    {
        $id = $request->getParams()->id;
        $this->view("Pages", "", []);
    }

    /**
     * Atualiza um registro específico no banco de dados
     *
     * @param array $data
     * @return void
     */
    public function update(Request $request)
    {
        $id = $request->getParams()->id;
        //Logica para a alteração do registro
    }

    /**
     * Apaga um registro específico buscando pelo id no banco de dados
     *
     * @param array $data
     * @return void
     */
    public function destroy(Request $request)
    {
        $id = $request->getParams()->id;
        //Logica para a deleção do registro
    }
}
