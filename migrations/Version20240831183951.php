<?php
//
//declare(strict_types=1);
//
//namespace DoctrineMigrations;
//
//use Doctrine\DBAL\Schema\Schema;
//use Doctrine\Migrations\AbstractMigration;
//
///**
// * Auto-generated Migration: Please modify to your needs!
// */
//final class Version20240831183951 extends AbstractMigration
//{
//    public function getDescription(): string
//    {
//        return '';
//    }
//
//    public function up(Schema $schema): void
//    {
//        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE TABLE banque_client (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, banque_only_id INT DEFAULT NULL, uid VARCHAR(255) DEFAULT NULL, numero_compte_banque VARCHAR(255) NOT NULL, rib VARCHAR(255) NOT NULL, code_agent VARCHAR(255) NOT NULL, numero_bic VARCHAR(255) NOT NULL, gestionnaire VARCHAR(255) NOT NULL, INDEX IDX_48214E8519EB6921 (client_id), INDEX IDX_48214E8587C553BE (banque_only_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('CREATE TABLE banque_only (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code_banque VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('CREATE TABLE detail_mode_payement (id INT AUTO_INCREMENT NOT NULL, encaissement_id INT DEFAULT NULL, banque_client_id INT DEFAULT NULL, banque_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, montant VARCHAR(255) NOT NULL, INDEX IDX_21CE12E56F272231 (encaissement_id), INDEX IDX_21CE12E5A32C6EC6 (banque_client_id), INDEX IDX_21CE12E537E080D9 (banque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('CREATE TABLE detatil_encaissement (id INT AUTO_INCREMENT NOT NULL, encaissement_id INT DEFAULT NULL, facture_id INT DEFAULT NULL, uid VARCHAR(255) DEFAULT NULL, solde VARCHAR(255) NOT NULL, montant_du VARCHAR(255) DEFAULT NULL, montant_verse VARCHAR(255) DEFAULT NULL, INDEX IDX_9CEDB6C16F272231 (encaissement_id), INDEX IDX_9CEDB6C17F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('CREATE TABLE encaissement (id INT AUTO_INCREMENT NOT NULL, mode_payement_id INT DEFAULT NULL, client_id INT DEFAULT NULL, date DATETIME NOT NULL, reference VARCHAR(255) NOT NULL, statut VARCHAR(255) DEFAULT NULL, INDEX IDX_5D4869B0EF4F1912 (mode_payement_id), INDEX IDX_5D4869B019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('ALTER TABLE banque_client ADD CONSTRAINT FK_48214E8519EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
//        $this->addSql('ALTER TABLE banque_client ADD CONSTRAINT FK_48214E8587C553BE FOREIGN KEY (banque_only_id) REFERENCES banque_only (id)');
//        $this->addSql('ALTER TABLE detail_mode_payement ADD CONSTRAINT FK_21CE12E56F272231 FOREIGN KEY (encaissement_id) REFERENCES encaissement (id)');
//        $this->addSql('ALTER TABLE detail_mode_payement ADD CONSTRAINT FK_21CE12E5A32C6EC6 FOREIGN KEY (banque_client_id) REFERENCES banque_client (id)');
//        $this->addSql('ALTER TABLE detail_mode_payement ADD CONSTRAINT FK_21CE12E537E080D9 FOREIGN KEY (banque_id) REFERENCES banque_only (id)');
//        $this->addSql('ALTER TABLE detatil_encaissement ADD CONSTRAINT FK_9CEDB6C16F272231 FOREIGN KEY (encaissement_id) REFERENCES encaissement (id)');
//        $this->addSql('ALTER TABLE detatil_encaissement ADD CONSTRAINT FK_9CEDB6C17F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
//        $this->addSql('ALTER TABLE encaissement ADD CONSTRAINT FK_5D4869B0EF4F1912 FOREIGN KEY (mode_payement_id) REFERENCES mode_payement (id)');
//        $this->addSql('ALTER TABLE encaissement ADD CONSTRAINT FK_5D4869B019EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
//        $this->addSql('ALTER TABLE detail_facture ADD montant_brut VARCHAR(255) NOT NULL');
//        $this->addSql('ALTER TABLE facture ADD statut_paye VARCHAR(255) DEFAULT NULL, ADD reste VARCHAR(255) DEFAULT NULL');
//        $this->addSql('ALTER TABLE facture_pro_format ADD convertir_id INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE facture_pro_format ADD CONSTRAINT FK_92A7118C14F9D5F6 FOREIGN KEY (convertir_id) REFERENCES facture (id)');
//        $this->addSql('CREATE INDEX IDX_92A7118C14F9D5F6 ON facture_pro_format (convertir_id)');
//    }
//
//    public function down(Schema $schema): void
//    {
//        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE banque_client DROP FOREIGN KEY FK_48214E8519EB6921');
//        $this->addSql('ALTER TABLE banque_client DROP FOREIGN KEY FK_48214E8587C553BE');
//        $this->addSql('ALTER TABLE detail_mode_payement DROP FOREIGN KEY FK_21CE12E56F272231');
//        $this->addSql('ALTER TABLE detail_mode_payement DROP FOREIGN KEY FK_21CE12E5A32C6EC6');
//        $this->addSql('ALTER TABLE detail_mode_payement DROP FOREIGN KEY FK_21CE12E537E080D9');
//        $this->addSql('ALTER TABLE detatil_encaissement DROP FOREIGN KEY FK_9CEDB6C16F272231');
//        $this->addSql('ALTER TABLE detatil_encaissement DROP FOREIGN KEY FK_9CEDB6C17F2DEE08');
//        $this->addSql('ALTER TABLE encaissement DROP FOREIGN KEY FK_5D4869B0EF4F1912');
//        $this->addSql('ALTER TABLE encaissement DROP FOREIGN KEY FK_5D4869B019EB6921');
//        $this->addSql('DROP TABLE banque_client');
//        $this->addSql('DROP TABLE banque_only');
//        $this->addSql('DROP TABLE detail_mode_payement');
//        $this->addSql('DROP TABLE detatil_encaissement');
//        $this->addSql('DROP TABLE encaissement');
//        $this->addSql('ALTER TABLE facture_pro_format DROP FOREIGN KEY FK_92A7118C14F9D5F6');
//        $this->addSql('DROP INDEX IDX_92A7118C14F9D5F6 ON facture_pro_format');
//        $this->addSql('ALTER TABLE facture_pro_format DROP convertir_id');
//        $this->addSql('ALTER TABLE detail_facture DROP montant_brut');
//        $this->addSql('ALTER TABLE facture DROP statut_paye, DROP reste');
//    }
//}
