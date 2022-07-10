<?php

namespace Database\Seeders;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Database\Seeder;

class SnippetSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $users->first()
            ->snippets()
            ->create([
                'title' => 'Example Snippet',
                'description' => <<<MARKDOWN
# This is the headline
## This is an h2
### This is an h3

* List
* List

1. List
2. List

```php
<?php
echo 'this is cool';
```
MARKDOWN,
                'example' => <<<MARKDOWN
```php
<?php
echo 'this is cool';
```
MARKDOWN,
                'published_at' => now(),
            ]);
        $users->each(fn(User $user) => Snippet::factory(10)->create(['user_id' => $user->id]));
    }
}
