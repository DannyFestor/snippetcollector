<?php

namespace Database\Seeders;

use App\Models\Example;
use Illuminate\Database\Seeder;

class ExampleSeeder extends Seeder
{
    public function run()
    {
        Example::factory()->create([
            'snippet_id' => 1,
            'code' => <<<MARKDOWN
```php
<?php
echo 'this is cool';
```
MARKDOWN,
            'implementation' => <<<HTML
<button class="px-4 py-2 bg-blue-600 text-white transition rounded hover:scale-105 hover:shadow-lg">Button</button>
HTML,
            'styles' => <<<HTML
<style>
.transition {
  transition-property: color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}
.text-white {
  --tw-text-opacity: 1;
  color: rgb(255 255 255);
}
.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}
.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}
.bg-blue-600 {
  --tw-bg-opacity: 1;
  background-color: rgb(37 99 235);
}
.rounded {
  border-radius: 0.25rem;
}
.hover\:shadow-lg:hover {
  --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
  --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
  box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}
.hover\:scale-105:hover {
  --tw-scale-x: 1.05;
  --tw-scale-y: 1.05;
  transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
}
</style>
HTML,

        ]);
        Example::factory()->create([
            'snippet_id' => 1,
            'code' => <<<MARKDOWN
```javascript
class User
{
    constructor(name)
    {
        this.name = name
    }

    get name()
    {
        return 'My name: ' + this.name;
    }
}

const u = new User('Danny');
console.log(u.name);
```
MARKDOWN,
            'implementation' => <<<JAVASCRIPT
<script>
class User
{
    constructor(name)
    {
        this._name = name
    }

    get name()
    {
        return 'My name: ' + this._name;
    }
}

const u = new User('Danny');
console.log(u.name);
</script>
Look in the console!
JAVASCRIPT,
        ]);
    }
}
