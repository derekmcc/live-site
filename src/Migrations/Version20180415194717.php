<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180415194717 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE recipe (id INTEGER NOT NULL, author_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, ingredients VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, is_public BOOLEAN NOT NULL, request_recipe_public BOOLEAN NOT NULL, published_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DA88B137F675F31B ON recipe (author_id)');
        $this->addSql('CREATE TABLE review (id INTEGER NOT NULL, author_id INTEGER DEFAULT NULL, votes_id INTEGER DEFAULT NULL, recipe_id INTEGER DEFAULT NULL, published_at DATETIME NOT NULL, summary VARCHAR(255) NOT NULL, retailers VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, is_public_review BOOLEAN NOT NULL, request_review_public BOOLEAN NOT NULL, stars DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL, up_votes INTEGER DEFAULT NULL, down_votes INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_794381C6F675F31B ON review (author_id)');
        $this->addSql('CREATE INDEX IDX_794381C65308DFC8 ON review (votes_id)');
        $this->addSql('CREATE INDEX IDX_794381C659D8A214 ON review (recipe_id)');
        $this->addSql('CREATE TABLE app_users (id INTEGER NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:json_array)
        , firstname VARCHAR(25) NOT NULL, surname VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824F85E0677 ON app_users (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824E7927C74 ON app_users (email)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE app_users');
    }
}
