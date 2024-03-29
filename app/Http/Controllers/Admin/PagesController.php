<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Page;
//use \Illuminate\Support\Facades\Input;
//use \Illuminate\Support\Facades\Redirect;

use Redirect, Input, Auth; //这种引入方式更方便


class PagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('admin.pages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
        $this->validate($request, [
            'title' => "required|unique:pages|max:255",
            'body' => "required"
        ]);
        //namespace App\Http\Controllers\Admin;这个命名空间很重要，因为PagesController也是在这个命名空间下，所以不需要引入
        $pages = new Page();
        $pages->title = Input::get('title');      //\Illuminate\Support\Facades\
        $pages->body = Input::get('body');
        $pages->user_id = 1;    //Auth::user()->id;
        
        if($pages->save()){
            return Redirect::to('admin');
        }else{
            return Redirect::back()->withInput()->withErrors('保存失败');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        echo 'coming show';
		return view('pages.show')->withPages(Page::find($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        return view('admin.pages.edit')->withPage(Page::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		//
		$this->validate($request, [
			'title' => 'required|unique:pages,title,'.$id.'|max:255',
			'body' => 'required',
		]);

		$page = Page::find($id);
		$page->title = Input::get('title');
		$page->body = Input::get('body');
		$page->user_id = 1;//Auth::user()->id;

		if ($page->save()) {
			return Redirect::to('admin');
		} else {
			return Redirect::back()->withInput()->withErrors('保存失败！');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$page = Page::find($id);
		$page->delete();

		return Redirect::to('admin');
	}

}
