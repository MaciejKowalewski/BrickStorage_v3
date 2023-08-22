<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808184931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE quantity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE quantity (id INT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE quantity_minifigure (quantity_id INT NOT NULL, minifigure_id INT NOT NULL, PRIMARY KEY(quantity_id, minifigure_id))');
        $this->addSql('CREATE INDEX IDX_A276A0A57E8B4AFC ON quantity_minifigure (quantity_id)');
        $this->addSql('CREATE INDEX IDX_A276A0A53FC93DA4 ON quantity_minifigure (minifigure_id)');
        $this->addSql('CREATE TABLE quantity_brick (quantity_id INT NOT NULL, brick_id INT NOT NULL, PRIMARY KEY(quantity_id, brick_id))');
        $this->addSql('CREATE INDEX IDX_E277E7B67E8B4AFC ON quantity_brick (quantity_id)');
        $this->addSql('CREATE INDEX IDX_E277E7B68558682 ON quantity_brick (brick_id)');
        $this->addSql('ALTER TABLE quantity_minifigure ADD CONSTRAINT FK_A276A0A57E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quantity_minifigure ADD CONSTRAINT FK_A276A0A53FC93DA4 FOREIGN KEY (minifigure_id) REFERENCES minifigure (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quantity_brick ADD CONSTRAINT FK_E277E7B67E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quantity_brick ADD CONSTRAINT FK_E277E7B68558682 FOREIGN KEY (brick_id) REFERENCES brick (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE quantity_id_seq CASCADE');
        $this->addSql('ALTER TABLE quantity_minifigure DROP CONSTRAINT FK_A276A0A57E8B4AFC');
        $this->addSql('ALTER TABLE quantity_minifigure DROP CONSTRAINT FK_A276A0A53FC93DA4');
        $this->addSql('ALTER TABLE quantity_brick DROP CONSTRAINT FK_E277E7B67E8B4AFC');
        $this->addSql('ALTER TABLE quantity_brick DROP CONSTRAINT FK_E277E7B68558682');
        $this->addSql('DROP TABLE quantity');
        $this->addSql('DROP TABLE quantity_minifigure');
        $this->addSql('DROP TABLE quantity_brick');
    }
}
