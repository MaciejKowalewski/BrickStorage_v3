<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808183319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE minifigure_bricks_quantity_id_seq CASCADE');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure_bricks_quantity DROP CONSTRAINT fk_548202c8edad868b');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure_bricks_quantity DROP CONSTRAINT fk_548202c8f448d604');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure DROP CONSTRAINT fk_74e46ffd6a87f6f4');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure DROP CONSTRAINT fk_74e46ffd3fc93da4');
        $this->addSql('DROP TABLE minifigure_bricks_quantity_minifigure_bricks_quantity');
        $this->addSql('DROP TABLE minifigure_bricks_quantity_minifigure');
        $this->addSql('DROP TABLE minifigure_bricks_quantity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE minifigure_bricks_quantity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE minifigure_bricks_quantity_minifigure_bricks_quantity (minifigure_bricks_quantity_source INT NOT NULL, minifigure_bricks_quantity_target INT NOT NULL, PRIMARY KEY(minifigure_bricks_quantity_source, minifigure_bricks_quantity_target))');
        $this->addSql('CREATE INDEX idx_548202c8f448d604 ON minifigure_bricks_quantity_minifigure_bricks_quantity (minifigure_bricks_quantity_target)');
        $this->addSql('CREATE INDEX idx_548202c8edad868b ON minifigure_bricks_quantity_minifigure_bricks_quantity (minifigure_bricks_quantity_source)');
        $this->addSql('CREATE TABLE minifigure_bricks_quantity_minifigure (minifigure_bricks_quantity_id INT NOT NULL, minifigure_id INT NOT NULL, PRIMARY KEY(minifigure_bricks_quantity_id, minifigure_id))');
        $this->addSql('CREATE INDEX idx_74e46ffd3fc93da4 ON minifigure_bricks_quantity_minifigure (minifigure_id)');
        $this->addSql('CREATE INDEX idx_74e46ffd6a87f6f4 ON minifigure_bricks_quantity_minifigure (minifigure_bricks_quantity_id)');
        $this->addSql('CREATE TABLE minifigure_bricks_quantity (id INT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure_bricks_quantity ADD CONSTRAINT fk_548202c8edad868b FOREIGN KEY (minifigure_bricks_quantity_source) REFERENCES minifigure_bricks_quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure_bricks_quantity ADD CONSTRAINT fk_548202c8f448d604 FOREIGN KEY (minifigure_bricks_quantity_target) REFERENCES minifigure_bricks_quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure ADD CONSTRAINT fk_74e46ffd6a87f6f4 FOREIGN KEY (minifigure_bricks_quantity_id) REFERENCES minifigure_bricks_quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minifigure_bricks_quantity_minifigure ADD CONSTRAINT fk_74e46ffd3fc93da4 FOREIGN KEY (minifigure_id) REFERENCES minifigure (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
