<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200607201027 extends AbstractMigration
{
    /**
     * Get description of migration.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return 'Add user confirmation';
    }

    /**
     * Apply next changes to database.
     *
     * @param Schema $schema Structure about the database.
     *
     * @return void
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql('ALTER TABLE user ADD confirmed TINYINT(1) DEFAULT 0 NOT NULL');
    }

    /**
     * Apply past changes to database.
     *
     * @param Schema $schema Structure about the database.
     *
     * @return void
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql('ALTER TABLE user DROP confirmed');
    }
}
