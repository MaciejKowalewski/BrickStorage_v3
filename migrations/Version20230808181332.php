<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808181332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE minifigure_brick_id_seq CASCADE');
        $this->addSql('ALTER TABLE minifigure_brick_brick DROP CONSTRAINT fk_cf0e969293a607c0');
        $this->addSql('ALTER TABLE minifigure_brick_brick DROP CONSTRAINT fk_cf0e96928558682');
        $this->addSql('ALTER TABLE minifigure_brick_minifigure DROP CONSTRAINT fk_3ebee7a893a607c0');
        $this->addSql('ALTER TABLE minifigure_brick_minifigure DROP CONSTRAINT fk_3ebee7a83fc93da4');
        $this->addSql('DROP TABLE minifigure_brick_brick');
        $this->addSql('DROP TABLE minifigure_brick_minifigure');
        $this->addSql('DROP TABLE minifigure_brick');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE minifigure_brick_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE minifigure_brick_brick (minifigure_brick_id INT NOT NULL, brick_id INT NOT NULL, PRIMARY KEY(minifigure_brick_id, brick_id))');
        $this->addSql('CREATE INDEX idx_cf0e96928558682 ON minifigure_brick_brick (brick_id)');
        $this->addSql('CREATE INDEX idx_cf0e969293a607c0 ON minifigure_brick_brick (minifigure_brick_id)');
        $this->addSql('CREATE TABLE minifigure_brick_minifigure (minifigure_brick_id INT NOT NULL, minifigure_id INT NOT NULL, PRIMARY KEY(minifigure_brick_id, minifigure_id))');
        $this->addSql('CREATE INDEX idx_3ebee7a83fc93da4 ON minifigure_brick_minifigure (minifigure_id)');
        $this->addSql('CREATE INDEX idx_3ebee7a893a607c0 ON minifigure_brick_minifigure (minifigure_brick_id)');
        $this->addSql('CREATE TABLE minifigure_brick (id INT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE minifigure_brick_brick ADD CONSTRAINT fk_cf0e969293a607c0 FOREIGN KEY (minifigure_brick_id) REFERENCES minifigure_brick (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minifigure_brick_brick ADD CONSTRAINT fk_cf0e96928558682 FOREIGN KEY (brick_id) REFERENCES brick (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minifigure_brick_minifigure ADD CONSTRAINT fk_3ebee7a893a607c0 FOREIGN KEY (minifigure_brick_id) REFERENCES minifigure_brick (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minifigure_brick_minifigure ADD CONSTRAINT fk_3ebee7a83fc93da4 FOREIGN KEY (minifigure_id) REFERENCES minifigure (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
