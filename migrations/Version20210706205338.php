<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706205338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
        $this->addSql('ALTER TABLE Commande DROP FOREIGN KEY FK_6EEAA67D99DED506');
        $this->addSql('ALTER TABLE Commande_Medicaments DROP FOREIGN KEY FK_94690FAA82EA2E54');
        $this->addSql('ALTER TABLE Commande_Medicaments DROP FOREIGN KEY FK_94690FAAC403D7FB');
        $this->addSql('ALTER TABLE Fornisseur_Medicaments DROP FOREIGN KEY FK_AEAD4F09AC6681D0');
        $this->addSql('ALTER TABLE Fornisseur_Medicaments DROP FOREIGN KEY FK_AEAD4F09C403D7FB');
        $this->addSql('ALTER TABLE Medicaments DROP FOREIGN KEY FK_DD988ACB2A86559F');
        $this->addSql('ALTER TABLE pharmacie DROP FOREIGN KEY FK_5FC194348BF5C2E6');
        $this->addSql('ALTER TABLE pharmacie_client DROP FOREIGN KEY FK_A3B7E85DBC6D351B');
        $this->addSql('ALTER TABLE pharmacie_client DROP FOREIGN KEY FK_A3B7E85D19EB6921');
        $this->addSql('ALTER TABLE pharmacie_Fornisseur DROP FOREIGN KEY FK_D30BBAE2BC6D351B');
        $this->addSql('ALTER TABLE pharmacie_Fornisseur DROP FOREIGN KEY FK_D30BBAE2AC6681D0');
        $this->addSql('ALTER TABLE pharmacie_Medicaments DROP FOREIGN KEY FK_C7525CA0BC6D351B');
        $this->addSql('ALTER TABLE pharmacie_Medicaments DROP FOREIGN KEY FK_C7525CA0C403D7FB');
    }
}
