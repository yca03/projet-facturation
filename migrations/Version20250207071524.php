<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207071524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque_client CHANGE rib rib VARCHAR(255) DEFAULT NULL, CHANGE code_agent code_agent VARCHAR(255) DEFAULT NULL, CHANGE numero_bic numero_bic VARCHAR(255) DEFAULT NULL, CHANGE gestionnaire gestionnaire VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque_client CHANGE rib rib VARCHAR(255) NOT NULL, CHANGE code_agent code_agent VARCHAR(255) NOT NULL, CHANGE numero_bic numero_bic VARCHAR(255) NOT NULL, CHANGE gestionnaire gestionnaire VARCHAR(255) NOT NULL');
    }
}
