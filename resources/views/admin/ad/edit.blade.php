<div id="adedithtml" class="layui-form" style="display: none">
    <section class="panel panel-padding">
        <form class="layui-form" id="adeditreset">
            <div class="layui-form-item">
                <input type="hidden" name="id" value="@{{$ad->id}}" id="adEditId">
                <label class="layui-form-label">{!!trans('admin/ad.model.title')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="title" lay-verify="required" autocomplete="off" class="layui-input" value="@{{$ad->title}}" id="adEditTitle">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/ad.model.url')!!}</label>
                <div class="layui-input-inline">
                    <input type="text" name="url" lay-verify="required" autocomplete="off" class="layui-input" value="@{{$ad->url}}" id="adEditUrl">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/ad.model.thumb')!!}</label>
                <div class="layui-input-inline">
                    <input name="thumb" class="layui-upload-file" id="ad-upload_edit" type="file">
                    <div class="ad-upload" style="margin-top: 5px;">
                        <i class="fa fa-close i-delete" id="adeditdel"></i>
                        <img id="LAY_demo_upload_edit" src="">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="adedit">{!!trans('admin/setting.resave')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>