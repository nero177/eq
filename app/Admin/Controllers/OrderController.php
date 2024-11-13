<?php

namespace App\Admin\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('Id'));
        $grid->column('status', __('Status'));
        $grid->column('order_number', __('Order number'));
        $grid->column('user_id', __('User'))->display(function ($id){
            $user = User::find($id);
            return '<a href="/admin/users/'. $user->id .'">'. $user->email .'</a>';
        });
        $grid->column('amount', __('Amount'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('orderables', __('Purchased'))->display(function ($orderables) {
            $text = '';

            foreach ($orderables as $orderable){
                $_orderable = $orderable['orderable_type']::find($orderable['orderable_id']);

                if($_orderable){
                    $text .= $_orderable->title . ' (' . $orderable['count'] . ') <br>';
                }
            }

            return $text;
        });
        // $grid->column('updated_at', __('Updated at'));

        $grid->quickSearch(function ($model, $query){
            return $model->whereHas('user', function (Builder $q) use ($query){
                $q->where('email', 'like', "%{$query}%");
            });
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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('status', __('Status'));
        $show->field('order_number', __('Order number'));
        $show->field('user_id', __('User id'));
        $show->field('amount', __('Amount'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->radio('status', __('Status'))->options(OrderStatus::casesWithAliases());
        // $form->text('order_number', __('Order number'));
        // $form->number('user_id', __('User id'));
        // $form->number('amount', __('Amount'));

        return $form;
    }
}
