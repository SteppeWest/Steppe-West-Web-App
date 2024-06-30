# SW App Assets

### `app\assets\AppAsset`

* **Extends:** `yii\web\AssetBundle`
* **Depends:**
* **Comment:** unused original asset

### `app\assets\SWAppAsset`

* **Extends:** `app\assets\base\SWAssetBundle`
* **Depends:**
* **Comment:** core asset for our web app

This asset must publish the files...

* `assets/lib/css/steppe-west.min.css`
* `assets/lib/js/steppe-west.min.js`

Other assets we create may publish files from `assets/lib`.

### `app\assets\base\SWAssetBundle`

* **Extends:** `yii\web\AssetBundle`
* **Depends:**
    - `app\assets\base\SWBootstrapAsset`
    - `app\assets\base\SWBootstrapIconsAsset`
    - `app\assets\base\SWBootstrapPluginAsset`
    - `app\assets\base\SWJqueryAsset`
* **Comment:** base for SW custom assets

### `app\assets\base\SWBootstrapAsset`

* **Extends:** `yii\web\AssetBundle`
* **Replaces:** `BootstrapAsset`
* **Depends:**

### `app\assets\base\SWBootstrapIconsAsset`

* **Extends:** `yii\web\AssetBundle`
* **Replaces:** `BootstrapIconsAsset`
* **Depends:**

### `app\assets\base\SWBootstrapPluginAsset`

* **Extends:** `yii\web\AssetBundle`
* **Replaces:** `BootstrapPluginAsset`
* **Depends:**
    - `app\assets\base\SWBootstrapAsset`

### `app\assets\base\SWJqueryAsset`

* **Extends:** `yii\web\AssetBundle`
* **Replaces:** `JqueryAsset`
* **Depends:**

### `app\assets\base\SWYiiAsset`

* **Extends:** `yii\web\AssetBundle`
* **Replaces:** `YiiAsset`
* **Depends:**
    - `app\assets\base\SWJqueryAsset`
* **Comment:**




