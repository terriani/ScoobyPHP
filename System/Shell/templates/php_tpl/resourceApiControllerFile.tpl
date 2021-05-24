<?php

//Controller gerado automaticamente via - Scooby-CLI em dateNow

namespace Scooby\Controllers;

class $name extends Controller
{
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
     * Atualiza um registro específico no banco de dados
     *
     * @param array $data
     * @return void
     */
    public function update($data)
    {
        $id = $data['id'];
        //Logica para a alteração do registro
    }

    /**
     * Apaga um registro específico buscando pelo id no banco de dados
     *
     * @param array $data
     * @return void
     */
    public function destroy($data)
    {
        $id = $data['id'];
        //Logica para a deleção do registro
    }
}
