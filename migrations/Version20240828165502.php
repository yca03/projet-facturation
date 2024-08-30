<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828165502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encaissement ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE encaissement ADD CONSTRAINT FK_5D4869B019EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_5D4869B019EB6921 ON encaissement (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encaissement DROP FOREIGN KEY FK_5D4869B019EB6921');
        $this->addSql('DROP INDEX IDX_5D4869B019EB6921 ON encaissement');
        $this->addSql('ALTER TABLE encaissement DROP client_id');
    }
}
