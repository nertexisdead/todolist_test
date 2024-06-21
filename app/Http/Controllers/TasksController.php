<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use App\Models\Tasks;

use App\Exports\InvoiceExport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
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

use Excel;



class TasksController extends Controller
{

	protected $vars = array();

    public function add_task(Request $request)
    {
        $list = $request->list;

        $task = new Tasks;

        $task->list_id = $list;

        $task->save();

        return response()->json(['success' => true, 'task' => $task->id]);
    }

    public function add_task_text(Request $request)
    {
        $id = $request->id;
        $text = $request->text;

        $task =Tasks::where('id', $id)->first();
        $task->text=$text;
        $task->save();

        return response()->json(['success' => true]);
    }

    public function add_task_tags(Request $request)
    {
        $id = $request->id;
        $tags = $request->tags;

        $task =Tasks::where('id', $id)->first();
        if (isset($tags)) {
            $task->tags=$tags;
        } else {
            $task->tags = null;
        }
        $task->save();

        return response()->json(['success' => true]);
    }

    public function add_task_image(Request $request)
    {
        $id = $request->id;
        $image = $request->image;

        $task =Tasks::where('id', $id)->first();


		Storage::putFileAs('public/uploads/tasks/'.$task->id, $image, $image->getClientOriginalName());

		$task->image='uploads/tasks/'.$task->id.'/'.$image->getClientOriginalName();
		$task->save();

        return response()->json(['success' => true, 'url_img' => $task->image]);
    }

    public function del_task_image(Request $request)
    {
        $id = $request->id;

        $task =Tasks::where('id', $id)->first();

        $imagePath = 'public/' . $task->image;

        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        $task->image = null;
        $task->save();

        return response()->json(['success' => true]);
    }

}
