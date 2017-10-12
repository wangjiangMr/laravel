<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\cate;
use App\Models\menu;
use App\Models\Picture;
use App\Models\shows;
use Illuminate\Http\Request;


/**
 * Class PictureController
 * @package App\Http\Controllers\Admin
 * 图片相关
 */
class PictureController extends Controller
{
    public $requests;



    public function __construct(Request $request)
    {
        $this->requests=$request;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(...$arg){
        //tdk
        $tdk=['title'=>'上传图片'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);

        //获取要修改的数据
        $pic=null;
        if(!empty($arg[0])){
           $pic=shows::with('pics')->where(['id'=>$arg[0]])->get();

        }

        //获取分类
        $cate=$this->get_tree_cate(1);


        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'pic'=>$pic[0],
            'cate'=>$cate
        ];
        return view('Admin/picture',$data);
    }




    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     * 图片上传操作
     */
    public function add_pic(){

        $this->validate($this->requests,[
            'title'=>'required|max:50',
            'des'=>'required|max:255',
        ],[
            '标题不符合标准',
            '链接不符合标准',
        ]);


        if ($image = $this->requests->hasFile('img')){

            $file = $this->requests->file('img');
            //判断文件上传过程中是否出错
            if(!$file->isValid()){

                return redirect()->back()->withErrors('文件上传出错！');
                exit;
            }
            $date=date("/Y/m/d",time());

            //或者文件夹路径 如果没有则返回false
            $path=public_path('upload'.$date);

            if(!file_exists($path)){

                mkdir($path,0755,true);
            }



            $ext = $file->getClientOriginalExtension();
            $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;

//            $filename = $file->getClientOriginalName();


            if(!$file->move($path,$filename)){
                return redirect()->back()->withErrors('保存文件失败！');
                exit;

            }

            if(!empty($_POST['id'])){
                //删除原图片文件和记录
                $list=shows::with('pics')->where(['id'=>$_POST['id']])->get();
                if(!empty($list[0]['pics']['true_path']) && file_exists(public_path($list[0]['pics']['true_path']))){
                    unlink(public_path($list[0]['pics']['true_path']));
                }
                Picture::find($list[0]['pic_id'])->delete();
            }

//            保存图表
            $truepath='/upload'.$date.'/'.$filename;
            $data=[
                'true_path'=>$truepath,
                'source'=>'admin/pic',
                'create_at'=>time(),
                'type'=>'非富文本'
            ];

            $ret=Picture::create($data);
            $ret->save();

            if(!empty($_POST['id'])){

                    $data=[
                        'title'=>$_POST['title'],
                        'des'=>$_POST['des'],
                        'update_at'=>time(),
                        'pic_id'=>$ret['id'],
                        'cate_id'=>$_REQUEST['cate_id']
                    ];


                //删除原图片文件和记录
                $shows=shows::where(['id'=>$_POST['id']])->update($data);
            }else{
                $data=[
                    'title'=>$_POST['title'],
                    'des'=>$_POST['des'],
                    'pic_id'=>$ret['id'],
                    'cate_id'=>$_REQUEST['cate_id'],
                    'create_at'=>time()
                ];
                $shows=shows::create($data)->save();
            }


            if($ret && $shows){
                return redirect('admin/picture')->with('tishi','保存成功！');
                exit;
            }

        }else{
            return redirect()->back()->withErrors('请选择图片！');
            exit;
        }

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 全部图片
     */
    public function lists($cateid=null){
        //tdk
        $tdk=['title'=>'全部图片'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);

        //全部图片
        if(empty($cateid)){
            $lists=shows::with('pics')->simplePaginate(8);
        }else{
            $lists=shows::with('pics')->where(['cate_id'=>$cateid])->simplePaginate(8);

        }

        //获取全部分类
        $cate=$this->get_tree_cate(1);



        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'lists'=>$lists,
            'cate'=>$cate
        ];
        return view('Admin/pic_list',$data);

    }


    /**
     * 图片删除操作
     */
    public function handle(){

        $type=$_GET['type'];
        $id=$_GET['id'];

        if($type && $id){

            if($type=='dele'){

                $pic_id=shows::where(['id'=>$id])->value('pic_id');
                $picture=Picture::find($pic_id);

                $showdel=shows::where(['id'=>$id])->delete();
                $piclistdel=Picture::find($pic_id)->delete();

                if(!empty($picture['true_path']) && file_exists(public_path($picture['true_path']))){
                    $picdel=unlink(public_path($picture['true_path']));
                }


                if($showdel && $picdel && $piclistdel){
                    echo json_encode(['info'=>'删除成功']);
                    exit;
                }

            }



        }else{
            echo json_encode(['info'=>'参数错误']);
            exit;
        }



    }



}