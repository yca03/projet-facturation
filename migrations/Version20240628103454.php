<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240628103454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe DROP FOREIGN KEY FK_19653DBD3256915B');
        $this->addSql('DROP INDEX IDX_19653DBD3256915B ON societe');
        $this->addSql('ALTER TABLE societe DROP relation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe ADD relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBD3256915B FOREIGN KEY (relation_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_19653DBD3256915B ON societe (relation_id)');
    }
}
