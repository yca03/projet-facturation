<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523120938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E747F2DEE08');
        $this->addSql('DROP INDEX IDX_C82E747F2DEE08 ON clients');
        $this->addSql('ALTER TABLE clients DROP facture_id');
        $this->addSql('ALTER TABLE facture ADD id_client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641099DED506 FOREIGN KEY (id_client_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_FE86641099DED506 ON facture (id_client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients ADD facture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E747F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C82E747F2DEE08 ON clients (facture_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641099DED506');
        $this->addSql('DROP INDEX IDX_FE86641099DED506 ON facture');
        $this->addSql('ALTER TABLE facture DROP id_client_id');
    }
}
