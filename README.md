# Laravel TypeScript Generator

Un package Laravel pour générer automatiquement des interfaces TypeScript à partir de vos modèles Eloquent, enums et classes PHP.

## Installation

```bash
composer require ycp/laravel-ts-generator
```
## Configuration

Publiez le fichier de configuration :

```bash
php artisan vendor:publish --provider="Ycp\LaravelTsGenerator\LaravelTsGeneratorServiceProvider"
```
Cela créera le fichier `config/laravel-ts-generator.php` où vous pourrez configurer :

- Les différents points d'entrées des fichiers
- Les options de génération

## Utilisation

### Commande de base

```bash
php artisan ts:generate
```

## Configuration des sources
Dans le fichier de configuration, vous pouvez spécifier les différentes sources disponibles

### Par dossiers
```php
"entries" => [
    // Une entrée est défini par une clé et un tableau de valeur
    "base" => [
    
        // Les différentes sources
        "input" => [
            
            // Specifié par classe
            // ex: MyModel::class
            "specified_class" => [],
            
            // Spécifié par namespace de dossier
            // Ex : App/Models
            "namespaces" => [],
            
            // Spécifié par chemin direct (dossier ou fichier)
            // Ex : app/Models/MyModel.php
            // Ex : app/Models
            "paths" => [],
        ],
        
        // Provider qui définit la logique de génération pour cette entrée
        "provider" => \Ycp\LaravelTsGenerator\Application\Providers\ClassProvider::class
    ]
],
```

## Exemples de génération

### Modèle Eloquent
```php
class User extends Model
{
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
```

Génère :
```typescript
export interface User {
  id: number;
  name: string;
  email: string;
  created_at?: string;
  updated_at?: string;
  posts?: Post[];
}
```
### Enum PHP
```php
enum UserStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';
}
```

Génère :
```typescript
export enum UserStatus {
  ACTIVE = 'active',
  INACTIVE = 'inactive',
  PENDING = 'pending'
}
```

### DTO/Data Class
```php
class UserData
{
    public function __construct(
        public string $name,
        public string $email,
        public ?int $age = null
    ) {}
}
```

Génère :
```typescript
export interface UserData {
  name: string;
  email: string;
  age?: number|null;
}
```


