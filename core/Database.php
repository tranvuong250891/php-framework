<?php

namespace app\core;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $pass = $config['pass'] ?? '';
        $user = $config['user'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    }

    public function applyMigrations()
    {
        // $this->createMigrationsTable();
        $appliedMigrations =  $this->getAppliedMigrations();
        $file = scandir(Application::$ROOT_DIR.'/migrations');
        $toAppliedMigrations = array_diff($file, $appliedMigrations);
        foreach($toAppliedMigrations as $migration){
            if($migration === '.' || $migration === '..'){
                continue;
            }
            require_once Application::$ROOT_DIR."/migrations/$migration";
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            echo $this->log("Apply migration $className");  
            $instance->up();
            echo $this->log("Applied migration $className");
            $instance->down();
            $newMigrations[] = $migration;
        }
        if(empty($newMigrations)){
            echo $this->log("All migration are applied");
        } else {
            $this->saveMigrations($newMigrations);
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations 
        ( id INT AUTO_INCREMENT PRIMARY KEY, migration VARCHAR(255), create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) 
        ENGINE=INNODB" );
    }

    public function getAppliedMigrations()
    {
       $statement = $this->pdo->prepare("SELECT migration FROM migrations")   ;
       $statement->execute();

       return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $migrations =  array_map(fn($migration)=>"('$migration')", $migrations);
        $sql ="INSERT INTO migrations (migration) VALUES ". implode(',', $migrations);
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
    }

    protected function log(string $message)
    {
        return '['. date('Y-m-d H:i:s') .'] - ' .$message. PHP_EOL;
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

}