<?php 


/**
 * check and store validation error by field and rule 
 * @param string $field
 * @param string $rule
 * @return void
 */
if(!function_exists('validation')) {
    function validation(array $attributes, $trans_massages = null, $http_redirect = 'redirect') {

       $any_errors = false;
       $validation_errors = [];
       $values = [];
      foreach($attributes as $field => $rules) {
        
         $value = request($field);
         $values[$field] = $value;

         $massage = isset($trans_massages[$field]) ? $trans_massages[$field] : $field;

         foreach(explode('|', $rules) as $rule) {

            $field_validate = '';
            if($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $field_validate = str_replace(':attribute', $massage, trans('validation.email'));
            } else if($rule == 'required' && (is_null($value) || empty($value))) {
                $field_validate = str_replace(':attribute', $massage, trans('validation.required'));
            } else if($rule == 'integer' && !filter_var($value, FILTER_VALIDATE_INT)) {
                $field_validate = str_replace(':attribute', $massage, trans('validation.integer'));
            } else if($rule == 'string' && is_numeric($value)) {
                $field_validate = str_replace(':attribute', $massage, trans('validation.string'));
            } else if($rule == 'numeric' && !is_numeric($value)) {
                $field_validate = str_replace(':attribute', $massage, trans('validation.numeric'));
            }

            if(!empty($field_validate)) {
                $any_errors = true;
                session($field, $field_validate);
                $validation_errors[$field][] = $field_validate;
            }
        }

      }

       session('any_errors', $any_errors);

       if($any_errors) { // if exist any error validation

              if($http_redirect == 'redirect') {
                 // redirect to previous page
                 redirect_back();
              } else {
                 return json_encode($validation_errors, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
              }
        } else { // all values are valid

            return $values;
        }

    }
}

/**
 * return check error validation
 * @param string|null $field
 * @return bool
 */
if(!function_exists('any_errors')) {
    function any_errors($field = null) {
       if(isset($field)) {
            return session_has($field);
       }

       return session_delete('any_errors');
    }
}

/**
 * return field validation errors if field exist or if rule exist
 * @param string $field
 * @return string|null
 */
if(!function_exists('error_massage')) {
    function error_massage(string $field) {
    
       return session_has($field) ? session_delete($field) : null;   
    }
}


/**
 * render errors for simple html
 * @param string $field
 * @return string
 */
if(!function_exists('render_validation_errors')) {
    function render_validation_errors(string $field) {
        $html = '';

         if(any_errors($field)) {
            $html .= '<div class="text-danger mt-2">';
            $html .= error_massage($field);
            $html .= '</div>';
         }

        return $html;
    }
}
