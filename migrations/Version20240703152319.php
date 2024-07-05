<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703152319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe ADD activite_postal VARCHAR(255) NOT NULL, ADD pays VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD site_internet VARCHAR(255) NOT NULL, ADD code_commercial VARCHAR(255) NOT NULL, ADD regime_fiscal VARCHAR(255) NOT NULL, ADD date DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe DROP activite_postal, DROP pays, DROP email, DROP site_internet, DROP code_commercial, DROP regime_fiscal, DROP date');
    }
}
