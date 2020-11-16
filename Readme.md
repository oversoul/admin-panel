# Admin Panel

framework agnostic admin panel.

## Goal

trying to make it as minimal as possible. it allows you to create multiple pages with different types (table, form).
without intervening much with your code base. 

ps: you still need to setup your routes, the authentication etc...

## Response

We allow multiple type of responses, as a default we used php views, but we figured for laravel users as an example, would use `blade` instead, so one possible solution is to create a different `Renderer`.

For now we have two default `Renderers`:

- `DefaultRenderer` this just returns an array as output
- `JsonRenderer` this returns json output

To create a Renderer make it extends `Aecodes\AdminPanel\Responses\Renderer`. then add it to config.

### Currently supported Layouts

- Table (Takes array of TD, every TD can be custom rendered)
- Form (Takes array of Fields)
- Div (the only use case is to have customized wrappers)
- It's possible to create your own widgets.

ps: widgets implements `Widget` interface.

### Currently supported Form fields

- Input (text, password, email, number, ...)
- Radio
- Select
- Textarea
- Checkbox
- Image (upload single image)

### How to setup

1. install with composer
2. create a config file using `config/panel.php` as a starting point.
3. create (singleton) instance of `Dashboard` class, make sure to pass the config as an array.

```php
$config = require './config/panel.php';
Aecodes\AdminPanel\Dashboard::setup($config);
```

### How to create an admin page

1. create a new class extending the `Panel` class
2. for convenience set the properties for both `$name` & `$description` of the panel (visible on the page).
3. create a `query` method that returns the array of data.

```php
function query(): array {
    // get data from database.
    return Page::all()->toArray();
}
```

4. create a `render` method that returns an array of widgets.

- to create a table

```php
function render(): array {
    return [
        Table::make([
            // (label, name) both are optional
            TD::make('#', 'id'),
            // it's also possible to use Table::column
            Table::column('Title', 'title'),
        ])
        // ...
    ];
}
```

- to create a form

```php
function render(): array {
    return [
        Form::make([
            Input::make('title')->title('Title'),

            // form submit
            Action::button('Save'),
        ])
        ->action('#')
        ->method('post'),
        // ...
    ];
}
```

5. to finish up, in the callback of your route, just return a new instance of the class you created.


```php
// callback for some route
public function index() {
    // PagesTable extends Panel
    return (new Response(new PagesTable))->render();
}
```

### Extendability

#### Layouts

when extending the `Panel` class you can specify the `$layout` property.

#### Views

this doesn't ship with a view layer. you can use the default (soon) views packages.  

### Config

The default config is:

```php
return [
    // current renderer.
	'renderer' => 'default',

    // add new renderer here.
	'renderers' => [
		'json'    => Aecodes\AdminPanel\Responses\JsonRenderer::class,
		'default' => Aecodes\AdminPanel\Responses\DefaultRenderer::class,
	],

    // default classes for button and a tag.
	'classes' => [
		'link'   => '',
		'button' => '',
	],

    // global menus, can be and array or callback
	'menu' => function () {
		return [];
	},

    // input old value.
	'old_value' => function ($name, $default) {
		return $default;
	},

    // global errors (i.e: validation errors)
	'errors' => function () {
		return [];
	}

];
```
