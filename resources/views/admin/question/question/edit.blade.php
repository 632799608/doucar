@extends('layouts.admin')
@section('style')
<style type="text/css" media="screen">
    .layui-input-block {
        margin-left: 130px;
        min-height: 36px;
    }
    .imgbox img{
        width: 200px;
        height: 150px;
        border: 1px solid #ccc;
    }
    .imgbox .i-delete {
        position: absolute;
        margin-left: 186px;
        font-size: 18px;
        color: red;
        cursor: pointer;
    }
    .question-upload img,.answer-upload img{
        width: 110px;
        height: 70px;
        border: 1px solid #ccc;
    }
    .question-upload .i-delete, .answer-upload .i-delete {
        position: absolute;
        margin-left: 97px;
        font-size: 18px;
        color: red;
        cursor: pointer;
    }
    #thumb-upload, .answer-upload, .question-upload{
        display: none;
    }
    @media screen and (min-width: 750px){
        .layui-layedit{
            width:50%
        }
    }
    .layui-elem-field legend {
        margin-left: 48px;
        padding: 0 10px;
        font-size: 15px;
        font-weight: 300;
    }
    .layui-elem-field button{
        margin-left: 6px;
    }
    .ana-label{
        text-align: center;
        border-bottom: 1px solid;
        height: 35px;
    }
    .layui-icon-color{
        color: #f00;
    }
    .ana-label i{
        font-size: 18px;
    }
</style>
@endsection
@section('content')
@inject('menuPresenter','Aizxin\Presenters\MenuPresenter')
<div class="layui-body site-demo">
    <div class="layui-tab-content" id="addpermission" style="padding: 50px;">
        <section class="panel panel-padding">
            <div class="group-button">
                <span class="layui-btn layui-btn-small layui-btn-primary ajax-all">
                   {!!trans('admin/question.edit')!!}
                </span>
            </div>
            <form class="layui-form" style="padding: 17px;">
                <input type="hidden" name="id" id="questionId" value="{{$question->id}}">
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/question.model.name')!!}</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/question.placeholder.name')!!}" class="layui-input layui-layedit" value="{{$question->name}}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">
                            {!!trans('admin/question.model.questionType')!!}
                        </label>
                        <div class="layui-input-inline">
                            <select name="courseType" lay-verify="required" lay-search="" lay-filter="courseType">
                                <option value="0">请选择科目类型</option>
                                <option value="1" <?php if ($question->courseType == 1) { echo 'selected';}?>>科目一</option>
                                <option value="4" <?php if ($question->courseType == 4) { echo 'selected';}?>>科目四</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">
                            {!!trans('admin/question.model.questionCategoryId')!!}
                        </label>
                        <div class="layui-input-inline" id="questionCategory">
                            <select name="questionCategoryId" id="questionCategoryId" lay-verify="questionCategoryId" lay-search="">
                                <option value="0">请选择科目类型</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">
                            {!!trans('admin/question.model.questionType')!!}
                        </label>
                        <div class="layui-input-inline">
                            <select name="questionType" lay-verify="required" lay-search="" lay-filter="questionType">
                                <option value="0">{!!trans('admin/question.placeholder.questionType')!!}</option>
                                <option value="1" <?php if ($question->questionType == 1) { echo 'selected';}?>>{!!trans('admin/question.pduo')!!}</option>
                                <option value="2" <?php if ($question->questionType == 2) { echo 'selected';}?>>{!!trans('admin/question.one')!!}</option>
                                <option value="3" <?php if ($question->questionType == 3) { echo 'selected';}?>>{!!trans('admin/question.duo')!!}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">
                            {!!trans('admin/question.model.difficulty')!!}
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" name="difficulty" lay-verify="required" autocomplete="off" placeholder="{!!trans('admin/question.placeholder.difficulty')!!}" class="layui-input" value="{{$question->difficulty}}">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">{!!trans('admin/question.model.thumb')!!}</label>
                    <div class="layui-input-block">
                        <input type="file" name="thumb" id="question-upload" multiple class="layui-upload-file">
                        <div class="question-upload" style="margin-top: 5px;">
                            <i class="fa fa-close i-delete"></i>
                            <img id="LAY_question_upload" src="{{$question->thumb}}">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">{!!trans('admin/question.model.analysis')!!}</label>
                    <div class="layui-input-block">
                        <div style="margin-bottom: 20px;">
                            <textarea id="article-content">{!! $question->analysis !!}</textarea>
                        </div>
                    </div>
                </div>
                <fieldset class="layui-elem-field layui-field-title" id="editAnhtml">
                    <legend>{!!trans('admin/question.model.answer')!!}
                        <div class="layui-btn layui-btn-small" @click="addAhtml()">
                            <i class="fa fa-plus-square"></i> {!!trans('admin/setting.add')!!}
                        </div>
                    </legend>
                    <div class="layui-form-item" v-for="item in answerList">
                        <label class="layui-form-label" v-text="$index+1"></label>
                        <div class="layui-input-block">
                            <div class="layui-form-label ana-label" style="width: 30%">
                                <span v-if="item.content" v-text="item.content"></span>
                                <img v-if="item.thumb" v-bind:src="item.thumb">
                            </div>
                            <div class="layui-form-label ana-label">
                                <div v-if='item.isAnswer' class="layui-unselect layui-form-checked"><i class="layui-icon"></i></div>
                            </div>
                            <div class="layui-form-label ana-label">
                                <i @click="delAnswer($index)" class="layui-icon layui-icon-color" style="cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                </fieldset >
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="editquestionupdate">{!!trans('admin/setting.resave')!!}</button>
                        <a onclick="window.history.go(-1)" class="layui-btn layui-btn-primary">{!!trans('admin/setting.goback')!!}</a>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
<div id="editAnswerhtml" style="display: none">
    <section class="panel panel-padding">
        <form class="layui-form" id="answerFrom">
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/answer.model.answerType')!!}</label>
                <div class="layui-input-inline">
                    <select name="type" lay-verify="required" lay-filter="answerSelect">
                        <option value="1" selected>{!!trans('admin/answer.wenzi')!!}</option>
                        <option value="2">{!!trans('admin/answer.img')!!}</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item answer-text">
                <label class="layui-form-label">{!!trans('admin/answer.model.content')!!}</label>
                <div class="layui-input-block">
                    <input type="text" name="content" autocomplete="off" placeholder="{!!trans('admin/answer.model.content')!!}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item answer-thumb" style="display: none;">
                <label class="layui-form-label">{!!trans('admin/answer.model.thumb')!!}</label>
                <div class="layui-input-inline">
                    <input name="thumb" class="layui-upload-file" id="answer-upload" type="file" >
                    <div class="answer-upload" style="margin-top: 5px;">
                        <i class="fa fa-close i-delete"></i>
                        <img id="LAY_answer_upload" src="{{ asset('back/images/no-image.png') }}">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">{!!trans('admin/answer.model.isAnswer')!!}</label>
                <div class="layui-input-block">
                    <input name="isAnswer" lay-skin="switch" lay-filter="switchTest" lay-text="{!!trans('admin/setting.yes')!!}|{!!trans('admin/setting.no')!!}" type="checkbox">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="answeradd">{!!trans('admin/setting.save')!!}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{!!trans('admin/setting.reset')!!}</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
@section('my-js')
<script>
    layui.extend({
        'question-save': 'js/question/question-save'
    }).use(['question-save']);
</script>
@endsection

