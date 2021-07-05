<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210705225357 extends AbstractMigration
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
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, mat VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_6EEAA67D99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_medicaments (commande_id INT NOT NULL, medicaments_id INT NOT NULL, INDEX IDX_94690FAA82EA2E54 (commande_id), INDEX IDX_94690FAAC403D7FB (medicaments_id), PRIMARY KEY(commande_id, medicaments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fornisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, tel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fornisseur_medicaments (fornisseur_id INT NOT NULL, medicaments_id INT NOT NULL, INDEX IDX_AEAD4F09AC6681D0 (fornisseur_id), INDEX IDX_AEAD4F09C403D7FB (medicaments_id), PRIMARY KEY(fornisseur_id, medicaments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicaments (id INT AUTO_INCREMENT NOT NULL, classification_id INT DEFAULT NULL, pa DOUBLE PRECISION NOT NULL, pv DOUBLE PRECISION NOT NULL, qte INT NOT NULL, INDEX IDX_DD988ACB2A86559F (classification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie (id INT AUTO_INCREMENT NOT NULL, commandes_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, INDEX IDX_5FC194348BF5C2E6 (commandes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie_client (pharmacie_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_A3B7E85DBC6D351B (pharmacie_id), INDEX IDX_A3B7E85D19EB6921 (client_id), PRIMARY KEY(pharmacie_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie_medicaments (pharmacie_id INT NOT NULL, medicaments_id INT NOT NULL, INDEX IDX_C7525CA0BC6D351B (pharmacie_id), INDEX IDX_C7525CA0C403D7FB (medicaments_id), PRIMARY KEY(pharmacie_id, medicaments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pharmacie_fornisseur (pharmacie_id INT NOT NULL, fornisseur_id INT NOT NULL, INDEX IDX_D30BBAE2BC6D351B (pharmacie_id), INDEX IDX_D30BBAE2AC6681D0 (fornisseur_id), PRIMARY KEY(pharmacie_id, fornisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande_medicaments ADD CONSTRAINT FK_94690FAA82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_medicaments ADD CONSTRAINT FK_94690FAAC403D7FB FOREIGN KEY (medicaments_id) REFERENCES medicaments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fornisseur_medicaments ADD CONSTRAINT FK_AEAD4F09AC6681D0 FOREIGN KEY (fornisseur_id) REFERENCES fornisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fornisseur_medicaments ADD CONSTRAINT FK_AEAD4F09C403D7FB FOREIGN KEY (medicaments_id) REFERENCES medicaments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medicaments ADD CONSTRAINT FK_DD988ACB2A86559F FOREIGN KEY (classification_id) REFERENCES classification (id)');
        $this->addSql('ALTER TABLE pharmacie ADD CONSTRAINT FK_5FC194348BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE pharmacie_client ADD CONSTRAINT FK_A3B7E85DBC6D351B FOREIGN KEY (pharmacie_id) REFERENCES pharmacie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_client ADD CONSTRAINT FK_A3B7E85D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_medicaments ADD CONSTRAINT FK_C7525CA0BC6D351B FOREIGN KEY (pharmacie_id) REFERENCES pharmacie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_medicaments ADD CONSTRAINT FK_C7525CA0C403D7FB FOREIGN KEY (medicaments_id) REFERENCES medicaments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_fornisseur ADD CONSTRAINT FK_D30BBAE2BC6D351B FOREIGN KEY (pharmacie_id) REFERENCES pharmacie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pharmacie_fornisseur ADD CONSTRAINT FK_D30BBAE2AC6681D0 FOREIGN KEY (fornisseur_id) REFERENCES fornisseur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicaments DROP FOREIGN KEY FK_DD988ACB2A86559F');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D99DED506');
        $this->addSql('ALTER TABLE pharmacie_client DROP FOREIGN KEY FK_A3B7E85D19EB6921');
        $this->addSql('ALTER TABLE commande_medicaments DROP FOREIGN KEY FK_94690FAA82EA2E54');
        $this->addSql('ALTER TABLE pharmacie DROP FOREIGN KEY FK_5FC194348BF5C2E6');
        $this->addSql('ALTER TABLE fornisseur_medicaments DROP FOREIGN KEY FK_AEAD4F09AC6681D0');
        $this->addSql('ALTER TABLE pharmacie_fornisseur DROP FOREIGN KEY FK_D30BBAE2AC6681D0');
        $this->addSql('ALTER TABLE commande_medicaments DROP FOREIGN KEY FK_94690FAAC403D7FB');
        $this->addSql('ALTER TABLE fornisseur_medicaments DROP FOREIGN KEY FK_AEAD4F09C403D7FB');
        $this->addSql('ALTER TABLE pharmacie_medicaments DROP FOREIGN KEY FK_C7525CA0C403D7FB');
        $this->addSql('ALTER TABLE pharmacie_client DROP FOREIGN KEY FK_A3B7E85DBC6D351B');
        $this->addSql('ALTER TABLE pharmacie_medicaments DROP FOREIGN KEY FK_C7525CA0BC6D351B');
        $this->addSql('ALTER TABLE pharmacie_fornisseur DROP FOREIGN KEY FK_D30BBAE2BC6D351B');
        $this->addSql('DROP TABLE classification');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_medicaments');
        $this->addSql('DROP TABLE fornisseur');
        $this->addSql('DROP TABLE fornisseur_medicaments');
        $this->addSql('DROP TABLE medicaments');
        $this->addSql('DROP TABLE pharmacie');
        $this->addSql('DROP TABLE pharmacie_client');
        $this->addSql('DROP TABLE pharmacie_medicaments');
        $this->addSql('DROP TABLE pharmacie_fornisseur');
        $this->addSql('DROP TABLE user');
    }
}
