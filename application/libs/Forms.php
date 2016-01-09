<?php

class Forms{

	public static $disabled=null;

	public static function init($options)
	{
		$attrs = get_class_vars(__CLASS__);
		foreach($attrs as $key => &$val)
			self::${$key} = isset($options[$key]) ? $options[$key] : null;
	}

	public static function text($name, $value=null, array $options = array())
	{
		self::init($options);

		$form  = '<div class="form-group">';
		$form .= '<label for="' . $name . '" class="col-sm-2 control-label">' . ucfirst($name) . '</label>';
		$form .= '<div class="col-sm-10">';
		$form .= '<input type="text" class="form-control" value="' . $value . '" id="' . $name . '" name="' . $name . '" placeholder="' . $name . '" ';
		$form .= self::$disabled . '>';
		$form .= '</div>';
		$form .= '</div>';

		return $form;
	}

	public static function number($name, $value=null, array $options = array())
	{
		self::init($options);

		$form  = '<div class="form-group">';
		$form .= '<label for="' . $name . '" class="col-sm-2 control-label">' . ucfirst($name) . '</label>';
		$form .= '<div class="col-sm-10">';
		$form .= '<input type="number" class="form-control" value="' . $value . '" id="' . $name . '" name="' . $name . '" placeholder="' . $name . '" ';
		$form .= self::$disabled . '>';
		$form .= '</div>';
		$form .= '</div>';

		return $form;
	}

	public static function checkbox($name, $value=null, array $options = array())
	{
		self::init($options);

		$form  = '<div class="checkbox"><label>';
		$form .= '<div class="col-sm-offset-2 col-sm-10">';
		$form .= '<input type="checkbox" value="' . $value . '" name="' . $name . '" ' . self::$disabled . '> ' . ucfirst($name) . ' ?';
		$form .= '</label>';
		$form .= '</div>';
		$form .= '</div>';

		return $form;
	}

	public static function input($name, $value=null, array $options = array())
	{
		self::init($options);

		$form  = '<div class="form-group">';
		$form .= '<label for="' . $name . '" class="col-sm-2 control-label">' . ucfirst($name) . '</label>';
		$form .= is_null($value) ? '' : '<div class="col-sm-2"><img class="img-responsive" src="' . $value . '" /></div>';
		$form .= '<div class="col-sm-8">';
		$form .= '<input type="file" id="' . $name . '" name="' . $name . '">';
		$form .= is_null($value) ? '<p class="help-block">Uploder un fichier</p>' : '<p class="help-block">Remplacer ce fichier</p>';
		$form .= '</div>';
		$form .= '</div>';

		return $form;
	}

	public static function date($name, $value=null, array $options = array())
	{
		self::init($options);

		$form  = '<div class="form-group">';
		$form .= '<label for="' . $name . '" class="col-sm-2 control-label">' . ucfirst($name) . '</label>';
		$form .= '<div class="col-sm-10">';
		$form .= '<input type="date" class="form-control" value="' . $value . '" id="' . $name . '" name="' . $name . '" placeholder="' . $name . '" ';
		$form .= self::$disabled . '>';
		$form .= '</div>';
		$form .= '</div>';

		return $form;
	}



	public static function textarea($name, $value=null, array $options = array())
	{
		self::init($options);

		$form  = '<div class="form-group">';
		$form .= '<label for="' . $name . '" class="col-sm-2 control-label">' . ucfirst($name) . '</label>';
		$form .= '<div class="col-sm-10">';
		$form .= '<textarea type="text" class="form-control" id="' . $name . '" name="' . $name . '" placeholder="' . $name . '" ';
		$form .= self::$disabled . '>' . $value . '</textarea>';
		$form .= '</div>';
		$form .= '</div>';

		return $form;
	}

}