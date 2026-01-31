# Yii2 Logger

![License](https://img.shields.io/packagist/l/cinghie/yii2-logger.svg)
![Latest Stable Version](https://img.shields.io/github/release/cinghie/yii2-logger.svg)
![Latest Release Date](https://img.shields.io/github/release-date/cinghie/yii2-logger.svg)
![Latest Commit](https://img.shields.io/github/last-commit/cinghie/yii2-logger.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/cinghie/yii2-logger.svg)](https://packagist.org/packages/cinghie/yii2-logger)

Yii2 extension to log actions (create, update, delete) to the database. It includes a log list, single log view, and a **timeline** with filters by user, action, model, and date.

---

## Installation

### 1. Install the package

```bash
composer require cinghie/yii2-logger "*"
```

Or add to your `composer.json`:

```json
"require": {
    "cinghie/yii2-logger": "*"
}
```

### 2. Update database schema

```bash
php yii migrate/up --migrationPath=@vendor/cinghie/yii2-logger/migrations
```

---

## Configuration

Register the module in `config/web.php` (or `common/config/main.php`):

```php
use cinghie\logger\Logger;

'modules' => [
    'logger' => [
        'class' => Logger::class,
        'bootstrap' => 'bootstrap',        // 'bootstrap' | 'bootstrap4' | 'bootstrap5'
        'roles' => ['admin'],              // RBAC roles allowed to access the module
        'showTitles' => false,             // show h1 titles in module views
    ],
],
```

- **bootstrap**: if set to `bootstrap4` and you have `cinghie/yii2-adminlte3` installed, the timeline uses the AdminLTE 3 widget.
- **roles**: array of RBAC roles allowed to access index, timeline, and view.
- **showTitles**: set to `true` to show the h1 title on module pages.

---

## Usage examples

### 1. Log an action in a controller

After creating, updating, or deleting a model, save a record to `Loggers`:

```php
use cinghie\logger\models\Loggers;
use yii\helpers\Url;

// Example: after saving a model (e.g. Contact)
public function actionCreate()
{
    $model = new Contact();
    if ($model->load(Yii::$app->request->post()) && $model->save()) {

        $logger = new Loggers();
        $logger->entity_name = 'Contact';
        $logger->entity_id = $model->id;
        $logger->entity_model = 'Contact';
        $logger->entity_url = '/contacts/contacts/view';
        $logger->action = 'create';
        $logger->data = $model->getFullName(); // or any descriptive text
        $logger->created_by = Yii::$app->user->id;
        $logger->ip = Yii::$app->request->userHost;
        $logger->save(false);

        return $this->redirect(['view', 'id' => $model->id]);
    }
    // ...
}
```

### 2. Log for update and delete

```php
// After update
$logger = new Loggers();
$logger->entity_name = 'Order';
$logger->entity_id = $model->id;
$logger->entity_model = 'Order';
$logger->entity_url = '/commerce/order/view';
$logger->action = 'update';
$logger->data = 'Status: ' . $model->status;
$logger->created_by = Yii::$app->user->id;
$logger->ip = Yii::$app->request->userHost;
$logger->save(false);

// After delete (you can pass id and data before deleting the model)
$logger = new Loggers();
$logger->entity_name = 'Product';
$logger->entity_id = $id;
$logger->entity_model = 'Product';
$logger->entity_url = '/commerce/product/index';
$logger->action = 'delete';
$logger->data = $model->name;
$logger->created_by = Yii::$app->user->id;
$logger->ip = Yii::$app->request->userHost;
$logger->save(false);
```

### 3. Helper method on the model (optional)

To avoid repeating the same code, add a method to your model or a trait:

```php
// e.g. in app\models\Contact or in a trait
use cinghie\logger\models\Loggers;

public function logAction($action, $data = '')
{
    $logger = new Loggers();
    $logger->entity_name = 'Contact';
    $logger->entity_id = $this->id;
    $logger->entity_model = 'Contact';
    $logger->entity_url = '/contacts/contacts/view';
    $logger->action = $action; // 'create' | 'update' | 'delete'
    $logger->data = $data ?: $this->getFullName();
    $logger->created_by = Yii::$app->user->id;
    $logger->ip = Yii::$app->request->userHost;
    $logger->save(false);
}

// In controller after $model->save():
$model->logAction('create');
```

### 4. Links to module pages

- **Log list (grid)**: `/logger/loggers/index`
- **Timeline (with filters)**: `/logger/loggers/timeline`
- **Single log detail**: `/logger/loggers/view?id=123`

Example links in a menu or view:

```php
use yii\helpers\Html;
use yii\helpers\Url;

echo Html::a('Log', ['/logger/loggers/index']);
echo Html::a('Timeline', ['/logger/loggers/timeline']);
```

### 5. Timeline widget in a custom view

To show the timeline in another view, use the module’s widget (it automatically picks Bootstrap or AdminLTE3 based on config):

```php
use cinghie\logger\widgets\Timeline;
use cinghie\logger\models\Loggers;
use cinghie\logger\models\LoggersSearch;

// Fetch data (e.g. last 7 days)
$items = Loggers::find()
    ->where(['>=', 'created_date', date('Y-m-d', strtotime('-7 days'))])
    ->orderBy('created DESC')
    ->limit(100)
    ->all();

$days = Loggers::find()
    ->select('created_date')
    ->where(['>=', 'created_date', date('Y-m-d', strtotime('-7 days'))])
    ->groupBy('created_date')
    ->orderBy('created_date DESC')
    ->asArray()
    ->all();

$searchModel = new LoggersSearch();
$userNames = $searchModel->getUsersSelect2();

echo Timeline::widget([
    'days' => $days,
    'items' => $items,
    'userNames' => $userNames,
]);
```

---

## Requirements

- **yiisoft/yii2**: ~2.0.14
- **cinghie/yii2-traits**: @dev

For timeline styling with AdminLTE 3:

- Module configured with `'bootstrap' => 'bootstrap4'`
- **cinghie/yii2-adminlte3** installed

---

## Security and performance

See [SECURITY_AND_OPTIMIZATION.md](SECURITY_AND_OPTIMIZATION.md) for details on parameter validation, query limits, and Timeline widget usage.

---

## License

BSD-3-Clause
