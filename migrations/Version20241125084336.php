<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241125084336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_commerciale ADD facture_pro_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre_commerciale ADD CONSTRAINT FK_95EB2D669620F61D FOREIGN KEY (facture_pro_id) REFERENCES facture_pro_format (id)');
        $this->addSql('CREATE INDEX IDX_95EB2D669620F61D ON offre_commerciale (facture_pro_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_commerciale DROP FOREIGN KEY FK_95EB2D669620F61D');
        $this->addSql('DROP INDEX IDX_95EB2D669620F61D ON offre_commerciale');
        $this->addSql('ALTER TABLE offre_commerciale DROP facture_pro_id');
    }
}
