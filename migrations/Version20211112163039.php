<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112163039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blood_bank (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blood_donation (id INT AUTO_INCREMENT NOT NULL, blood_bank_id INT NOT NULL, location VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_908BB405AE6E20E0 (blood_bank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blood_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donor (id INT AUTO_INCREMENT NOT NULL, blood_group_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, INDEX IDX_D7F240975F3AECE2 (blood_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donor_donation (id INT AUTO_INCREMENT NOT NULL, donor_id INT NOT NULL, blood_donation_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, success TINYINT(1) NOT NULL, created_at DATE NOT NULL, INDEX IDX_64962EBD3DD7B7A7 (donor_id), INDEX IDX_64962EBD9A49365F (blood_donation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blood_donation ADD CONSTRAINT FK_908BB405AE6E20E0 FOREIGN KEY (blood_bank_id) REFERENCES blood_bank (id)');
        $this->addSql('ALTER TABLE donor ADD CONSTRAINT FK_D7F240975F3AECE2 FOREIGN KEY (blood_group_id) REFERENCES blood_group (id)');
        $this->addSql('ALTER TABLE donor_donation ADD CONSTRAINT FK_64962EBD3DD7B7A7 FOREIGN KEY (donor_id) REFERENCES donor (id)');
        $this->addSql('ALTER TABLE donor_donation ADD CONSTRAINT FK_64962EBD9A49365F FOREIGN KEY (blood_donation_id) REFERENCES blood_donation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blood_donation DROP FOREIGN KEY FK_908BB405AE6E20E0');
        $this->addSql('ALTER TABLE donor_donation DROP FOREIGN KEY FK_64962EBD9A49365F');
        $this->addSql('ALTER TABLE donor DROP FOREIGN KEY FK_D7F240975F3AECE2');
        $this->addSql('ALTER TABLE donor_donation DROP FOREIGN KEY FK_64962EBD3DD7B7A7');
        $this->addSql('DROP TABLE blood_bank');
        $this->addSql('DROP TABLE blood_donation');
        $this->addSql('DROP TABLE blood_group');
        $this->addSql('DROP TABLE donor');
        $this->addSql('DROP TABLE donor_donation');
    }
}
