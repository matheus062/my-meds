<?php

declare(strict_types=1);

use Structure\Structure;

date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Structure(__DIR__ . '/JsonFiles/', __DIR__ . '/MysqlDump/'))->dumpSqlFiles();

    die('Arquivos gerados com sucesso.');
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage() . PHP_EOL;
    echo 'Code: ' . $e->getCode() . PHP_EOL;
    echo 'File: ' . $e->getFile() . PHP_EOL;
    echo 'Line: ' . $e->getLine() . PHP_EOL;

    die('Ocorreu um erro ao gerar arquivos.');
}
