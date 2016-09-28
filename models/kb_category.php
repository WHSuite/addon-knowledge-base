<?php

class KbCategory extends AppModel
{
    public static $rules = array(
        'name' => 'required'
    );


    public function KbArticle()
    {
        return $this->hasMany('KbArticle');
    }

    public function save(array $options = array())
    {
        $this->slug = \Illuminate\Support\Str::slug($this->name);

        return parent::save($options);
    }
}
