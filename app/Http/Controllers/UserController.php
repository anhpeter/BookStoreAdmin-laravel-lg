<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends BaseController
{

    function __construct()
    {
        parent::__construct('user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = DB::table(parent::getTableName())->get();
        return view('pages/' . $this->controller . '/index', ['items' => $items, 'controller' => $this->controller]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new User();
        return view('pages/' . $this->controller . '/form', ['formType' => 'add', 'item' => $item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'group_id' => $request->input('group_id'),
            'password' => $request->input('password'),
            'status' => $request->input('status'),
        ];
        $affected = DB::table(parent::getTableName())->insert($item);
        if ($affected == 1) return Redirect()->back()->with(['status' => 'success']);
        else return redirect()->back()->with(['status' => 'fail'])
            ->withErrors(['save', 'Failed to save'])
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = DB::table(parent::getTableName())->find($id);
        return view('pages/' . $this->controller . '/form', ['formType' => 'edit', 'item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'status' => $request->input('status'),
        ];
        $affected = DB::table(parent::getTableName())->where('id', $id)->update($item);
        if ($affected == 1) return Redirect()->back()->with(['status' => 'success']);
        else return redirect()->back()->with(['status' => 'fail'])
            ->withErrors(['save', 'Failed to save'])
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('profiles')->where('user_id', $id)->delete();
        DB::table(parent::getTableName())->delete($id);
        return Redirect(route(parent::getTableName() . '.index'));
    }
}
