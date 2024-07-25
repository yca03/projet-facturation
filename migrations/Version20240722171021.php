<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240722171021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_pro_format ADD clients_id INT DEFAULT NULL, ADD mode_payement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture_pro_format ADD CONSTRAINT FK_92A7118CAB014612 FOREIGN KEY (clients_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE facture_pro_format ADD CONSTRAINT FK_92A7118CEF4F1912 FOREIGN KEY (mode_payement_id) REFERENCES mode_payement (id)');
        $this->addSql('CREATE INDEX IDX_92A7118CAB014612 ON facture_pro_format (clients_id)');
        $this->addSql('CREATE INDEX IDX_92A7118CEF4F1912 ON facture_pro_format (mode_payement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_pro_format DROP FOREIGN KEY FK_92A7118CAB014612');
        $this->addSql('ALTER TABLE facture_pro_format DROP FOREIGN KEY FK_92A7118CEF4F1912');
        $this->addSql('DROP INDEX IDX_92A7118CAB014612 ON facture_pro_format');
        $this->addSql('DROP INDEX IDX_92A7118CEF4F1912 ON facture_pro_format');
        $this->addSql('ALTER TABLE facture_pro_format DROP clients_id, DROP mode_payement_id');
    }
}
