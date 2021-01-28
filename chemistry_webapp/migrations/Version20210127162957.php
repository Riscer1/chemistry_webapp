<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127162957 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aki_ref (id INT AUTO_INCREMENT NOT NULL, oscillator_strength_id INT NOT NULL, ref VARCHAR(100) NOT NULL, reference VARCHAR(5000) NOT NULL, INDEX IDX_3EFC8ACF639F9902 (oscillator_strength_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atom (id INT AUTO_INCREMENT NOT NULL, symbol VARCHAR(25) NOT NULL, name VARCHAR(100) NOT NULL, atomic_number INT NOT NULL, atomic_weight DOUBLE PRECISION NOT NULL, atomic_radius INT NOT NULL, ion_radius INT NOT NULL, melting_temperature DOUBLE PRECISION NOT NULL, density DOUBLE PRECISION NOT NULL, boiling_temperature DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_2040E57BECC836F9 (symbol), UNIQUE INDEX UNIQ_2040E57B5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE energy_level (id INT AUTO_INCREMENT NOT NULL, jonization_level_id INT NOT NULL, configuration VARCHAR(100) NOT NULL, term VARCHAR(20) NOT NULL, j INT NOT NULL, level DOUBLE PRECISION NOT NULL, INDEX IDX_22D3F9582F93CDE4 (jonization_level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fik_ref (id INT AUTO_INCREMENT NOT NULL, oscillator_strength_id INT NOT NULL, ref VARCHAR(100) NOT NULL, reference VARCHAR(5000) NOT NULL, INDEX IDX_CC53462A639F9902 (oscillator_strength_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, atom_id INT NOT NULL, img VARCHAR(255) NOT NULL, INDEX IDX_C53D045F6B300498 (atom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jonization_level (id INT AUTO_INCREMENT NOT NULL, atom_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_DAC8C66C6B300498 (atom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oscillator_strength (id INT AUTO_INCREMENT NOT NULL, jonization_level_id INT NOT NULL, transition VARCHAR(100) NOT NULL, j_j VARCHAR(50) NOT NULL, fik1 DOUBLE PRECISION NOT NULL, aki1 DOUBLE PRECISION NOT NULL, fik2 DOUBLE PRECISION NOT NULL, aki2 DOUBLE PRECISION NOT NULL, fik3 DOUBLE PRECISION NOT NULL, aki3 DOUBLE PRECISION NOT NULL, fik4 DOUBLE PRECISION NOT NULL, aki4 DOUBLE PRECISION NOT NULL, fik5 DOUBLE PRECISION NOT NULL, aki5 DOUBLE PRECISION NOT NULL, term VARCHAR(20) NOT NULL, INDEX IDX_6F9ACF7A2F93CDE4 (jonization_level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aki_ref ADD CONSTRAINT FK_3EFC8ACF639F9902 FOREIGN KEY (oscillator_strength_id) REFERENCES oscillator_strength (id)');
        $this->addSql('ALTER TABLE energy_level ADD CONSTRAINT FK_22D3F9582F93CDE4 FOREIGN KEY (jonization_level_id) REFERENCES jonization_level (id)');
        $this->addSql('ALTER TABLE fik_ref ADD CONSTRAINT FK_CC53462A639F9902 FOREIGN KEY (oscillator_strength_id) REFERENCES oscillator_strength (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F6B300498 FOREIGN KEY (atom_id) REFERENCES atom (id)');
        $this->addSql('ALTER TABLE jonization_level ADD CONSTRAINT FK_DAC8C66C6B300498 FOREIGN KEY (atom_id) REFERENCES atom (id)');
        $this->addSql('ALTER TABLE oscillator_strength ADD CONSTRAINT FK_6F9ACF7A2F93CDE4 FOREIGN KEY (jonization_level_id) REFERENCES jonization_level (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F6B300498');
        $this->addSql('ALTER TABLE jonization_level DROP FOREIGN KEY FK_DAC8C66C6B300498');
        $this->addSql('ALTER TABLE energy_level DROP FOREIGN KEY FK_22D3F9582F93CDE4');
        $this->addSql('ALTER TABLE oscillator_strength DROP FOREIGN KEY FK_6F9ACF7A2F93CDE4');
        $this->addSql('ALTER TABLE aki_ref DROP FOREIGN KEY FK_3EFC8ACF639F9902');
        $this->addSql('ALTER TABLE fik_ref DROP FOREIGN KEY FK_CC53462A639F9902');
        $this->addSql('DROP TABLE aki_ref');
        $this->addSql('DROP TABLE atom');
        $this->addSql('DROP TABLE energy_level');
        $this->addSql('DROP TABLE fik_ref');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE jonization_level');
        $this->addSql('DROP TABLE oscillator_strength');
        $this->addSql('DROP TABLE user');
    }
}
