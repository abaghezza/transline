<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210119143605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demandes ADD translator_id INT DEFAULT NULL, ADD status VARCHAR(60) NOT NULL');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBB5370E40B FOREIGN KEY (translator_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_BD940CBB5370E40B ON demandes (translator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBB5370E40B');
        $this->addSql('DROP INDEX IDX_BD940CBB5370E40B ON demandes');
        $this->addSql('ALTER TABLE demandes DROP translator_id, DROP status');
    }
}
