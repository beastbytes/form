<?php

declare(strict_types=1);

namespace Yiisoft\Form\Exception;

use Throwable;
use InvalidArgumentException;
use Yiisoft\FriendlyException\FriendlyExceptionInterface;

final class FormModelNotSetException extends InvalidArgumentException implements FriendlyExceptionInterface
{
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $message = $message === '' ? $this->getName() : $message;
        parent::__construct($message, $code, $previous);
    }

    public function getName(): string
    {
        return 'Failed to create widget because form model is not set.';
    }

    public function getSolution(): ?string
    {
        return <<<SOLUTION
            You can configure the `FormModel::class` in two ways. The first way is through the widgets using the `for()`
        method `Text::widget()->for(FormModel::class, attribute)`, where the first argument is the `FormModel::class`.
        The second way is through the `Field::class` where in each field type the first argument is the
        `FormModel::class`, `Field::widget->text(FormModel::class, attribute)`.
        SOLUTION;
    }
}