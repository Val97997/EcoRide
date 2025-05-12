<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250512104549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(45) NOT NULL, registration VARCHAR(255) NOT NULL, fuel VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, registration_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE car_user (car_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_46F9C2E5C3C6F69F (car_id), INDEX IDX_46F9C2E5A76ED395 (user_id), PRIMARY KEY(car_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE carshare (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, car_id INT NOT NULL, departure_date DATE NOT NULL, deaprture_hour TIME NOT NULL, departure_location VARCHAR(45) NOT NULL, arrival_date DATE NOT NULL, arrival_hour TIME NOT NULL, arrival_location VARCHAR(45) NOT NULL, status VARCHAR(45) NOT NULL, available_seats SMALLINT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_7949F9EDA76ED395 (user_id), INDEX IDX_7949F9EDC3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, phone_nb VARCHAR(45) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, birth_date VARCHAR(45) DEFAULT NULL, picture LONGBLOB DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_PSEUDO (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car_user ADD CONSTRAINT FK_46F9C2E5C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car_user ADD CONSTRAINT FK_46F9C2E5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE carshare ADD CONSTRAINT FK_7949F9EDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE carshare ADD CONSTRAINT FK_7949F9EDC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE car_user DROP FOREIGN KEY FK_46F9C2E5C3C6F69F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car_user DROP FOREIGN KEY FK_46F9C2E5A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE carshare DROP FOREIGN KEY FK_7949F9EDA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE carshare DROP FOREIGN KEY FK_7949F9EDC3C6F69F
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE carshare
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
