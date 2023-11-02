INIZIO PROGETTO
Copio il file .env.example e lo rinomino in .env (senza cancellare il file .env.example)

DAL TERMIANLE| cp .env.example .env

Apro il terminale ed eseguo il comando| composer install

Dopo l'esecuzione di composer install seguo nel terminale il comando| php artisan key:generate

Dopo l'esecuzione di php artisan key:generate, eseguo nel terminale il comando| npm i

Dopo l'esecuzione di npm i| a. Avvio il server di Laravel con php artisan serve e di fianco avvio npm run dev b. Eseguo il comando npm run build e poi avvio il server di Laravel con php artisan serve

CONESSIONE DATABASE

In file .env DB_DATABASE aggiungi nome del tuo Database

CRUD + Aggiungere un entità
CREAZIONE TABELLE DB(MIGRATION)

public function up(): void { Schema::create('trains', function (Blueprint $table) { $table->id(); $table->string('train_company',32); $table->string('departure_station',32); $table->string('arrival_station',32); }); }

php artisan make:migration create_users_table

php artisan migrate (AGGIUNGI TABELLA AL TUO DB)

php artisan migrate:rollback (CANCELLA TABELLA DA TUO DB)

CREAZIONE MODEL(CLASSE)

php artisan make:model NomeDellaClasse

CREAZIONE SEEDER(INSERIMENTO DATI IN DB)

php artisan make:seeder UsersTableSeeder

   public function run(): void
{ for ($i=0; $i < 15; $i++) {

        $train = new Train();

        $train->train_company = fake()->word();
        $train->departure_station = fake()->word();
        $train->arrival_station = fake()->word();
        $train->departure_time = fake()->dateTimeBetween('-3 day');
        
        $train->save();
   }
}

   php artisan db:seed --class=UsersTableSeeder (AGGIUNGI DATI AL DB)
CREAZIONE CONTROLLER (FolderName Guest per gli utenti | FolderName Admin per gli admin del sito)

php artisan make:controller FolderName/FileName

CONTROLLER CON FUNZIONI CRUD
php artisan make:controller FolderName/FileName --resource

CREAZIONE ROUTES IN WEB.PHP

Route::resource('NOMETABELLA',MyController::class) -> crea una rotta per tutte le 7 funzioni del controller CRUD

COMANDI UTILI
 php artisan route:list => vedi tutte le route della CRUD