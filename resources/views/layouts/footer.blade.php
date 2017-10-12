<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <!-- Contact Us -->
            <div class="col-sm-3 col-md-3">
                <h4>联系我们</h4>
                <p>
                    <a href="{{url('contact_us')}}">留言>></a><br />
                    电话 : {{get_cfg_item('phone')}}<br />
                    邮箱   : {{get_cfg_item('mail')}}

                </p>
            </div><!-- / .Contact Us -->

            <!-- Useful Links -->
            <div class="col-sm-3 col-md-3">
                <h4>友情链接</h4>
                <p>
                    @foreach(get_frendlink() as $k=>$v)
                        <a href="{{$v['link']}}">{{$v['title']}}</a><br/>
                    @endforeach
                </p>
            </div>
            <!-- / .Useful Links -->

            <!-- Recent Tweets -->
            <div class="col-sm-3 col-md-3">
                <h4>帮助中心</h4>
                <p>
                    @foreach($foot_nav['help'] as $k=>$v)
                        <a href="{{url('help')}}">{{$v['title']}}</a><br />
                    @endforeach
                </p>
            </div><!-- / .Recent Tweets -->

            <!-- Newsletter -->
            <div class="col-sm-3 col-md-3">
                <h4>执照证书</h4>
                <p>
                    <a>来自星星</a><br />
                    <a>营业执照：456445646</a><br />
                    <a>经营范围：很多</a><br />
                </p>
                <ul class="list-inline">
                    <li><a><i class="fa fa-facebook"></i></a></li>
                    <li><a><i class="fa fa-youtube"></i></a></li>
                    <li><a><i class="fa fa-envelope"></i></a></li>
                    <li><a><i class="fa fa-linkedin"></i></a></li>
                    <li><a><i class="fa fa-dribbble"></i></a></li>
                    <li><a><i class="fa fa-google-plus"></i></a></li>
                    <li><a><i class="fa fa-skype"></i></a></li>
                </ul>
            </div><!-- / .Newsletter -->
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</footer><!-- / .Footer -->