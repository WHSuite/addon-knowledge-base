<?php

class KbArticle extends AppModel
{
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
        'kb_category_id' => 'required'
    );


    public function KbCategory()
    {
        return $this->belongsTo('KbCategory');
    }

    public function save(array $options = array())
    {
        $this->slug = \Illuminate\Support\Str::slug($this->title);

        return parent::save($options);
    }
}
