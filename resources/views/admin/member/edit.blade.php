
<div style="display: none" id="memberedithtml">
    <section class="panel panel-padding">
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <div class="layui-input-inline">
                    <input type="hidden" name="id"  id="memberEditId">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/member.model.nickname')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="nickname" lay-verify="required|nickname" autocomplete="off" class="layui-input" id="memberEditnickname">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/member.model.phone')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="phone" lay-verify="required|phone" autocomplete="off" class="layui-input" id="memberEditphone">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/member.model.password')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="password" lay-verify="required|pass" autocomplete="off" class="layui-input" id="memberEditpassword">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/member.model.headPortrait')!!}</label>
                <div class="layui-input-inline">
                    <div class="site-demo-upbar">
                        <input type="file" name="thumb" class="layui-upload-file" id="member-upload-edit">
                    </div>
                    <div id="membereditavatar">
                        <i class="fa fa-close i-delete"></i>
                        <div class="site-demo-upload">
                          <img id="LAY_demo_upload_edit" src="{{ asset('back/images/no-image.png') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="memberedit">{!!trans('admin/setting.save')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>
