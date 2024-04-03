<?php

namespace wfm;

class Validator
{
  protected $errors = [];
  protected $data_items;
  protected $rules_list = ['required', 'min', 'max', 'email', 'match', 'unique', 'ext', 'size'];
  protected $messages = [
    'required' => 'Поле :fieldname: обязательно для заполнения',
    'min' => 'Поле :fieldname: должно быть не менее :rule_value: символов',
    'max' => 'Поле :fieldname: должно быть не более :rule_value: символов',
    'email' => 'Поле :fieldname: должно быть валидным email адресом',
    'match' => 'Поле :fieldname: должно совпадать с полем :rule_value:',
    'unique' => 'Данный :fieldname: уже занят. Поле должно быть уникальным',
    'ext' => ' :fieldname: не допустимый формат изображения. Поддерживаемые форматы: :rule_value:',
    'size' => 'Размер :fieldname: не должен превышать 1MB'
  ];

  public function validate(array $data, array $rules)
  {
    foreach ($data as $fieldname => $value) {
      if (isset($rules[$fieldname])) {
        $this->check([
          'fieldname' => $fieldname,
          'value' => $value,
          'rules' => $rules[$fieldname]
        ]);
      }
    }
    return $this;
  }

  public function getErrors()
  {
    return $this->errors;
  }

  public function hasErrors()
  {
    return !empty($this->errors);
  }

  public function listErrors($fieldname)
  {
    $output = '';
    if (isset($this->errors[$fieldname])) {
      $output .= "<div class='invalid-feedback d-block'><ul class='list-unstyled'>";
      foreach ($this->errors[$fieldname] as $error) {
        $output .= "<li>{$error}</li>";
      }
      $output .= "</ul></div>";
    }
    return $output;
  }


  protected function check($fieldname)
  {
    foreach ($fieldname['rules'] as $rule => $rule_value) {
      if (in_array($rule, $this->rules_list)) {
        if (!call_user_func_array([$this, $rule], [$fieldname['value'], $rule_value])) {
          $this->addError($fieldname['fieldname'], str_replace(
            [':fieldname:', ':rule_value:'],
            [$fieldname['fieldname'], $rule_value],
            $this->messages[$rule]
          ));
        }
      }
    }
  }

  protected function addError($fieldname, $error)
  {
    $this->errors[$fieldname][] = $error;
  }


  protected
  function required($value, $rule_value)
  {
    return !empty($value);
  }

  protected
  function min($value, $rule_value)
  {
    return mb_strlen($value, 'utf-8') >= $rule_value;
  }

  protected
  function max($value, $rule_value)
  {
    return mb_strlen($value, 'utf-8') <= $rule_value;
  }

  protected
  function email($value, $rule_value)
  {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }

  protected
  function match($value, $rule_value)
  {
    return $value === $this->data_items[$rule_value];
  }


  protected
  function unique($value, $rule_value)
  {
    $data = explode(':', $rule_value);
    return (!db()->query("SELECT {$data[1]} FROM {$data[0]} WHERE {$data[1]} = ?", [$value])->getColumn());
  }

  protected
  function ext($value, $rule_value)
  {
    if(empty($value['name'])) {
      return true;
    }
    $file_ext = get_file_ext($value['name']);
    $file_allowed_ext = explode('|', $rule_value);
    return in_array($file_ext, $file_allowed_ext);
  }

  protected
  function size($value, $rule_value)
  {
    if(empty($value['size'])) {
      return true;
    }
    return $value['size'] <= $rule_value;
  }

}