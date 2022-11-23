<?php

declare(strict_types=1);

namespace ContaoBootstrap\Navbar\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Contao\StringUtil;
use Doctrine\DBAL\Connection;

use function is_numeric;
use function serialize;

final class NavbarModulesMigration extends AbstractMigration
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();
        if (! $schemaManager->tablesExist(['tl_module'])) {
            return false;
        }

        $columns = $schemaManager->listTableColumns('tl_module');
        if (! isset($columns['bs_navbarmodules'])) {
            return false;
        }

        $affected = (int) $this->connection->fetchOne(
            'SELECT COUNT(*) FROM tl_module WHERE bs_navbarModules LIKE \'a:1:{i:0;%\'',
        );

        return $affected > 0;
    }

    public function run(): MigrationResult
    {
        $result = $this->connection->fetchAllAssociative(
            'SELECT * FROM tl_module WHERE bs_navbarModules LIKE \'a:1:{i:0;%\'',
        );

        foreach ($result as $row) {
            $templates = [];

            foreach (StringUtil::deserialize($row['bs_navbarModules'], true) as $key => $template) {
                if (is_numeric($key)) {
                    ++$key;
                }

                $templates[$key] = $template;
            }

            $this->connection->update(
                'tl_module',
                ['bs_navbarModules' => serialize($templates)],
                ['id' => $row['id']],
            );
        }

        return $this->createResult(true);
    }
}
