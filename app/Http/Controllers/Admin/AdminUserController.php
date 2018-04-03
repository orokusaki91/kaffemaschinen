<?php
/**
 * Created by PhpStorm.
 * User: dragantic91
 * Date: 11/30/2017
 * Time: 1:44 PM
 */

namespace App\Http\Controllers\Admin;

use App\DataGrid\Facade as DataGrid;
use App\Http\Requests\AdminUserRequest;
use App\Models\Database\AdminUser;
use App\Models\Database\Role;

class AdminUserController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataGrid = DataGrid::model(AdminUser::query()->where('is_super_admin', '=', null)->orWhere('is_super_admin', '=', 0))
            ->setDefaultOrder(['field' => 'id', 'keyword' => 'desc'])
            ->column('id', ['sortable' => true])
            ->column('first_name', ['label' => __('lang.first-name')])
            ->column('last_name', ['label' => __('lang.last-name')])
            ->linkColumn('edit',['label' => __('lang.edit')], function($model) {
                return "<a href='". route('admin.admin-user.edit', $model->id)."' >". __('lang.edit')."</a>";
            })
            ->linkColumn('destroy', ['label' => __('lang.destroy')], function ($model) {
                return "<a href='#' onclick='showDeleteModal({$model->id}, \"{$model->first_name}\")'>". __('lang.delete') ."</a>";
            })
            ->setPagination(100);
        return view('admin.admin-user.index')->with('dataGrid', $dataGrid);
    }

    public function store(AdminUserRequest $request)
    {
        $request->merge(['password' => bcrypt($request->get('password'))]);


        //TMP only once we add user role then remove it???

        $role = Role::all()->first();
        $request->merge(['role_id' => $role->id]);

        AdminUser::create($request->all());

        return redirect()->route('admin.admin-user.index');
    }

    public function create()
    {
        $roles = $this->_getRoleOptions();
        return view('admin.admin-user.create')
            ->with('roles', $roles)
            ->with('editMethod', true);
    }

    public function storePost(AdminUserRequest $request)
    {
        $request->merge(['password' => bcrypt($request->get('password'))]);

        $role = Role::all()->first();
        $request->merge(['role_id' => $role->id]);

        AdminUser::create($request->all());

        return redirect()->route('admin.admin-user.index');
    }

    public function edit($id)
    {
        $user = AdminUser::findorfail($id);
        $roles = $this->_getRoleOptions();
        return view('admin.admin-user.edit')
            ->with('model', $user)
            ->with('roles', $roles)
            ->with('editMethod', true);
    }

    public function update(AdminUserRequest $request, $id)
    {
        $user = AdminUser::findorfail($id);

        $user->update($request->all());

        return redirect()->route('admin.admin-user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = AdminUser::find($id);
        $product->delete();

        return redirect()->route('admin.admin-user.index');
    }

    private function _getRoleOptions()
    {
        return [0 => 'Bitte auswählen'] + Role::all()->pluck('name', 'id')->toArray();
    }


}