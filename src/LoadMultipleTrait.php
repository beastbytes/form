<?php

declare(strict_types=1);

namespace Yiisoft\Form;

trait LoadMultipleTrait
{
    private array $models = [];

    public function loadMultiple(array $data, ?string $formName = null): bool
    {
        if ($formName === null) {
            /* @var \Yiisoft\Form\FormModelInterface $this */
            $formName = $this->getFormName();
        }

        $success = true;
        foreach (array_keys($data) as $i) {
            /* @var \Yiisoft\Form\FormModelInterface $model */
            $model = clone $this;

            $result = false;
            if ($formName === '' && !empty($data[$i])) {
                $result = $model->load($data[$i], '');
            } elseif (!empty($data[$formName][$i])) {
                $result = $model->load($data[$formName][$i], '');
            }

            if ($result === true) {
                $this->models[] = $model;
            } else {
                $this->models[] = $success = false;
            }
        }

        return $success;
    }

    public function getModels(): array
    {
        return $this->models;
    }
}
