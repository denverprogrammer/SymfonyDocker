<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831145934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exchange (
          id INT AUTO_INCREMENT NOT NULL,
          created DATETIME NOT NULL,
          updated DATETIME NOT NULL,
          code VARCHAR(64) NOT NULL,
          title VARCHAR(128) NOT NULL,
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_log_entries (
          id INT AUTO_INCREMENT NOT NULL,
          action VARCHAR(8) NOT NULL,
          logged_at DATETIME NOT NULL,
          object_id VARCHAR(64) DEFAULT NULL,
          object_class VARCHAR(255) NOT NULL,
          version INT NOT NULL,
          data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\',
          username VARCHAR(255) DEFAULT NULL,
          INDEX log_class_lookup_idx (object_class),
          INDEX log_date_lookup_idx (logged_at),
          INDEX log_user_lookup_idx (username),
          INDEX log_version_lookup_idx (object_id, object_class, version),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE ext_translations (
          id INT AUTO_INCREMENT NOT NULL,
          locale VARCHAR(8) NOT NULL,
          object_class VARCHAR(255) NOT NULL,
          field VARCHAR(32) NOT NULL,
          foreign_key VARCHAR(64) NOT NULL,
          content LONGTEXT DEFAULT NULL,
          INDEX translations_lookup_idx (
            locale, object_class, foreign_key
          ),
          UNIQUE INDEX lookup_unique_idx (
            locale, object_class, field, foreign_key
          ),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE market (
          id INT AUTO_INCREMENT NOT NULL,
          created DATETIME NOT NULL,
          updated DATETIME NOT NULL,
          code VARCHAR(64) NOT NULL,
          title VARCHAR(128) NOT NULL,
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (
          id INT AUTO_INCREMENT NOT NULL,
          created DATETIME NOT NULL,
          updated DATETIME NOT NULL,
          message_body VARCHAR(4000) DEFAULT NULL,
          message_type VARCHAR(16) NOT NULL,
          recipient_type VARCHAR(180) DEFAULT \'email\' NOT NULL,
          recipient VARCHAR(180) NOT NULL,
          title VARCHAR(128) NOT NULL,
          token VARCHAR(64) DEFAULT NULL,
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE security (
          id INT AUTO_INCREMENT NOT NULL,
          created DATETIME NOT NULL,
          updated DATETIME NOT NULL,
          code VARCHAR(64) NOT NULL,
          title VARCHAR(128) NOT NULL,
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (
          id INT AUTO_INCREMENT NOT NULL,
          exchange_id INT DEFAULT NULL,
          market_id INT DEFAULT NULL,
          security_id INT DEFAULT NULL,
          created DATETIME NOT NULL,
          updated DATETIME NOT NULL,
          code VARCHAR(64) NOT NULL,
          title VARCHAR(128) NOT NULL,
          INDEX IDX_4B36566068AFD1A0 (exchange_id),
          INDEX IDX_4B365660622F3F37 (market_id),
          INDEX IDX_4B3656606DBE4214 (security_id),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (
          id INT AUTO_INCREMENT NOT NULL,
          user_id INT DEFAULT NULL,
          trackrecord_id INT DEFAULT NULL,
          created DATETIME NOT NULL,
          updated DATETIME NOT NULL,
          starts_on DATETIME NOT NULL,
          ends_on DATETIME NOT NULL,
          trackrecord_actions TINYTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\',
          subscription_actions TINYTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\',
          pending_order_actions TINYTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\',
          filled_order_actions TINYTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\',
          open_position_actions TINYTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\',
          closed_position_actions TINYTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\',
          user_type VARCHAR(10) NOT NULL,
          INDEX IDX_A3C664D3A76ED395 (user_id),
          INDEX IDX_A3C664D3E2C22D (trackrecord_id),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trackrecord (
          id INT AUTO_INCREMENT NOT NULL,
          created DATETIME NOT NULL,
          updated DATETIME NOT NULL,
          title VARCHAR(128) NOT NULL,
          description VARCHAR(4000) NOT NULL,
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (
          id INT AUTO_INCREMENT NOT NULL,
          roles JSON NOT NULL,
          created DATETIME NOT NULL,
          updated DATETIME NOT NULL,
          view_state VARCHAR(16) DEFAULT \'anomyous\' NOT NULL,
          email VARCHAR(180) NOT NULL,
          username VARCHAR(255) NOT NULL,
          confirmed TINYINT(1) DEFAULT \'0\' NOT NULL,
          token VARCHAR(64) DEFAULT NULL,
          password VARCHAR(255) NOT NULL,
          agreement TINYINT(1) DEFAULT \'0\' NOT NULL,
          notifications TINYINT(1) DEFAULT \'0\' NOT NULL,
          UNIQUE INDEX UNIQ_8D93D649F85E0677 (username),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE
          stock
        ADD
          CONSTRAINT FK_4B36566068AFD1A0 FOREIGN KEY (exchange_id) REFERENCES exchange (id)');
        $this->addSql('ALTER TABLE
          stock
        ADD
          CONSTRAINT FK_4B365660622F3F37 FOREIGN KEY (market_id) REFERENCES market (id)');
        $this->addSql('ALTER TABLE
          stock
        ADD
          CONSTRAINT FK_4B3656606DBE4214 FOREIGN KEY (security_id) REFERENCES security (id)');
        $this->addSql('ALTER TABLE
          subscription
        ADD
          CONSTRAINT FK_A3C664D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE
          subscription
        ADD
          CONSTRAINT FK_A3C664D3E2C22D FOREIGN KEY (trackrecord_id) REFERENCES trackrecord (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B36566068AFD1A0');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660622F3F37');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656606DBE4214');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3E2C22D');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3A76ED395');
        $this->addSql('DROP TABLE exchange');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE market');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE security');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE trackrecord');
        $this->addSql('DROP TABLE user');
    }
}
