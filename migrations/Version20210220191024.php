<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210220191024 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE skill_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_skills_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE skill (id INT NOT NULL, type SMALLINT NOT NULL, skill VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_skills (id INT NOT NULL, user_id INT NOT NULL, skill_id INT NOT NULL, is_top BOOLEAN NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE skill_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_skills_id_seq CASCADE');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE user_skills');
    }
}
