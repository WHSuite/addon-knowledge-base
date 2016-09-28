<?php
namespace Addon\KnowledgeBase\Migrations;

use \App\Libraries\BaseMigration;

class migration2014_07_11_230136_version1 extends BaseMigration
{
    /**
     * migration 'up' function to install items
     *
     * @param   int     addon_id
     */
    public function up($addon_id)
    {
        // Create the categories Table
        $this->createTable('kb_categories', function($table) {

            $table->increments('id');

            $table->string('name', 250);

            $table->string('slug', 250);

            $table->text('description');

            $table->integer('sort');

            $table->tinyInteger('is_active')
                ->default(0);

            $table->timestamps();
        });

        // Create the articles Table
        $this->createTable('kb_articles', function($table) {

            $table->increments('id');

            $table->string('title', 250);

            $table->string('slug', 250);

            $table->text('body');

            $table->integer('sort');

            $table->integer('kb_category_id');

            $table->integer('rating_up')
                ->default(0);

            $table->integer('rating_down')
                ->default(0);

            $table->tinyInteger('is_active')
                ->default(0);

            $table->timestamps();
        });

        // setup parent link in menu
        $parent = new \MenuLink();
        $parent->menu_group_id = 1;
        $parent->title = 'knowledgebase';
        $parent->parent_id = 0;
        $parent->is_link = 1;
        $parent->url = '#';
        $parent->sort = 3;
        $parent->clients_only = 0;
        $parent->class = '';
        $parent->addon_id = $addon_id;
        $parent->save();

        // add menu links for support desk
        \MenuLink::insert(
            array(
                array(
                    'menu_group_id' => 1,
                    'title' => 'kbarticles',
                    'parent_id' => $parent->id,
                    'is_link' => 0,
                    'url' => 'admin-kbarticle',
                    'sort' => 1,
                    'clients_only' => 0,
                    'class' => '',
                    'addon_id' => $addon_id,
                    'created_at' => $this->date,
                    'updated_at' => $this->date
                ),
                array(
                    'menu_group_id' => 1,
                    'title' => 'kbcategories',
                    'parent_id' => $parent->id,
                    'is_link' => 0,
                    'url' => 'admin-kbcategory',
                    'sort' => 1,
                    'clients_only' => 0,
                    'class' => '',
                    'addon_id' => $addon_id,
                    'created_at' => $this->date,
                    'updated_at' => $this->date
                ),
                // client side link
                array(
                    'menu_group_id' => 2,
                    'title' => 'knowledgebase',
                    'parent_id' => 0,
                    'is_link' => 0,
                    'url' => 'client-knowledgebase',
                    'sort' => 1,
                    'clients_only' => 0,
                    'class' => '',
                    'addon_id' => $addon_id,
                    'created_at' => $this->date,
                    'updated_at' => $this->date
                )
            )
        );


    }

    /**
     * migration 'down' function to delete items
     *
     * @param   int     addon_id
     */
    public function down($addon_id)
    {
        // drop tables
        $this->dropTable('kb_articles');
        $this->dropTable('kb_categories');

        // remove all the menu links
        \MenuLink::where('addon_id', '=', $addon_id)->delete();
    }

}
