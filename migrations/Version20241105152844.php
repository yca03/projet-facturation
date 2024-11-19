<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105152844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_commerciale DROP FOREIGN KEY FK_95EB2D66CD11A2CF');
        $this->addSql('DROP INDEX IDX_95EB2D66CD11A2CF ON offre_commerciale');
        $this->addSql('ALTER TABLE offre_commerciale CHANGE produits_id type_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre_commerciale ADD CONSTRAINT FK_95EB2D661237A8DE FOREIGN KEY (type_produit_id) REFERENCES type_produit (id)');
        $this->addSql('CREATE INDEX IDX_95EB2D661237A8DE ON offre_commerciale (type_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_commerciale DROP FOREIGN KEY FK_95EB2D661237A8DE');
        $this->addSql('DROP INDEX IDX_95EB2D661237A8DE ON offre_commerciale');
        $this->addSql('ALTER TABLE offre_commerciale CHANGE type_produit_id produits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre_commerciale ADD CONSTRAINT FK_95EB2D66CD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_95EB2D66CD11A2CF ON offre_commerciale (produits_id)');
    }
}
