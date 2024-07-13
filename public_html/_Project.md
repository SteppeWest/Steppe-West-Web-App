# SW Basic Web App

## Project Outline

#### 1. An object oriented app, with the application object being `SW`.

Other objects will be `SWObjectName`.

#### 2. A minimalist entry script.

Modelled on Yii, in which...

1. Minimum necessary data local to the entry script is set.
2. Minimum necessary files are required or included.
3. The application is instantiated & run in a single call.

I would prefer the only data set be the location of the app.

#### 3. Two entry points conforming to public host requirements.

The public host only permits the root domain (steppewest.com in our case) to be at `public_html`. This is replicated on the development server. Subdomains are at `public_html/some/folder`. I am using `public_html/sw_subdomain`.

My root domain is `steppewest.tld` (where `tld` differs between public & development). My subdomain is `invite.steppewest.tld`, for `public_html/sw_invite`.

Any of this may beused in logic that reduces data set above.

#### 4. We take a step by step approach.

First we simply want to instantiated & run the `SW` app object without error.

#### 5. I will progressively update this document.


## File Tree

* Comments on folders or files relate to the item itself.
* Comments inside folders relate to the folder contents.

```tree
public_html/
├─ // web root for steppewest.tld
├─ 0190888a-c7e9-7bfc-a951-6005e1293165/
│  ├─ data/
│  │  ├─ common/
│  │  │  ├─ // language data not part of a page body
│  │  │  ├─ az.php
│  │  │  ├─ en.php
│  │  │  ├─ kk.php
│  │  │  ├─ ky.php
│  │  │  ├─ mn.php
│  │  │  ├─ ru.php
│  │  │  ├─ tg.php
│  │  │  ├─ tk.php
│  │  │  ├─ tr.php
│  │  │  └─ uz.php
│  │  ├─ faq/
│  │  │  ├─ // language data for the page body at invite.steppewest.tld/faq
│  │  │  ├─ az.php
│  │  │  ├─ en.php
│  │  │  ├─ kk.php
│  │  │  ├─ ky.php
│  │  │  ├─ mn.php
│  │  │  ├─ ru.php
│  │  │  ├─ tg.php
│  │  │  ├─ tk.php
│  │  │  ├─ tr.php
│  │  │  └─ uz.php
│  │  ├─ home/
│  │  │  ├─ // language data for the page body at steppewest.tld
│  │  │  ├─ az.php
│  │  │  ├─ en.php
│  │  │  ├─ kk.php
│  │  │  ├─ ky.php
│  │  │  ├─ mn.php
│  │  │  ├─ ru.php
│  │  │  ├─ tg.php
│  │  │  ├─ tk.php
│  │  │  ├─ tr.php
│  │  │  └─ uz.php
│  │  ├─ invite/
│  │  │  ├─ // language data for the page body at invite.steppewest.tld
│  │  │  ├─ az.php
│  │  │  ├─ en.php
│  │  │  ├─ kk.php
│  │  │  ├─ ky.php
│  │  │  ├─ mn.php
│  │  │  ├─ ru.php
│  │  │  ├─ tg.php
│  │  │  ├─ tk.php
│  │  │  ├─ tr.php
│  │  │  └─ uz.php
│  │  ├─ // data of a utilitarian nature
│  │  ├─ circles.php
│  │  ├─ langmap.php // not yet in use
│  │  ├─ languages.php // not yet in use
│  │  ├─ resources.php
│  │  ├─ rowData.php
│  │  ├─ socials.php
│  │  └─ substitutions.php
│  ├─ views/
│  │  ├─ // html renderings
│  │  ├─ content.min.php
│  │  ├─ content.php
│  │  ├─ content.min_.php
│  │  ├─ content_.php
│  │  ├─ footer.min.php
│  │  ├─ footer.php
│  │  ├─ head.min.php
│  │  ├─ head.php
│  │  ├─ header.min.php
│  │  ├─ header.php
│  │  ├─ header.min_.php
│  │  ├─ header_.php
│  │  ├─ languages.min.php
│  │  ├─ languages.php
│  │  ├─ signature.min.php
│  │  ├─ signature.php
│  │  ├─ signature.min_.php
│  │  └─ signature_.php
│  ├─ app.php // the logic
│  ├─ SW.php // proposed object oriented app object
│  ├─ SWLanguage.php // suggested object
│  ├─ SWLanguageList.php // suggested object
│  └─ SWRenderer.php // suggested object
├─ sw_invite/
│  ├─ // web root for invite.steppewest.tld
│  ├─ ui/
│  │  ├─ // static content for invite.steppewest.tld
│  │  ├─ css/
│  │  │  └─ // css files
│  │  ├─ ico/
│  │  │  └─  ico files
│  │  ├─ img/
│  │  │  └─  img files
│  │  └─ js/
│  │     └─  js files
│  ├─ .htaccess
│  ├─ browserconfig.xml
│  ├─ index.max.php
│  ├─ index.min.php
│  └─ index.php // entry script for invite.steppewest.tld
├─ ui/
│  ├─ static content for steppewest.tld
│  ├─ css/
│  │  └─ // css files
│  ├─ ico/
│  │  └─  ico files
│  ├─ img/
│  │  └─  img files
│  └─ js/
│     └─  js files
├─ .htaccess
├─ browserconfig.xml
├─ index.max.php
├─ index.min.php
├─ index.obj.php // suggested object oriented entry script
└─ index.php // entry script for steppewest.tld
```
