<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703153446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe ADD forme_juridique VARCHAR(255) NOT NULL, ADD adresse_postal VARCHAR(255) NOT NULL, DROP forme, DROP activite_postal');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe ADD forme VARCHAR(255) NOT NULL, ADD activite_postal VARCHAR(255) NOT NULL, DROP forme_juridique, DROP adresse_postal');
    }
}
