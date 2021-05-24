<?php

/**
 * Array contendo as views que passarão pela autenticação de usuário
 */
$views = explode(',', getenv('VIEWS_AUTH'));
$viewAutentication = [];
foreach ($views as $view) {
    $viewAutentication[] = $view;
}
return $viewAutentication;
