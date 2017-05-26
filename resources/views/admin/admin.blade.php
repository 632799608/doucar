@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('back/thooClock/main.css') }}">
<style type="text/css" media="screen">
	@media only screen and (max-width: 560px) {
        .container canvas {
            width: 300px;
            height: 300px;
        }
    }
</style>
@endsection
@section('content')
<div class="layui-body site-demo">
	<div class="container">
		<div id="myclock"></div>
	</div>
</div>
@endsection
@section('my-js')
<script src="{{ asset('back/thooClock/jquery-2.0.3.min.js') }}"></script>
<script src="{{ asset('back/thooClock/jquery.thooClock.js') }}"></script>
<script>
layui.use(['global','jquery'],function(){
	var $ = layui.jquery;
	$(function() {
		var intVal, myclock;
		var audioElement = new Audio("");
		//clock plugin constructor
		$('#myclock').thooClock({
			size:$(document).height()/1.4,
			onAlarm:function(){
				//all that happens onAlarm
				$('#alarm1').show();
				alarmBackground(0);
				//audio element just for alarm sound
				document.body.appendChild(audioElement);
				var canPlayType = audioElement.canPlayType("audio/ogg");
				if(canPlayType.match(/maybe|probably/i)) {
					audioElement.src = 'alarm.ogg';
				} else {
					audioElement.src = 'alarm.mp3';
				}
				// erst abspielen wenn genug vom mp3 geladen wurde
				audioElement.addEventListener('canplay', function() {
					audioElement.loop = true;
					audioElement.play();
				}, false);
			},
			showNumerals:true,
			brandText:'THOOYORK',
			brandText2:'Germany',
			onEverySecond:function(){
				//callback that should be fired every second
			},
			//alarmTime:'15:10',
			offAlarm:function(){
				$('#alarm1').hide();
				audioElement.pause();
				clearTimeout(intVal);
				$('body').css('background-color','#FCFCFC');
			}
		});
	});
});
</script>
@endsection
