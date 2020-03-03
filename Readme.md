# Admin Panel

framework agnostic admin panel.

## Goal

trying to make it as minimal as possible. it allows you to create mutliple pages with different types (table, form, card).
without intervening much with your base code. 

ps: you still need to setup your routes, the authentification etc...

### Currently supported Layouts

- Card (dashboard card, title action link)
- Table (Takes array of TD, every TD can be custom rendered)
- Form (Takes array of Fields)
- Div (the only use case is to have customized wrappers)

### Currently supported Form fields

- Input (text, password, email, number, ...)
- Select
- Textarea
- Checkbox
- Image (upload single image)

### How to setup

1. install with composer
2. extends `AdminConfig` class, and override the configuration you want to change.
3. create new (singleton) instance of `Dashboard` class, make sure to pass a new instance of your configuration class.


### How to create an admin page

1. create a class that extends the `Panel` class
2. for convenience set the properties for both `$name` & `$description` of the panel (visible on the page)
3. create a `query` method that returns the array of data.
4. create a `render` method that returns an array.

```php
function query(): array {
    $pages = // get data from database.

    return $pages;
}
```

5. to create a table

```php
function render(): array {
    return [
        Table::make([
            // (field name, field label)
            TD::make('id', '#'),
            TD::make('title', 'Title'),
        ])
    ];
}
```

6. to create a form

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
    ];
}
```

7. to finish up, in the callback of your route, just return a new instance of the class you created. it must be returned as a `string`.

ps: in many frameworks (laravel as an example), returning an instance from the callback calls the `__toString`. with that you will only need to return the new instance.

```php
// callback for some route
public function index() {
    // PagesTable extends Panel
    return new PagesTable;
}
```

### Extendablity

#### Layouts

by default this has two layouts (auth, default), when extending the `Panel` class you can specify the `$layout` property.

#### Views

It's possible to change the look of your admin panel. by default the views exists in the `presenters` folder. if you choose, you can specify in the config. a different path, where you can add your custom view files. any not found files, will fallback to the default `presenter`. Allowing you to override just one layout file.


### Config

Extending the config class. allows you to customize globally the admin panel:

1. Used as a fallback for getting inputs value after refreshing the page, In case of validation error etc...

```php
public function oldValue(string $name, $default)
```

2. Used for return Session flash messages (notification)

```php
public function flash(): array
```

3. Used for return validation errors.

```php
public function errors(): array
```

4. Specify the views (presenters) path. if the return is invalid, the system will fallback to default views.

```php
public function viewsPath(): string
```  

5. This is used for fields that exists in all forms, mostly: `csrf` token

```php
public function globalFormFields(): array
```  

6. the list of menu items for the admin panel, (array of arrays)

```php
// [[ 'name' => 'Dashboard', 'url' => '/' ]]
public function menu(): array
```

7. This is used to disable the admin panel internal exception handling

```php
public function handleExceptions(): bool
```