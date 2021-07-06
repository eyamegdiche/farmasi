<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706204558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classification (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Commande (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, mat VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_6EEAA67D99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Commande_Medicaments (Commande_id INT NOT NULL, Medicaments_id INT NOT NULL, INDEX IDX_94690FAA82EA2E54 (Commande_id), INDEX IDX_94690FAAC403D7FB (Medicaments_id), PRIMARY KEY(Commande_id, Medicaments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Fornisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, tel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Fornisseur_Medicaments (Fornisseur_id INT NOT NULL, Medicaments_id INT NOT NULL, INDEX IDX_AEAD4F09AC6681D0 (Fornisseur_id), INDEX IDX_AEAD4F09C403D7FB (Medicaments_id), PRIMARY KEY(Fornisseur_id, Medicaments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Medicaments (id INT AUTO_INCREMENT NOT NULL, classification_id INT DEFAULT NULL, pa DOUBLE PRECISION NOT NULL, pv DOUBLE PRECISION NOT NULL, qte INT NOT NULL, INDEX IDX_DD988ACB2A86559F (classification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie (id INT AUTO_INCREMENT NOT NULL, Commandes_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, INDEX IDX_5FC194348BF5C2E6 (Commandes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie_client (pharmacie_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_A3B7E85DBC6D351B (pharmacie_id), INDEX IDX_A3B7E85D19EB6921 (client_id), PRIMARY KEY(pharmacie_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie_Medicaments (pharmacie_id INT NOT NULL, Medicaments_id INT NOT NULL, INDEX IDX_C7525CA0BC6D351B (pharmacie_id), INDEX IDX_C7525CA0C403D7FB (Medicaments_id), PRIMARY KEY(pharmacie_id, Medicaments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie_Fornisseur (pharmacie_id INT NOT NULL, Fornisseur_id INT NOT NULL, INDEX IDX_D30BBAE2BC6D351B (pharmacie_id), INDEX IDX_D30BBAE2AC6681D0 (Fornisseur_id), PRIMARY KEY(pharmacie_id, Fornisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Commande ADD CONSTRAINT FK_6EEAA67D99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE Commande_Medicaments ADD CONSTRAINT FK_94690FAA82EA2E54 FOREIGN KEY (Commande_id) REFERENCES Commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Commande_Medicaments ADD CONSTRAINT FK_94690FAAC403D7FB FOREIGN KEY (Medicaments_id) REFERENCES Medicaments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Fornisseur_Medicaments ADD CONSTRAINT FK_AEAD4F09AC6681D0 FOREIGN KEY (Fornisseur_id) REFERENCES Fornisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Fornisseur_Medicaments ADD CONSTRAINT FK_AEAD4F09C403D7FB FOREIGN KEY (Medicaments_id) REFERENCES Medicaments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Medicaments ADD CONSTRAINT FK_DD988ACB2A86559F FOREIGN KEY (classification_id) REFERENCES classification (id)');
        $this->addSql('ALTER TABLE pharmacie ADD CONSTRAINT FK_5FC194348BF5C2E6 FOREIGN KEY (Commandes_id) REFERENCES Commande (id)');
        $this->addSql('ALTER TABLE pharmacie_client ADD CONSTRAINT FK_A3B7E85DBC6D351B FOREIGN KEY (pharmacie_id) REFERENCES pharmacie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_client ADD CONSTRAINT FK_A3B7E85D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_Medicaments ADD CONSTRAINT FK_C7525CA0BC6D351B FOREIGN KEY (pharmacie_id) REFERENCES pharmacie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_Medicaments ADD CONSTRAINT FK_C7525CA0C403D7FB FOREIGN KEY (Medicaments_id) REFERENCES Medicaments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_Fornisseur ADD CONSTRAINT FK_D30BBAE2BC6D351B FOREIGN KEY (pharmacie_id) REFERENCES pharmacie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_Fornisseur ADD CONSTRAINT FK_D30BBAE2AC6681D0 FOREIGN KEY (Fornisseur_id) REFERENCES Fornisseur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Medicaments DROP FOREIGN KEY FK_DD988ACB2A86559F');
        $this->addSql('ALTER TABLE Commande DROP FOREIGN KEY FK_6EEAA67D99DED506');
        $this->addSql('ALTER TABLE pharmacie_client DROP FOREIGN KEY FK_A3B7E85D19EB6921');
        $this->addSql('ALTER TABLE Commande_Medicaments DROP FOREIGN KEY FK_94690FAA82EA2E54');
        $this->addSql('ALTER TABLE pharmacie DROP FOREIGN KEY FK_5FC194348BF5C2E6');
        $this->addSql('ALTER TABLE Fornisseur_Medicaments DROP FOREIGN KEY FK_AEAD4F09AC6681D0');
        $this->addSql('ALTER TABLE pharmacie_Fornisseur DROP FOREIGN KEY FK_D30BBAE2AC6681D0');
        $this->addSql('ALTER TABLE Commande_Medicaments DROP FOREIGN KEY FK_94690FAAC403D7FB');
        $this->addSql('ALTER TABLE Fornisseur_Medicaments DROP FOREIGN KEY FK_AEAD4F09C403D7FB');
        $this->addSql('ALTER TABLE pharmacie_Medicaments DROP FOREIGN KEY FK_C7525CA0C403D7FB');
        $this->addSql('ALTER TABLE pharmacie_client DROP FOREIGN KEY FK_A3B7E85DBC6D351B');
        $this->addSql('ALTER TABLE pharmacie_Medicaments DROP FOREIGN KEY FK_C7525CA0BC6D351B');
        $this->addSql('ALTER TABLE pharmacie_Fornisseur DROP FOREIGN KEY FK_D30BBAE2BC6D351B');
        $this->addSql('DROP TABLE classification');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE Commande');
        $this->addSql('DROP TABLE Commande_Medicaments');
        $this->addSql('DROP TABLE Fornisseur');
        $this->addSql('DROP TABLE Fornisseur_Medicaments');
        $this->addSql('DROP TABLE Medicaments');
        $this->addSql('DROP TABLE pharmacie');
        $this->addSql('DROP TABLE pharmacie_client');
        $this->addSql('DROP TABLE pharmacie_Medicaments');
        $this->addSql('DROP TABLE pharmacie_Fornisseur');
        $this->addSql('DROP TABLE user');
    }
}
