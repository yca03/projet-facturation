<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240830162648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_mode_payement ADD banque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_mode_payement ADD CONSTRAINT FK_21CE12E537E080D9 FOREIGN KEY (banque_id) REFERENCES banque_only (id)');
        $this->addSql('CREATE INDEX IDX_21CE12E537E080D9 ON detail_mode_payement (banque_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_mode_payement DROP FOREIGN KEY FK_21CE12E537E080D9');
        $this->addSql('DROP INDEX IDX_21CE12E537E080D9 ON detail_mode_payement');
        $this->addSql('ALTER TABLE detail_mode_payement DROP banque_id');
    }
}
