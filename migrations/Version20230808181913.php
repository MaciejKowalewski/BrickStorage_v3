<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808181913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE minifigure_bricks_quantity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE minifigure_bricks_quantity (id INT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE minifigure_bricks_quantity_minifigure (minifigure_bricks_quantity_id INT NOT NULL, minifigure_id INT NOT NULL, PRIMARY KEY(minifigure_bricks_quantity_id, minifigure_id))');
        $this->addSql('CREATE INDEX IDX_74E46FFD6A87F6F4 ON minifigure_bricks_quantity_minifigure (minifigure_bricks_quantity_id)');
        $this->addSql('CREATE INDEX IDX_74E46FFD3FC93DA4 ON minifigure_bricks_quantity_minifigure (minifigure_id)');
        $this->addSql('CREATE TABLE minifigure_bricks_quantity_minifigure_bricks_quantity (minifigure_bricks_quantity_source INT NOT NULL, minifigure_bricks_quantity_target INT NOT NULL, PRIMARY KEY(minifigure_bricks_quantity_source, minifigure_bricks_quantity_target))');
        $this->addSql('CREATE INDEX IDX_548202C8EDAD868B ON minifigure_bricks_quantity_minifigure_bricks_quantity (minifigure_bricks_quantity_source)');
        $this->addSql('CREATE INDEX IDX_548202C8F448D604 ON minifigure_bricks_quantity_minifigure_bricks_quantity (minifigure_bricks_quantity_target)');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure ADD CONSTRAINT FK_74E46FFD6A87F6F4 FOREIGN KEY (minifigure_bricks_quantity_id) REFERENCES minifigure_bricks_quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure ADD CONSTRAINT FK_74E46FFD3FC93DA4 FOREIGN KEY (minifigure_id) REFERENCES minifigure (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure_bricks_quantity ADD CONSTRAINT FK_548202C8EDAD868B FOREIGN KEY (minifigure_bricks_quantity_source) REFERENCES minifigure_bricks_quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure_bricks_quantity ADD CONSTRAINT FK_548202C8F448D604 FOREIGN KEY (minifigure_bricks_quantity_target) REFERENCES minifigure_bricks_quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE minifigure_bricks_quantity_id_seq CASCADE');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure DROP CONSTRAINT FK_74E46FFD6A87F6F4');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure DROP CONSTRAINT FK_74E46FFD3FC93DA4');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure_bricks_quantity DROP CONSTRAINT FK_548202C8EDAD868B');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure_bricks_quantity DROP CONSTRAINT FK_548202C8F448D604');
        $this->addSql('DROP TABLE minifigure_bricks_quantity');
        $this->addSql('DROP TABLE minifigure_bricks_quantity_minifigure');
        $this->addSql('DROP TABLE minifigure_bricks_quantity_minifigure_bricks_quantity');
    }
}
