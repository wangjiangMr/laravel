<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\WebController;
use App\Models\Picture;
use App\Models\q_answer;
use Illuminate\Http\Request;
use App\Models\article;
use App\Models\brand;
use App\Models\cate;
use App\Models\comment;
use App\Models\msg;
use App\Models\nav;
use App\Models\qus;
use App\Models\shows;
use App\Models\team;
use App\Models\user;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use PhpParser\Node\Expr\PostDec;


class IndexController extends WebController
{

    public $head_nav;
    public $foot_nav;
    public $requests;


    public function __construct(Request $request)
    {
        $head=self::nav_tree();
        $this->head_nav=$head;
        //我们的介绍文章
        $foot['help']=cate::where(['pid'=>2])->get();

        $this->foot_nav=$foot;

        $this->requests=$request;
    }

    /**
     *首页
     */
    public function index(){

        //当页tdk
        $tdk=[
            'title'=>'首页'
        ];

        //获取图集
        $pics=shows::with('pics')->limit(10)->get();

        //获取我们的优势
        $good_point=$this->get_art(16);

        //我们的强大
        $strong=$this->get_art(17);

        //新闻资讯
        $cate=$this->get_tree_cate(18);

        foreach($cate as $k=>$v){
            $cates[]=$v['id'];
        }

        $news['art']=article::with('pics')->whereIn('cate_id',$cates)->limit(10)->get();
        $news['cate']=cate::find(18);

        //获取品牌
        $brand=brand::with('pics')->limit(6)->get();

        //获取问答
        $ask=qus::with('asws')->limit(4)->get();

        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'pics'=>$pics,
            'good_point'=>$good_point,
            'strong'=>$strong,
            'news'=>$news,
            'brand'=>$brand,
            'ask'=>$ask
        ];

        return view('Index/index',$sendata);
    }





    /**
     * 关于我们页面
     */
    public function about_us(){
        //当页tdk
        $tdk=[
            'title'=>'关于我们'
        ];

        //关于我们
        $about=article::where(['title'=>'关于我们'])->first();

        //team单
        $team=team::get();

        //do for you
        $do=article::find(31);

        //get brand
        $brand=brand::with('pics')->limit(12)->orderBy('id','ASC')->get();

        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'about'=>$about,
            'team'=>$team,
            'doforyou'=>$do,
            'brand'=>$brand
        ];
        return view('Index/about_us',$sendata);
    }




    /**
     * 联系我们
     */
    public function contact_us(){
        //当页tdk
        $tdk=[
            'title'=>'联系我们'
        ];

        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
        ];
        return view('Index/contact_us',$sendata);
    }




    /**
     * 联系我们页面提交
     */
    public function msg_handle(){

        //判断是否重复提交
        $msg=msg::where('name',$_REQUEST['name'])->orWhere('mail',$_REQUEST['mail'])->first();
        if($msg){ echo json_encode(['status'=>1,'info'=>'不可重复提交']);exit;}



        $data=[
            'name'=>htmlentities($_REQUEST['name'], ENT_QUOTES, 'UTF-8'),
            'mail'=>htmlentities($_REQUEST['mail'], ENT_QUOTES, 'UTF-8'),
            'cont'=>htmlentities($_REQUEST['cont'], ENT_QUOTES, 'UTF-8'),
            'create_at'=>time()
        ];

        $ret=msg::insert($data);
        if($ret){
            echo json_encode(['status'=>1,'info'=>'提交成功']);
        }else{
            echo json_encode(['status'=>1,'info'=>'提交失败']);
        }

    }

    /**
     * 错误页
     */
    public function error(){

        //当页tdk
        $tdk=[
            'title'=>'帮助中心'
        ];
        //发送数据
        $sendata=[
            'tdk'=>$tdk,

        ];
        return view('Index/error',$sendata);
    }



    /**
     * 帮助中心
     */
    public function help($id=12){
        //当页tdk
        $tdk=[
            'title'=>'帮助中心'
        ];

        //获取分类文章
        foreach($this->foot_nav['help'] as $k=>$v){
            $v['art']=$this->get_art($v['id']);

        }

        //获取文章
        $detail=article::where(['id'=>$id])->first();



        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'detail'=>$detail
        ];

        return view('Index/help_item',$sendata);
    }



    /**
     * 帮助详情页
     */
    public function help_search(){
        //当页tdk
        $tdk=[
            'title'=>'帮助中心'
        ];

        $keyword=$_REQUEST['keyword'];
        if(empty($keyword)){
            return redirect('error')->with('tishi','请输入关键字！');
            exit;

        }
        $keyword=$this->clean_str($keyword);

        //获取分类文章
        foreach($this->foot_nav['help'] as $k=>$v){
            $v['art']=$this->get_art($v['id']);
            $cate_id[]=$v['id'];
        }

        //查询文章
        $arts=article::where('title','like','%'.$keyword.'%')
            ->orWhere('title','keywords','%'.$keyword.'%')
            ->orWhere('des','keywords','%'.$keyword.'%')
            ->whereIn('cate_id',$cate_id)
            ->paginate(3);



        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'arts'=>$arts,
            'keyword'=>$keyword
        ];

        return view('Index/help_search',$sendata);
    }


    /**
     * 文章列表
     */
    public function article($id=null){
        //当页tdk
        $tdk=[
            'title'=>'文章列表'
        ];

//        获取分类
        $cate=$this->get_tree_cate(18);
        foreach($cate as $k=>$v){
            $cates[]=$v['id'];
        }



        //获取文章
        if(empty($id)){
            $arts=article::with('pics')->whereIn('cate_id',$cates)->paginate(3);
        }else{
            if(in_array($id,$cates)){
                $arts=article::with('pics')->where('cate_id',$id)->paginate(3);
            }else{
                $arts='';
            }

        }



        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'art_cate'=>$cate,
            'arts'=>$arts
        ];

        return view('Index/article',$sendata);
    }



    /**
     * 文章详情
     */
    public function article_detail($id){

        //当页tdk
        $tdk=[
            'title'=>'文章列表'
        ];

        //获取分类
        $cate=$this->get_tree_cate(18);


        //获取当前文章
        $art=article::with('pics')->where(['id'=>$id])->first();
        if(!$art){
            return redirect('error')->with('tishi','文章走丢了！');
            exit;
        }

        //获取文章评论
        $comment=comment::with('user')->where(['art_id'=>$id])->get();

        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'art_cate'=>$cate,
            'art'=>$art,
            'comment'=>$comment
        ];

        return view('Index/article_detail',$sendata);
    }


    /**
     * 修改评论点赞数
     */
    public function change_vote(){

        if($_REQUEST['type']=='inc'){
            comment::where(['id'=>$_REQUEST['id']])->increment('praise',1);
        }else{
            comment::where(['id'=>$_REQUEST['id']])->increment('tread',1);
        }

        echo true;

    }


    /**
     * 添加评论
     */
    public function add_comment(){
        $cot=$this->clean_str($_REQUEST['ct']);
        if(empty($cot)){
            $reback=['sta'=>0,'msg'=>'评论不能为空'];
            echo json_encode($reback);
            exit;
        }
        //判断是否登录
        if($this->is_log()){
            //判断是否已经评论
            $uid=session('user')['id'];
            $has=comment::where(['uid'=>$uid,'art_id'=>$_REQUEST['art_id']])->first();
            if($has){
                $reback=['sta'=>0,'msg'=>'您已经评论过本文了'];
            }else{
                //添加数据
                $data=[
                    'art_id'=>$_REQUEST['art_id'],
                    'uid'=>$uid,
                    'content'=>$this->clean_str($_REQUEST['ct']),
                    'create_at'=>time()
                ];
                $ret=comment::insert($data);
                if($ret){
                    $reback=['sta'=>1,'msg'=>'评论成功'];
                }else{
                    $reback=['sta'=>0,'msg'=>'评论失败'];
                }

            }

        }else{
            $reback=['sta'=>0,'msg'=>'评论登录后后才可以哦'];
        }
        echo json_encode($reback);
        exit;
    }


    /**
     * 文章搜索页面
     */
    public function art_search(){
        //当页tdk
        $tdk=[
            'title'=>'搜索'
        ];

        $keyword=$this->clean_str($_GET['keyword']);
        if(empty($keyword)){
            return redirect('error')->with('tishi','请输入关键字！');
            exit;

        }
//        获取分类
        $cate=$this->get_tree_cate(18);
        foreach($cate as $k=>$v){
            $cates[]=$v['id'];
        }



        //获取文章
        $arts=article::with('pics')
            ->orWhere('title','like','%'.$keyword.'%')
            ->orWhere('keywords','like','%'.$keyword.'%')
            ->orWhere('des','like','%'.$keyword.'%')
            ->whereIn('cate_id',$cates)
            ->paginate(3);




        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'art_cate'=>$cate,
            'arts'=>$arts,
            'keyword'=>$keyword
        ];

        return view('Index/art_search',$sendata);
    }


    /**
     * 公司信息展示
     */
    public function company($id){


        //获取当前文章
        $art=article::with('pics')->where(['id'=>$id])->first();
        if(!$art){
            return redirect('error')->with('tishi','文章走丢了！');
            exit;
        }

        //当页tdk
        $tdk=[
            'title'=>$art['title']
        ];
        //获取文章评论
        $comment=comment::with('user')->where(['art_id'=>$id])->get();

        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'art'=>$art,
            'comment'=>$comment
        ];

        return view('Index/company',$sendata);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 登录
     */
    public function sign_in(){
        //当页tdk
        $tdk=[
            'title'=>'登录'
        ];

        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav
        ];
        return view('Index/sign_in',$sendata);
    }


    /**
     * 用户登录
     */
    public function user_log(){
        $ret=$this->val_login($_REQUEST['mail'],$_REQUEST['pwd']);
        if($ret==0){echo json_encode(['sta'=>$ret,'msg'=>'未找到此用户']);};
        if($ret==2){echo json_encode(['sta'=>$ret,'msg'=>'密码或者用户错误']);};
        if($ret==1){echo json_encode(['sta'=>$ret,'msg'=>'登录成功']);};
        if($ret==-1){echo json_encode(['sta'=>$ret,'msg'=>'参数不完整']);};
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 注册
     */
    public function sign_up(){
        //当页tdk
        $tdk=[
            'title'=>'注册'
        ];
        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,

        ];

        return view('Index/sign_up',$sendata);
    }


    /**
     * 注册用户名即时验证
     */
    public function reg_val(){
        if($_REQUEST['name']) {
            $ret = user::where(['name' => $_REQUEST['name']])->first();
            if ($ret) {
                return 'false';
                exit;
            } else {
                return 'true';
                exit;
            };
        }
    }

    /**
     * 注册邮箱即时验证
     */
    public function mail_val(){
        if($_REQUEST['mail']){
            $ret=user::where(['mail'=>$_REQUEST['mail']])->first();
            if($ret){return 'false';exit;}else{return 'true';exit;};
        }
    }


    /**
     * 注册操作
     */
    public function reg(){
        $ret=user::where(['name'=>$_REQUEST['name']])

            ->orWhere(['mail'=>$_REQUEST['mail']])
            ->first();
        if($ret){
            return json_encode(['sta'=>0,'msg'=>'用户名或邮箱已存在']);
            exit;
        }

        $data=[
            'name'=>$_REQUEST['name'],
            'mail'=>$_REQUEST['mail'],
            'pwd'=>bcrypt($_REQUEST['pwd']),
            'create_at'=>time()
        ];

        $ret=user::insert($data);
        if($ret){
            if($_REQUEST['is_log']=='on'){
                $user=user::where(['name'=>$_REQUEST['name']])->first();
                session('user',$user);
            }
            return json_encode(['sta'=>1,'msg'=>'注册成功']);
            exit;
        }else{
            return json_encode(['sta'=>1,'msg'=>'注册失败']);
            exit;
        }
    }




    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function pro($cateid=null){
        //当页tdk
        $tdk=[
            'title'=>'图片'
        ];

        $cate=$this->get_tree_cate(1);
        //获取图片分类
        if(!empty($cateid)){
            $cates[]=$cateid;
        }else{

            foreach($cate as $k=>$v){
                $cates[]=$v['id'];
            }
        }


        $pics=shows::with('pics')
            ->whereIn('cate_id',$cates)
            ->paginate(16);



        //获取图片列表


        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'cate'=>$cate,
            'pics'=>$pics
        ];
        return view('Index/pro',$sendata);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *品牌页
     */
    public function brand($cateid=null){
        //当页tdk
        $tdk=[
            'title'=>'品牌'
        ];

        $cate=$this->get_tree_cate(30);
        //获取图片分类
        if(!empty($cateid)){
            $cates[]=$cateid;
        }else{

            foreach($cate as $k=>$v){
                $cates[]=$v['id'];
            }
        }


        $brands=brand::with('pics')
            ->whereIn('cate_id',$cates)
            ->paginate(16);




        //获取图片列表


        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'cate'=>$cate,
            'brands'=>$brands
        ];
        return view('Index/brand',$sendata);
    }









    /**
     * 敬请期待
     */
    public function coming_soon(){
        return view('Index/coming_soon',['title'=>'敬请期待']);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * 个人中心
     */
    public function person_center(){
        //当页tdk
        $tdk=[
            'title'=>'用户中心'
        ];

        if(!$this->is_log()){return redirect('sign_in');};
        $userinfo=$this->is_log();

        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'user'=>$userinfo
        ];

        return view('Index/center',$sendata);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 登出操作
     */
    public function sign_out(){

        session()->forget('user');

        return redirect('/');
    }


    /**
     * 修改个人信息
     */
    public function modify(){
        if(!$this->is_log()){
            return json_encode(['sta'=>0,'msg'=>'请登录']);
            exit;
        }

        $data=[
            'name'=>$_REQUEST['name'],
            'truename'=>$_REQUEST['truename'],
            'mobile'=>$_REQUEST['mobile'],
            'mail'=>$_REQUEST['mail'],
            'update_at'=>time()
        ];

        $ret=user::where(['uid'=>$_REQUEST['uid']])->update($data);
        if($ret){
            return json_encode(['sta'=>1,'msg'=>'修改成功']);
            exit;
        }else{
            return json_encode(['sta'=>2,'msg'=>'修改失败']);
            exit;
        }

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * 问答首页
     */
    public function qustion($cateid=null){
        //当页tdk
        $tdk=[
            'title'=>'问答'
        ];

        //获取分类
        $cate=$this->get_tree_cate(24);

        if(!empty($cateid)){
            $cates[]=$cateid;
        }else{

            foreach($cate as $k=>$v){
                $cates[]=$v['id'];
            }
        }
        $qus=qus::whereIn('cate_id',$cates)
            ->paginate(16);


        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'cate'=>$cate,
            'qus'=>$qus,
            'cateid'=>$cateid

        ];

        return view('Index/qustion',$sendata);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 问答详情
     */
    public function qus_detail($id=null){
        //当页tdk
        $tdk=[
            'title'=>'问答详情'
        ];


        //获取问答详情
        $qus=qus::find($id);
        //获取回答
        $asw=q_answer::with('user')->where(['q_id'=>$id,'is_show'=>1,'is_check'=>1])->paginate(4);

        //发送数据
        $sendata=[
            'tdk'=>$tdk,
            'nav'=>$this->head_nav,
            'foot_nav'=>$this->foot_nav,
            'qus'=>$qus,
            'asw'=>$asw
        ];

        return view('Index/qus_detail',$sendata);
    }


    /**
     * 添加回复
     */
    public function add_asw(){
        if(!$this->is_log()){
            return json_encode(['sta'=>0,'msg'=>'登录后才可以回复哦']);
            exit;
        }

        $ct=$this->clean_str($_REQUEST['asw']);
        if(!$ct){
            return json_encode(['sta'=>0,'msg'=>'内容不能为空']);
            exit;
        }

        $has=q_answer::where(['uid'=>session('user')['uid'],'q_id'=>$_REQUEST['q_id']])->first();
        if($has){
            return json_encode(['sta'=>0,'msg'=>'您已经回复过此问题了']);
            exit;
        }

        $data=[
            'uid'=>session('user')['uid'],
            'q_id'=>$_REQUEST['q_id'],
            'answer'=>$ct,
            'create_at'=>time()
        ];

        $ret=q_answer::insert($data);
        if($ret){
            return json_encode(['sta'=>1,'msg'=>'添加成功，等待审核']);
            exit;
        }else{
            return json_encode(['sta'=>2,'msg'=>'添加失败']);
            exit;
        }
    }


    /**
     * 添加问题
     */
    public function add_qus(){
        if(!$this->is_log()){
            return json_encode(['sta'=>0,'msg'=>'登录后才可以提问哦']);
            exit;
        }

        $title=$this->clean_str($_REQUEST['title']);
        $des=$this->clean_str($_REQUEST['des']);


        $data=[
            'uid'=>session('user')['uid'],
            'title'=>$title,
            'qus_des'=>$des,
            'cate_id'=>$_REQUEST['cate_id'],
            'create_at'=>time()
        ];

        $ret=qus::insert($data);
        if($ret){
            return json_encode(['sta'=>1,'msg'=>'添加成功，等待审核']);
            exit;
        }else{
            return json_encode(['sta'=>2,'msg'=>'添加失败']);
            exit;
        }
    }





    //////////////////////////工具方法///////////////////////////////////
    /**
     * 获取导航树
     */
    public function nav_tree($top=null){

        if($top==null){
            $top=nav::where(['pid'=>0,'is_show'=>1])->orderBy('weight','DESC')->get();
        }
        foreach($top as $k=>$v){
            $child=nav::where(['pid'=>$v['id'],'is_show'=>1])->orderBy('weight','DESC')->get();
            if($child){
                $v['child']=$child;
            }
        }
        return  $top;
    }


    /**
     * 修改头像操作
     */
    public function change_headimg(){
        if(!$this->is_log()){
            return json_encode(['sta'=>0,'msg'=>'请登录']);
            exit;
        }

//        上传
        $ret=$this->upload_file('head_img',200,200);
        if($ret['status']!=1){
            return json_encode(['sta'=>2,'msg'=>$ret['info']]);
            exit;
        }

        $data=[
            'true_path'=>$ret['info'],
            'source'=>'change_headimg',
            'create_at'=>time(),
            'type'=>'非富文本'
        ];
        $picret=Picture::create($data);
        $picret->save();
        $user=user::where(['uid'=>$_REQUEST['uid']])->first();

//        删除原文件和记录
        if(!empty($user['head_img'])){
            $oldpic=Picture::find($user['head_img']);
            $this->dele_file($oldpic['id'],$oldpic['true_path']);
        }

//        修改头像
        $data=['head_img'=>$picret['id']];
        $update=user::where(['uid'=>$_REQUEST['uid']])->update($data);
        if($update){
            return json_encode(['sta'=>1,'msg'=>$ret['info']]);
            exit;
        }else{
            return json_encode(['sta'=>2,'msg'=>'修改失败']);
            exit;
        }

    }











}
