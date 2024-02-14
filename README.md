# Laravel scout tnt search

### Install Scout
```
composer require laravel/scout
```
### Publish config/scout.php file
```
php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"
```


### Install TntSearch
``` 
composer require teamtnt/laravel-scout-tntsearch-driver
```

### Add the service provider:
``` 
TeamTNT\Scout\TNTSearchScoutServiceProvider::class,
 Laravel\Scout\ScoutServiceProvider::class,
```

Then, update the default value of your config config/scout.php file to tntsearch (or update SCOUT_DRIVER in your .env):
``` 
'driver' => env('SCOUT_DRIVER', 'tntsearch'),
```

Finally, because tntsearch is not natively supported by Laravel, the configuration parameters is not present by default, so let's add them manually at the end of the config/scout.php file :
``` 
/*
|--------------------------------------------------------------------------
| MeiliSearch Configuration
|--------------------------------------------------------------------------
|
| Here you may configure your TntSearch settings. TntSearch search
| is an open source PHP engine. No extra services are required
| and all indexes are store locally in `.index` files.
|
| See: https://github.com/teamtnt/laravel-scout-tntsearch-driver
|
*/
'tntsearch' => [
    'storage' => storage_path(), //place where the index files will be stored
    'fuzziness' => env('TNTSEARCH_FUZZINESS', true),
    'fuzzy' => [
        'prefix_length' => 2,
        'max_expansions' => 50,
        'distance' => 2,
    ],
    'asYouType' => false,
    'searchBoolean' => env('TNTSEARCH_BOOLEAN', false),
    'maxDocs' => env('TNTSEARCH_MAX_DOCS', 500),
],
```

### Indexing a model
Add Laravel\Scout\Searchable trait to your desired model
```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    
    public $asYouType = true;

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id, // <- Always include the primary key
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
```

### Now update your controller like this 

``` 
$posts = Post::search('laravel 10')->get();
$posts = Post::search($request->input('search'))->paginate();
```

### Scout Command
``` 
//Import product to scout driver
php artisan scout:import App\Models\Post

//Remove product from scout driver
php artisan scout:flush App\Models\Post

//Check scout status
php artisan scout:status
```
