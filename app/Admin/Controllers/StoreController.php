<?php

namespace App\Admin\Controllers;

use App\Models\Store;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StoreController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Store';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Store());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('price', __('Price'))->sortable();
        $grid->column('category_name', __('Category name'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();
        $grid->column('business_hours', __('Business hours'));
        $grid->column('regular_holiday', __('Regular holiday'));
        $grid->column('post_code', __('Post code'));
        $grid->column('address', __('Address'));
        $grid->column('phone_number', __('Phone number'));

        $grid->filter(function($filter) {
            $filter->like('name', '店舗名');

        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Store::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('category_name', __('Category name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('business_hours', __('Business hours'));
        $show->field('regular_holiday', __('Regular holiday'));
        $show->field('post_code', __('Post code'));
        $show->field('address', __('Address'));
        $show->field('phone_number', __('Phone number'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Store());

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->number('price', __('Price'));
        $form->number('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));
        $form->textarea('business_hours', __('Business hours'));
        $form->textarea('regular_holiday', __('Regular holiday'));
        $form->textarea('post_code', __('Post code'));
        $form->textarea('address', __('Address'));
        $form->number('phone_number', __('Phone number'));

        return $form;
    }
}
