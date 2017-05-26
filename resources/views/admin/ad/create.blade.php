<style type="text/css" media="screen">
    .ad-upload .i-delete {
        position: absolute;
        /*left: 0;*/
        font-size: 18px;
        color: red;
        cursor: pointer;
        display: none;
    }
</style>
<div id="adaddhtml" style="display: none">
    <section class="panel panel-padding">
        <form class="layui-form">
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/ad.model.title')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/ad.model.title')!!}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/ad.model.url')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="url" placeholder="{!!trans('admin/ad.model.url')!!}" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/ad.model.thumb')!!}</label>
                <div class="layui-input-inline">
                    <input name="thumb" class="layui-upload-file" id="ad-upload" type="file" >
                    <div class="ad-upload" style="margin-top: 5px;">
                        <i class="fa fa-close i-delete" id="adadddel"></i>
                        <img id="LAY_demo_upload" src="{{ asset('back/images/no-image.png') }}" style="display: none;">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="adadd">{!!trans('admin/setting.save')!!}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>