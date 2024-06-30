# SW Views

The Steppe West web app requires three sets of views.

Endpoint              | Name   | Comments
--------------------- | ------ | ---------------------------------------
steppewest.com        | letter | introduction letter, multiple languages
app.steppewest.com    | admin  | forms for managing data, English only
dev.steppewest.com    |        |
invite.steppewest.com | letter | invite letter, multiple languages
links.steppewest.com  | links  | a links page, probably English only

Views should be structured so as to maximise opportunities for sharing components.

Referencing [Theming](https://www.yiiframework.com/doc/guide/2.0/en/output-theming) I consider the tree below appropriate. Some of the files shown may prove unnecessary, & others may be called for.

```tree
themes/
├── base/
│   ├── layouts/
│   │   ├── main.php
│   │   ├── header.php
│   │   └── footer.php
│   ├── partials/
│   │   ├── _navbar.php
│   │   ├── _sidebar.php
│   │   └── _letterContent.php
│   └── site/
│       ├── index.php
│       └── // other site files
├── admin/
│   ├── layouts/
│   │   ├── main.php
│   │   ├── header.php
│   │   └── footer.php
│   ├── partials/
│   │   ├── _navbar.php
│   │   ├── _sidebar.php
│   │   └── _letterContent.php
│   └── site/
│       ├── index.php
│       └── // other site files
├── letter/
│   ├── layouts/
│   │   ├── main.php
│   │   ├── header.php
│   │   └── footer.php
│   ├── partials/
│   │   ├── _navbar.php
│   │   ├── _sidebar.php
│   │   └── _letterContent.php
│   └── site/
│       ├── index.php
│       └── // other site files
└── links/
    ├── layouts/
    │   ├── main.php
    │   ├── header.php
    │   └── footer.php
    ├── partials/
    │   ├── _navbar.php
    │   ├── _sidebar.php
    │   └── _letterContent.php
    └── site/
        ├── index.php
        └── // other site files
```

#### `letter`

```php
```

#### `admin`

```php
```

#### `links`

```php
```


