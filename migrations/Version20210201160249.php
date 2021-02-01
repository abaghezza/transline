<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201160249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demandes (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, langue_id INT NOT NULL, created_at DATETIME NOT NULL, comment LONGTEXT DEFAULT NULL, label LONGTEXT NOT NULL, mail LONGTEXT DEFAULT NULL, status VARCHAR(60) NOT NULL, INDEX IDX_BD940CBBA76ED395 (user_id), INDEX IDX_BD940CBB2AADBACD (langue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL, demandes_id INT NOT NULL, updated_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, size INT NOT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_6354059F49DCC2D (demandes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langues (id INT AUTO_INCREMENT NOT NULL, combination VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, email VARCHAR(180) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, birthdate DATETIME NOT NULL, telephone INT NOT NULL, adress VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postcode INT NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBBA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBB2AADBACD FOREIGN KEY (langue_id) REFERENCES langues (id)');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_6354059F49DCC2D FOREIGN KEY (demandes_id) REFERENCES demandes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_6354059F49DCC2D');
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBB2AADBACD');
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBBA76ED395');
        $this->addSql('DROP TABLE demandes');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE langues');
        $this->addSql('DROP TABLE users');
    }
}
