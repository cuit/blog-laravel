<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConfigController extends CommonController
{
    public function index()
    {
        $datas =Config::orderBy('order','asc')->paginate(10);
        foreach ($datas as $key=>$value){
            switch ($value->filed_type){
                case 'input':
                    $str = '<input type="text" class="lg" name="content[]" value="'.htmlspecialchars($value->content).'">';
                    $datas[$key]['_html'] = $str;
                    break;
                case 'textarea':
                    $str = '<textarea class="lg" name="content[]">'.$value->content.'</textarea>';
                    $datas[$key]['_html'] = $str;
                    break;
                case 'radio':
                    $array = explode(',',$value->filed_value);
                    $str = '';
                    foreach ($array as $childvalue){
                        $arr = explode('|',$childvalue);
                        $c = $value->content == $arr[0]? "checked":'';
                        $str .= '<input type="radio" name="content[]" '.$c.' value="'.$arr[0].'">'.$arr[1].'&nbsp&nbsp';
                    }
                    $datas[$key]['_html'] = $str;
                    break;
            }
        }
        return view('admin.listAllConfig',compact('datas'));
    }

    public function changeOrder(Request $request)
    {
        $in = $request->all();
        $Config = Config::find($in['configId']);
        if($Config){
            $Config->order = $in['order'];
            $result = $Config->update();
            if($result){
                $data = [
                    'status'=>1,
                    'msg' =>'自定义导航排序修改成功!'
                ];
            }else{
                $data = [
                    'status'=>0,
                    'msg' =>'分自定义导航排序修改失败!'
                ];
            }
            return $data;
        }
    }

    public function create()
    {
        return view('admin.addConfig');
    }

    public function store(Request $request)
    {
        $request->flash();
        $this->validate($request,[
            'name'=>'required|min:2|max:100',
            'title'=>'required',
            'content'=>'required',
            'tips'=>'required'
        ],[
            'required'=>':attribute 是必须填写的',
            'min'=>':attribute 不得小于2位',
            'max'=>':attribute 不得大100于位'
        ],[
            'name'=>'系统配置名称',
            'title'=>'标题',
            'content'=>'内容',
            'tips'=>'描述'
        ]);
        $input = $request->except('_token');
        $result = Config::create($input);
        if($result){
            $this->putFile();
            return redirect('home/config')->with('info','系统配置项添加成功!');
        }else{
            return back()->with('errors','系统配置项添加失败！');
        }
    }

    public function edit($id)
    {
        $data = Config::find($id);
        return view('admin.editConfig')->with('data',$data);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name'=>'required|min:2',
            'title'=>'required',
            'content'=>'required',
            'tips'=>'required'
        ],[
            'required'=>':attribute 是必须填写的',
            'min'=>':attribute 不得小于2位'
        ],[
            'name'=>'系统配置名称',
            'title'=>'标题',
            'content'=>'内容',
            'tips'=>'描述'
        ]);
        $input = $request->except('_token','_method');
        if($request->input('filed_type') != 'radio'){
            $input['filed_value'] = null;
        }
        $result = Config::where('id',$id)->update($input);
        if($result){
            $this->putFile();
            return redirect('home/config')->with('info','自定义导航修改成功!');
        }else{
            return back()->with('errors','自定义导航修改失败!');
        }
    }

    public function destroy($id)
    {
        $result = Config::where('id',$id)->delete();
        if($result){
            $data =[
                'status'=>1,
                'msg'=>'配置项删除成功!'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'配置项删除失败!'
            ];
        }
        $this->putFile();
        return $data;
    }

    public function changeContent(Request $request)
    {
        $input = $request->except('_token','order');
        $arr_id = $input['id'];
        $arr_con = $input['content'];
        foreach ($arr_id as $key=>$value){
            Config::where('id',$value)->update(['content'=>$arr_con[$key]]);
        }
        $this->putFile();
        return back()->with('info','修改成功!');
    }

    public function putFile(){
        $config = Config::pluck('content','name')->all();
        $str_con = var_export($config,true);
        $str = '<?php return '.$str_con.';';
        $path = base_path().'\config\web.php';
        file_put_contents($path,$str);
    }
}
