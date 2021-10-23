# Radio widget

[Radio](https://www.w3.org/TR/2012/WD-html-markup-20120329/input.radio.html) is an input element whose value represents a selection of one items from a list (a radio button).

## Usage

Let's use `Radio` widget to return true when an element is selected.

```php
<?php

declare(strict_types=1);

namespace App\Form;

use Yiisoft\Form\FormModel;

final class TestForm extends FormModel
{
    public bool $active = false;
}
```

Widget view:

```php
<?php

declare(strict_types=1);

use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Form\Widget\Label;
use Yiisoft\Form\Widget\Radio;

/**
 *  @var $data FormModelInterface
 *  @var $csrf string
 */
?>

<?= Form::widget()->action('widgets')->csrf($csrf)->begin() ?>
    <?= Radio::widget()->config($data, 'active',)->value(true)->render(); ?>
    <hr class="mt-3">
    <?= Field::widget()->submitButton(['class' => 'button is-block is-info is-fullwidth', 'value' => 'Save']); ?>
<?= Form::end() ?>
```

That would generate the following code:

```html
<form action="widgets" method="POST" _csrf="ic2cDp39M0hFYD2KypD4NnXU4Gcx8FTma624ZZZuUwHYjtNW_odcG31ZTcaH9LJhN7LWKQm4GoAJ4-ctySghTg==">
    <input type="hidden" name="_csrf" value="ic2cDp39M0hFYD2KypD4NnXU4Gcx8FTma624ZZZuUwHYjtNW_odcG31ZTcaH9LJhN7LWKQm4GoAJ4-ctySghTg==">
    <label><input type="radio" id="testform-active" name="TestForm[active]" value="1"> Active</label>
    <hr class="mt-3">
    <div>
        <input type="submit" id="submit-27736839536001" class="button is-block is-info is-fullwidth" name="submit-27736839536001" value="Save">
    </div>
</form>
```

### Custom values

Custom values could be set as well. In the following example we use `5` when the radio is selected and `0` when the radio is not.

```php
<?php

declare(strict_types=1);

namespace App\Form;

use Yiisoft\Form\FormModel;

final class TestForm extends FormModel
{
    public int $number = 0;

    public function getAttributeLabels(): array
    {
        return [
            'number' => 'Five',
        ];
    }
}
```

Widget view:

```php
<?php

declare(strict_types=1);

use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Form\Widget\Label;
use Yiisoft\Form\Widget\Radio;

/**
 *  @var $data FormModelInterface
 *  @var $csrf string
 */
?>

<?= Form::widget()->action('widgets')->csrf($csrf)->begin() ?>
    <?= Radio::widget()->config($data, 'number')->uncheckValue(0)->value(5)->render() ?>
    <hr class="mt-3">
    <?= Field::widget()->submitButton(['class' => 'button is-block is-info is-fullwidth', 'value' => 'Save']); ?>
<?= Form::end() ?>
```

That would generate the following code:

```html
<form action="widgets" method="POST" _csrf="atfZTzPpEYZxxetvS69gUg5zd_enzzaZaf6RNZj4nxk7lJYXUJN-1Un8myMGyyoFTBVBuZ-HeP8LsM59x77tVg==">
    <input type="hidden" name="_csrf" value="atfZTzPpEYZxxetvS69gUg5zd_enzzaZaf6RNZj4nxk7lJYXUJN-1Un8myMGyyoFTBVBuZ-HeP8LsM59x77tVg==">
    <input type="hidden" name="TestForm[number]" value="0">
    <label><input type="radio" id="testform-number" name="TestForm[number]" value="5"> Five</label>
    <hr class="mt-3">
    <div>
        <input type="submit" id="submit-29518822380001" class="button is-block is-info is-fullwidth" name="submit-29518822380001" value="Save">
    </div>
</form>
```

### More custom values

In this example we use two values for selection states (`inactive`, `active`) and and empty string when the radio is not checked.

```php
<?php

declare(strict_types=1);

namespace App\Form;

use Yiisoft\Form\FormModel;

final class TestForm extends FormModel
{
    public string $active = '';
}
```

Widget view:

```php
<?php

declare(strict_types=1);

use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Form\Widget\Label;
use Yiisoft\Form\Widget\Radio;

/**
 *  @var $data FormModelInterface
 *  @var $csrf string
 */
?>

<?= Form::widget()->action('widgets')->csrf($csrf)->begin() ?>
    <?= Radio::widget()->config($data, 'active')->label('inactive')->uncheckValue("")->value('inactive')->render() ?>
    <?= Radio::widget()->config($data, 'active')->value('active')->render() ?>
    <hr class="mt-3">
    <?= Field::widget()->submitButton(['class' => 'button is-block is-info is-fullwidth', 'value' => 'Save']); ?>
<?= Form::end() ?>
```

### Code generated by `Radio` Widget

```html
<form action="widgets" method="POST" _csrf="hzRUVdfY31_OBlxvJvg1ZVkXnZcGwAeJVbncB4jSQHfWdxsNtKKwDPY_LCNrnH8yG3Gr2T6ISe8394NP15QyOA==">
    <input type="hidden" name="_csrf" value="hzRUVdfY31_OBlxvJvg1ZVkXnZcGwAeJVbncB4jSQHfWdxsNtKKwDPY_LCNrnH8yG3Gr2T6ISe8394NP15QyOA==">
    <input type="hidden" name="TestForm[active]" value="">
    <label><input type="radio" id="testform-active" name="TestForm[active]" value="inactive"> inactive</label>
    <label><input type="radio" id="testform-active" name="TestForm[active]" value="active"> Active</label>
    <hr class="mt-3">
    <div>
        <input type="submit" id="submit-31818689915001" class="button is-block is-info is-fullwidth" name="submit-31818689915001" value="Save">
    </div>
</form>
```

### `Radio` methods: 

Method | Description | Default
-------|-------------|---------
`enclosedByLabel(bool $value = true)` | If the widget should be enclosed by label. | `true`
`label(string $value)` | The label text. | `''`
`labelAttributes(array $attributes = [])` | HTML attributes for the label tag. | `[]`
`uncheckValue($value)` | The value that is returned when the radio button is not checked. | `null`
`value($value)` | The value that is returned when the radio button is checked. | `null`

### `Common` methods:

Method | Description | Default
-------|-------------|---------
`charset(string $value)` | Sets the charset attribute | `UTF-8`
`config(FormModelInterface $formModel, string $attribute, array $attributes = [])` | Configures the widget. |
`autofocus(bool $value = true)` | Sets the autofocus attribute | `false`
`disabled(bool $value = true)` | Sets the disabled attribute | `false`
`form(string $value)` | Sets the form attribute | ``
`id(string $value)` | Sets the id attribute | `''`
`required(bool $value = true)` | Sets the required attribute | `false`
`readonly()` | Sets the readonly attribute | `false`
`tabIndex(int $value = 0)` | Sets the tabindex attribute | `0`
