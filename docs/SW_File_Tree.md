# SW File Tree

```tree
steppewest_basic/
├─ // Mandatory web folder for root domain
├─ f85e7124-c0dc-4c64-9e91-99036ba56790/ // the yii folder renamed
│  ├─ assets/
│  │  ├─ base/
│  │  │  ├─ SWAssetBundle.php // base for all our custom assets
│  │  │  ├─ SWBootstrapAsset.php
│  │  │  ├─ SWBootstrapIconsAsset.php
│  │  │  ├─ SWBootstrapPluginAsset.php
│  │  │  ├─ SWJqueryAsset.php
│  │  │  └─ SWYiiAsset.php
│  │  ├─ lib/
│  │  │  ├─ css/
│  │  │  │  ├─ steppe-west.css
│  │  │  │  └─ steppe-west.min.css
│  │  │  ├─ ico/
│  │  │  ├─ img/
│  │  │  ├─ js/
│  │  │  │  ├─ steppe-west.js
│  │  │  │  └─ steppe-west.min.js
│  │  │  └─ svg/
│  │  ├─ _SWAssetExample.php // an example/template | not for use otherwise
│  │  ├─ SWAppAsset.php
│  │  └─ // Additional assets as required
│  ├─ commands/
│  ├─ config/
│  │  ├─ app/ // Config subdomain app.steppewest.com
│  │  │  ├─ console.php
│  │  │  ├─ test.php
│  │  │  └─ web.php
│  │  ├─ dev/ // Config subdomain app.steppewest.com
│  │  │  ├─ console.php
│  │  │  ├─ test.php
│  │  │  └─ web.php
│  │  ├─ home/ // Config subdomain app.steppewest.com
│  │  │  ├─ console.php
│  │  │  ├─ test.php
│  │  │  └─ web.php
│  │  ├─ invite/ // Config subdomain app.steppewest.com
│  │  │  ├─ console.php
│  │  │  ├─ test.php
│  │  │  └─ web.php
│  │  ├─ links/ // Config subdomain app.steppewest.com
│  │  │  ├─ console.php
│  │  │  ├─ test.php
│  │  │  └─ web.php // Common config
│  │  ├─ __autocomplete.php
│  │  ├─ console.php
│  │  ├─ db.php
│  │  ├─ params.php
│  │  ├─ test_db.php
│  │  ├─ test.php
│  │  └─ web.php
│  ├─ controllers/
│  ├─ mail/
│  ├─ models/
│  ├─ runtime/
│  ├─ tests/
│  ├─ themes/
│  │  ├─ base/
│  │  │  ├─ layouts/
│  │  │  │  ├─ main.php
│  │  │  │  ├─ header.php
│  │  │  │  └─ footer.php
│  │  │  ├─ partials/
│  │  │  │  ├─ _navbar.php
│  │  │  │  ├─ _sidebar.php
│  │  │  │  └─ _letterContent.php
│  │  │  └─ site/
│  │  │     ├─ index.php
│  │  │     └─ // other site files
│  │  ├─ admin/
│  │  │  ├─ layouts/
│  │  │  │  ├─ main.php
│  │  │  │  ├─ header.php
│  │  │  │  └─ footer.php
│  │  │  ├─ partials/
│  │  │  │  ├─ _navbar.php
│  │  │  │  ├─ _sidebar.php
│  │  │  │  └─ _letterContent.php
│  │  │  └─ site/
│  │  │     ├─ index.php
│  │  │     └─ // other site files
│  │  ├─ letter/
│  │  │  ├─ layouts/
│  │  │  │  ├─ main.php
│  │  │  │  ├─ header.php
│  │  │  │  └─ footer.php
│  │  │  ├─ partials/
│  │  │  │  ├─ _navbar.php
│  │  │  │  ├─ _sidebar.php
│  │  │  │  └─ _letterContent.php
│  │  │  └─ site/
│  │  │     ├─ index.php
│  │  │     └─ // other site files
│  │  └─ links/
│  │     ├─ layouts/
│  │     │  ├─ main.php
│  │     │  ├─ header.php
│  │     │  └─ footer.php
│  │     ├─ partials/
│  │     │  ├─ _navbar.php
│  │     │  └─ _sidebar.php
│  │     └─ site/
│  │        ├─ index.php
│  │        └─ // other site files
│  ├─ vagrant/
│  ├─ vendor/
│  ├─ views/
│  ├─ web/
│  │  └─ // Retained but unused original web folder
│  ├─ widgets/
│  ├─ codeception.yml
│  ├─ composer.json
│  ├─ composer.lock
│  ├─ docker-compose.yml
│  ├─ LICENSE.md
│  ├─ README.md
│  ├─ requirements.php
│  ├─ Vagrantfile
│  ├─ yii
│  └─ yii.bat
├─ app/
│  ├─ // Web folder for app.steppewest.com
│  ├─ assets/
│  │  └─ // Yii published assets for app.steppewest.com
│  ├─ index-test.php
│  ├─ index.php
│  └─ robots.txt
├─ dev/
│  ├─ // Web folder for dev.steppewest.com
│  ├─ assets/
│  │  └─ // Yii published assets for dev.steppewest.com
│  ├─ index-test.php
│  ├─ index.php
│  └─ robots.txt
├─ invite/
│  ├─ // Web folder for invite.steppewest.com
│  ├─ assets/
│  │  └─ // Yii published assets for invite.steppewest.com
│  ├─ index-test.php
│  ├─ index.php
│  └─ robots.txt
├─ links/
│  ├─ // Web folder for links.steppewest.com
│  ├─ assets/
│  │  └─ // Yii published assets for links.steppewest.com
│  ├─ index-test.php
│  ├─ index.php
│  └─ robots.txt
├─ assets/
│  └─ // Yii published assets for steppewest.com (no subdomain)
├─ docs/
│  └─ // These docs. Not for upload
├─ index-test.php
├─ index.php
└─ robots.txt
```
