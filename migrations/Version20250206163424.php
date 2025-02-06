<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206163424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque_client DROP FOREIGN KEY FK_48214E8519EB6921');
        $this->addSql('DROP INDEX IDX_48214E8519EB6921 ON banque_client');
        $this->addSql('ALTER TABLE banque_client DROP client_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque_client ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE banque_client ADD CONSTRAINT FK_48214E8519EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_48214E8519EB6921 ON banque_client (client_id)');
    }
}
