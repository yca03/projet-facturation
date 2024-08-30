<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240827112844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_pro_format ADD convertir_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture_pro_format ADD CONSTRAINT FK_92A7118C14F9D5F6 FOREIGN KEY (convertir_id) REFERENCES facture (id)');
        $this->addSql('CREATE INDEX IDX_92A7118C14F9D5F6 ON facture_pro_format (convertir_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_pro_format DROP FOREIGN KEY FK_92A7118C14F9D5F6');
        $this->addSql('DROP INDEX IDX_92A7118C14F9D5F6 ON facture_pro_format');
        $this->addSql('ALTER TABLE facture_pro_format DROP convertir_id');
    }
}
