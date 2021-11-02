# Error widget

Displays an error message.

## Usage

```php
<?php

declare(strict_types=1);

namespace App\Form;

use Yiisoft\Form\FormModel;
use Yiisoft\Validator\Rule\HasLength;

final class TestForm extends FormModel
{
    private string $name = '';

    public function getRules(): array
    {
        return [
            'name' => [HasLength::rule()->min(4)->tooShortMessage('Is too short.')],
        ];
    } 
}
```

Controller action:
```php
public function widget(
    TestForm $testForm,
    ValidatorInterface $validator,
    ServerRequestInterface $serverRequest
): ResponseInterface {
    /** @var array $body */
    $body = $serverRequest->getParsedBody();
    $method = $serverRequest->getMethod();

    if ($method === 'POST' && $testForm->load($body) && $validator->validate($testForm)->isValid()) {
    }

    return $this->viewRenderer->render('widget', ['formModel' => $testForm]);
}
```

Widget view:

```php
<?php

declare(strict_types=1);

use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Error;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Form\Widget\Text;

/**
 * @var FormModelInterface $data
 * @var object $csrf
 */
?>

<?= Form::widget()->action('widgets')->csrf($csrf)->begin(); ?>
    <?= Text::widget()->config($formModel, 'name')->render(); ?>
    <?= Error::widget()->config($formModel, 'name')->render(); ?>
    <hr class="mt-3">
    <?= Field::widget()->submitButton(['class' => 'button is-block is-info is-fullwidth', 'value' => 'Save']); ?>
<?= Form::end(); ?>
```

That would generate the following code before validation:

```html
<form action="widgets" method="POST" novalidate="" _csrf="qfONqNkLtpAYOtH31NnTuAVm1T1TPlqmeW6h4D1v_QKYubvGnXKboF9xo6iziqP-fC-6TQVwCNEIA5PNDh6zTg==">
    <input type="hidden" name="_csrf" value="qfONqNkLtpAYOtH31NnTuAVm1T1TPlqmeW6h4D1v_QKYubvGnXKboF9xo6iziqP-fC-6TQVwCNEIA5PNDh6zTg==">
    <input type="text" id="testform-name" name="TestForm[name]">
    <hr class="mt-3">
    <div>
        <input type="submit" id="submit-87842224450001" class="button is-block is-info is-fullwidth" name="submit-87842224450001" value="Save">
    </div>
</form>
```

That would generate the following code after validation:
```html
<form action="widgets" method="POST" novalidate="" _csrf="Aiy1ErQn34PnDuppCr1R8ilU--fkz6J4xp6EMG5w49gzZoN88F7ys6BFmDZt7iG0UB2Ul7KB8A-387YdXQGtlA==">
    <input type="hidden" name="_csrf" value="Aiy1ErQn34PnDuppCr1R8ilU--fkz6J4xp6EMG5w49gzZoN88F7ys6BFmDZt7iG0UB2Ul7KB8A-387YdXQGtlA==">
    <input type="text" id="testform-name" name="TestForm[name]" value="sam">
    <div>Is too short.</div>
    <hr class="mt-3">
    <div>
        <input type="submit" id="submit-88955959333001" class="button is-block is-info is-fullwidth" name="submit-88955959333001" value="Save">
    </div>
</form>
```

### Custom error message

To configure a error custom message, we simply change it in the widget, taking the previous example the code would be the following: 

```php
<?php

declare(strict_types=1);

use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Error;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Form\Widget\Text;

/**
 * @var FormModelInterface $data
 * @var object $csrf
 */
?>

<?= Form::widget()->action('widgets')->csrf($csrf)->begin(); ?>
    <?= Text::widget()->config($formModel, 'name')->render(); ?>
    // custom error message
    <?= Error::widget()->config($formModel, 'name')->message('The name must have more than 3 letters.')->render(); ?>
    <hr class="mt-3">
    <?= Field::widget()->submitButton(['class' => 'button is-block is-info is-fullwidth', 'value' => 'Save']); ?>
<?= Form::end(); ?>
```

That would generate the following code after validation:
```html
<form action="widgets" method="POST" novalidate="" _csrf="2r6S9Lucw5hHfor7E_OGi-rnPvchDI3LOwCv-0YEnB7r9KSa_-XuqAA1-KR0oPbNk65Rh3dC37xKbZ3WdXXSUg==">
    <input type="hidden" name="_csrf" value="2r6S9Lucw5hHfor7E_OGi-rnPvchDI3LOwCv-0YEnB7r9KSa_-XuqAA1-KR0oPbNk65Rh3dC37xKbZ3WdXXSUg==">
    <input type="text" id="testform-name" name="TestForm[name]" value="sam">
    <div>The name must have more than 3 letters.</div>
    <hr class="mt-3">
    <div>
        <input type="submit" id="submit-101695207904001" class="button is-block is-info is-fullwidth" name="submit-101695207904001" value="Save">
    </div>
</form>
```

### `Error` methods:

Method | Description | Default
-------|-------------|---------
`encode(bool $value)` | Whether to encode the error message. | `true`
`message(string $value)` | Error message to display. | `''`
`messageCallback(array $value)` | Callback that will be called to obtain an error message. | `[]`
`tag(string $value)` | Tag to use to display the error. | `'div'`

### `Common` methods:

Method | Description | Default
-------|-------------|---------
`autofocus(bool $value = true)` | Sets the autofocus attribute | `false`
`charset(string $value)` | Sets the charset attribute | `UTF-8`
`config(FormModelInterface $formModel, string $attribute, array $attributes = [])` | Configures the widget. |
`disabled(bool $value = true)` | Sets the disabled attribute | `false`
`form(string $value)` | Sets the form attribute | `''`
`id(string $value)` | Sets the id attribute | `''`
`readonly()` | Sets the readonly attribute | `false`
`required(bool $value = true)` | Sets the required attribute | `false`
`tabIndex(int $value = 0)` | Sets the tabindex attribute | `0`