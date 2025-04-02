<?php
namespace App\config;

class Validator
{
    public function validate($data, $model)
    {
        $pathModel = $model;
        if (!class_exists($pathModel)) {
            throw new \Exception("Model class $model does not exist");
        }

        $modelInstance = new $pathModel();

        foreach ($data as $key => $value) {
            $setterName = 'set' . ucfirst($key);
            if (method_exists($model, $setterName)) {
                $modelInstance->$setterName($value);
            }
        }
        if (!$modelInstance->getErrors()) {
            $this->isValid = true;
            return;
        }

        $this->errors = $modelInstance->getErrors();
    }
}