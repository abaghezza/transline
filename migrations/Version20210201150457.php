<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201150457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBB2AADBACD FOREIGN KEY (langue_id) REFERENCES langues (id)');
        $this->addSql('CREATE INDEX IDX_BD940CBB2AADBACD ON demandes (langue_id)');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_6354059F49DCC2D');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_6354059F49DCC2D FOREIGN KEY (demandes_id) REFERENCES demandes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBB2AADBACD');
        $this->addSql('DROP INDEX IDX_BD940CBB2AADBACD ON demandes');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_6354059F49DCC2D');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_6354059F49DCC2D FOREIGN KEY (demandes_id) REFERENCES demandes (id)');
    }
}
