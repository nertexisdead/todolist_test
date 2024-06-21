<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lists;
use App\Models\Tasks;
use App\Models\User;

use Auth;
use Session;
use DB;
use DateTime;
use File;
use Storage;
use Cache;
use Hash;
use Mail;
use Carbon\Carbon;
use DatePeriod;
use DateInterval;

class ListsController extends Controller
{
    protected $vars = array();

    public function index (Request $request)
    {
        $user = null;
        if (Auth::check()) {
            $user = Auth::user();
        }

        $this->vars['user']=$user;

        return view('front.index')->with($this->vars)->render();
    }

    public function lists_list(Request $request)
	{
        $user = null;
        if (Auth::check()) {
            $user = Auth::user();
        }

        $this->vars['user']=$user;

        if (isset($request->tag)) {
            $tag = $request->tag;

            $lists = Lists::all();

            $list_ids = [];
            foreach ($lists as $list) {
                $tasks = $list->tasks;

                foreach ($tasks as $task) {
                    $tags = json_decode($task->tags, true);

                    // Проверяем наличие тега в массиве тегов
                    if (is_array($tags)) {
                        foreach ($tags as $tagValue) {
                            // Ищем частичное совпадение тега с помощью strpos
                            if (is_string($tagValue) && strpos($tagValue, $tag) !== false) {
                                $list_ids[] = $task->list_id;
                            }
                        }
                    }
                }
            }

            $uniqueListIds = array_unique($list_ids);
            $lists = Lists::whereIn('id', $uniqueListIds)->get();
        } else {
            $lists = Lists::all();
        }


        $this->vars['lists']=$lists;

		return view('front.lists.list')->with($this->vars)->render();
	}

	public function lists_new(Request $request)
	{
        $user = Auth::user();

        $this->vars['user']=$user;

		return view('front.lists.new')->with($this->vars)->render();
	}

	public function lists_save(Request $request)
	{
        $user = Auth::user();

		$lists=new Lists;

		$lists->name=$request->name;
        $lists->user_id=$user->id;

		$lists->save();

		return  redirect('/lists');

	}

    public function lists_edit(Request $request, $id)
	{

		$lists=Lists::whereId($id)->first();
        $user = null;
        if (Auth::check()) {
            $user = Auth::user();
        }


        $tasks =$lists->tasks;

        $users=User::all();

        $this->vars['user']=$user;
        $this->vars['users']=$users;
        $this->vars['lists']=$lists;
        $this->vars['tasks']=$tasks;


		return view('front.lists.edit')->with($this->vars)->render();

	}

    public function lists_view(Request $request, $id)
	{

		$lists=Lists::whereId($id)->first();
        $user = null;
        if (Auth::check()) {
            $user = Auth::user();
        }


        $tasks =$lists->tasks;

        $this->vars['user']=$user;
        $this->vars['lists']=$lists;
        $this->vars['tasks']=$tasks;


		return view('front.lists.view')->with($this->vars)->render();

	}

    public function lists_update(Request $request)
	{

		$lists=Lists::where('id', $request->id)->first();

		$lists->name=$request->name;
        $lists->users_for_edit=json_encode($request->users_for_edit);
        $lists->users_for_view=json_encode($request->users_for_view);

		$lists->save();

		return redirect('/lists');

	}

    public function lists_remove(Request $request, $id)
	{

		$lists=Lists::whereId($id)->first();

        $tasks = $lists->tasks;

        foreach ($tasks as $task) {
            $task->delete();
        }

		$lists->delete();

		return redirect('/lists');

	}

}
