<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241219145638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients CHANGE type_societe type_societe VARCHAR(255) DEFAULT NULL, CHANGE numero_compte_contribuable numero_compte_contribuable VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE siege siege VARCHAR(255) DEFAULT NULL, CHANGE pays pays VARCHAR(255) DEFAULT NULL, CHANGE site_internet site_internet VARCHAR(255) DEFAULT NULL, CHANGE regime_fiscal regime_fiscal VARCHAR(255) DEFAULT NULL, CHANGE activite activite VARCHAR(255) DEFAULT NULL, CHANGE numero_clients numero_clients VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients CHANGE type_societe type_societe VARCHAR(255) NOT NULL, CHANGE numero_compte_contribuable numero_compte_contribuable VARCHAR(255) NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE siege siege VARCHAR(255) NOT NULL, CHANGE pays pays VARCHAR(255) NOT NULL, CHANGE site_internet site_internet VARCHAR(255) NOT NULL, CHANGE regime_fiscal regime_fiscal VARCHAR(255) NOT NULL, CHANGE activite activite VARCHAR(255) NOT NULL, CHANGE numero_clients numero_clients VARCHAR(255) NOT NULL');
    }
}
