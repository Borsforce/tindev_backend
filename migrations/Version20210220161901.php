<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210220161901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE developer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, profile_image VARCHAR(255) DEFAULT NULL, header_image VARCHAR(255) DEFAULT NULL, job_status SMALLINT DEFAULT NULL, cv LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', bio LONGTEXT DEFAULT NULL, portfilo_link VARCHAR(255) DEFAULT NULL, github VARCHAR(255) DEFAULT NULL, twitter_handle VARCHAR(50) DEFAULT NULL, job_title VARCHAR(180) DEFAULT NULL, earned_coins INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE developer');
    }
}
