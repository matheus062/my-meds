<?php

declare(strict_types=1);

namespace Structure;

use Exception;

class Structure {

    private string $jsonDir;
    private string $dumpDir;

    public function __construct(string $jsonDir, string $dumpDir) {
        $this->jsonDir = $jsonDir;
        $this->dumpDir = $dumpDir;
    }

    /**
     * @throws Exception
     */
    public function dumpSqlFiles(): void {
        $this->processStructureFiles($this->getUpdateFiles());
    }

    /**
     * @throws Exception
     */
    private function processStructureFiles(array $updates): void {
        foreach ($updates as $update) {
            file_put_contents($this->dumpDir . $update . '.sql', $this->getSql($update));
        }
    }

    /**
     * @throws Exception
     */
    private function getSql(string $updateFile): string {
        $contents = json_decode(file_get_contents($this->jsonDir . $updateFile), true);
        $sql = '';

        foreach ($contents as $updateContent) {
            $sql .= match ($updateContent['type'] ?? null) {
                'table' => $this->createTable($updateContent) . PHP_EOL,
                'columns' => $this->alterTable($updateContent) . PHP_EOL,
                'sql' => $updateContent['sql'] . PHP_EOL,
                default => throw new Exception('Tipo da atualização não encontrado.'),
            };
        }

        return $sql;
    }

    /**
     * @throws Exception
     */
    private function createTable(array $create): string {
        $table = $create['name'];
        $sql = '
            CREATE TABLE `' . $table . '` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updatedAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
        $foreignKeys = [];

        if (!empty($create['columns'])) {
            $columns = [];

            foreach ($create['columns'] as $column) {
                $columns[] = ",\n" . $this->processColumn($table, $column, $foreignKeys);
            }

            $sql .= implode('', $columns);
        }

        if (!empty($create['indexes'])) {
            $indexes = [];

            foreach ($create['indexes'] as $index) {
                $indexes[] = ",\n" . $this->processIndex($table, $index);
            }

            $sql .= implode('', $indexes);
        }

        if (!empty($foreignKeys)) {
            $sql .= implode('', array_map(fn($key) => ",\n" . $key, $foreignKeys));
        }

        $sql .= "\n);";

        return $sql;
    }

    private function processColumn(string $table, array $column, array &$foreignKeys): string {
        $columnType = isset($column['parentTable']) ? 'int' : $column['type'];
        $sql = '`' . $column['name'] . '` ' . strtoupper($columnType);
        $sql .= isset($column['default']) ? ' DEFAULT ' . $column['default'] : '';
        $sql .= isset($column['null']) ? ' NULL' : ' NOT NULL';
        $sql .= isset($column['unique']) ? ' UNIQUE' : '';
        $sql .= isset($column['comment']) ? ' COMMENT \'' . addslashes($column['comment']) . '\'' : '';
        $sql .= ' ' . ($column['position'] ?? '');

        if (!empty($column['parentTable'])) {
            $constraint = 'CONSTRAINT ' . 'fk_' . $table . '_' . $column['parentTable'] . '_' . $column['name'];
            $foreignKey = 'FOREIGN KEY (`' . $column['name'] . '`) REFERENCES `' . $column['parentTable'] . '`(`id`)';
            $foreignKeys[] = $constraint . ' ' . $foreignKey;
        }

        return $sql;
    }

    private function processIndex(string $table, array $index): string {
        $indexType = strtoupper($index['type']);
        $columns = '(`' . implode('`, `', $index['columns']) . '`)';

        if (empty($index['identifier'])) {
            $prefix = ($indexType === 'UNIQUE') ? 'uc' : 'ix';
            $identifier = $prefix . '_' . $table . '_' . strtolower(implode('_', $index['columns']));
        } else {
            $identifier = $index['identifier'];
        }

        return ($indexType === 'INDEX')
            ? $indexType . ' ' . $identifier . ' ' . $columns
            : 'CONSTRAINT ' . $identifier . ' ' . $indexType . ' ' . $columns;
    }

    /**
     * @throws Exception
     */
    private function alterTable(mixed $alterTable): string {
        $table = $alterTable['table'];

        $sql = 'ALTER TABLE `' . $table . '` ';
        $foreignKeys = [];

        if (!empty($alterTable['columns'])) {
            $columns = [];

            foreach ($alterTable['columns'] as $column) {
                $columns[] = "ADD COLUMN " . $this->processColumn($table, $column, $foreignKeys);
            }

            $sql .= implode(",\n", $columns);
        }

        if (!empty($create['indexes'])) {
            $indexes = [];

            foreach ($create['indexes'] as $index) {
                $indexes[] = 'ADD ' . $this->processIndex($table, $index);
            }

            if (!empty($columns)) {
                $sql .= ",\n";
            }

            $sql .= implode(",\n", $indexes);
        }

        if (!empty($foreignKeys)) {
            $sql .= implode('', array_map(fn($key) => ",\n ADD " . $key, $foreignKeys));
        }

        return $sql;
    }

    /**
     * @throws Exception
     */
    private function getUpdateFiles(): array {
        $files = glob($this->jsonDir . '*.json');
        $files = array_map(function ($file) {
            $file = explode('/', $file);
            return array_pop($file);
        }, $files);
        usort($files, function ($first, $second) {
            $first = (int)explode('.', $first)[0];
            $second = (int)explode('.', $second)[0];

            return ($first <=> $second);
        });

        if (empty($files)) {
            throw new Exception('Não foi possível encontrar arquivos de estrutura do banco.');
        }

        return array_filter($files, function ($value) {
            return (int)explode('.', $value)[0];
        });
    }

}
