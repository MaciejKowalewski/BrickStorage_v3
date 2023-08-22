<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808202346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantity_brick DROP CONSTRAINT fk_e277e7b68558682');
        $this->addSql('ALTER TABLE quantity_brick DROP CONSTRAINT fk_e277e7b67e8b4afc');
        $this->addSql('ALTER TABLE quantity_minifigure DROP CONSTRAINT fk_a276a0a53fc93da4');
        $this->addSql('ALTER TABLE quantity_minifigure DROP CONSTRAINT fk_a276a0a57e8b4afc');
        $this->addSql('DROP TABLE quantity_brick');
        $this->addSql('DROP TABLE quantity_minifigure');
        $this->addSql('ALTER TABLE quantity ADD minifigure_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quantity ADD brick_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quantity ADD CONSTRAINT FK_9FF3163630600219 FOREIGN KEY (minifigure_id_id) REFERENCES minifigure (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quantity ADD CONSTRAINT FK_9FF31636F2289060 FOREIGN KEY (brick_id_id) REFERENCES brick (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9FF3163630600219 ON quantity (minifigure_id_id)');
        $this->addSql('CREATE INDEX IDX_9FF31636F2289060 ON quantity (brick_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE quantity_brick (quantity_id INT NOT NULL, brick_id INT NOT NULL, PRIMARY KEY(quantity_id, brick_id))');
        $this->addSql('CREATE INDEX idx_e277e7b68558682 ON quantity_brick (brick_id)');
        $this->addSql('CREATE INDEX idx_e277e7b67e8b4afc ON quantity_brick (quantity_id)');
        $this->addSql('CREATE TABLE quantity_minifigure (quantity_id INT NOT NULL, minifigure_id INT NOT NULL, PRIMARY KEY(quantity_id, minifigure_id))');
        $this->addSql('CREATE INDEX idx_a276a0a53fc93da4 ON quantity_minifigure (minifigure_id)');
        $this->addSql('CREATE INDEX idx_a276a0a57e8b4afc ON quantity_minifigure (quantity_id)');
        $this->addSql('ALTER TABLE quantity_brick ADD CONSTRAINT fk_e277e7b68558682 FOREIGN KEY (brick_id) REFERENCES brick (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quantity_brick ADD CONSTRAINT fk_e277e7b67e8b4afc FOREIGN KEY (quantity_id) REFERENCES quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quantity_minifigure ADD CONSTRAINT fk_a276a0a53fc93da4 FOREIGN KEY (minifigure_id) REFERENCES minifigure (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quantity_minifigure ADD CONSTRAINT fk_a276a0a57e8b4afc FOREIGN KEY (quantity_id) REFERENCES quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quantity DROP CONSTRAINT FK_9FF3163630600219');
        $this->addSql('ALTER TABLE quantity DROP CONSTRAINT FK_9FF31636F2289060');
        $this->addSql('DROP INDEX IDX_9FF3163630600219');
        $this->addSql('DROP INDEX IDX_9FF31636F2289060');
        $this->addSql('ALTER TABLE quantity DROP minifigure_id_id');
        $this->addSql('ALTER TABLE quantity DROP brick_id_id');
    }
}
