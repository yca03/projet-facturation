<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240830144847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_mode_payement ADD banque_client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_mode_payement ADD CONSTRAINT FK_21CE12E5A32C6EC6 FOREIGN KEY (banque_client_id) REFERENCES banque_client (id)');
        $this->addSql('CREATE INDEX IDX_21CE12E5A32C6EC6 ON detail_mode_payement (banque_client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_mode_payement DROP FOREIGN KEY FK_21CE12E5A32C6EC6');
        $this->addSql('DROP INDEX IDX_21CE12E5A32C6EC6 ON detail_mode_payement');
        $this->addSql('ALTER TABLE detail_mode_payement DROP banque_client_id');
    }
}
