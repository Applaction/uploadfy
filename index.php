<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="jquery-1.7.2.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>

	
</script>
</head>

<body>
	<h1>Uploadify Demo</h1>
	<form>
		<div id="queue"></div><!--这个div，用来显示文件上传队列,通过queueID关联  可要可不要-->
               <div class='pic'></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>
	<div id="progress"></div><!--onUploadProgress事件使用-->
	<style type="text/css">
		.mybutton{border-radius: 5px;}
		.uploadify:hover .mybutton{border-radius: 5px;}
	</style>

	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({

				//uploadify.swf文件的路径。如果可能的话，这个路径应该是相对于根以避免出现问题，但也将接受相对于当前脚本的路径。
				//默认为uploadify.swf
				'swf'      : 'uploadify.swf',

				//服务端处理脚本
				'uploader' : 'uploadify.php',

				'buttonText':'浏览',//按扭的文字
				'height' : 30,//按扭高度
        		        'width' : 120 ,//按扭宽度
				
				/*按扭是一个div，在一个透明的flash下方*/
				
        		/*
        		选择文件按扭的css类名 默认是空字符串
					该按扭是一个div，默认样式写在uploadify.css中
					此buttonClass属性，给该div加入一个class，可以在里面覆盖原有样式
					也可以直接到uploadify.css修改样式
				*/
        		'buttonClass':'mybutton',


        		//浏览按扭光标是手形hand 还是指针arrow 默认是hand
				'buttonCursor' : 'arrow',
				//按扭图片
				//'buttonImage':'browse-btn.png',

				//检查服务器是否存在文件,返回0 或1
				//这个功能很少用，因为我们上传时，通常会生成一个不重复的文件
				//'checkExisting':'check-exists.php',

        		//一次选择多个文件，默认true
        		//'multi':false,
        		
        		//选择文件后自动上传，默认true
        		//如果设为false，需要手动调用上传方法 	<a href="javascript:$('#file_upload').uploadify('upload')">开始上传</a>
				//'auto':false,

				//开启调试模式，会在页面输出调试信息，默认为false
				//如果你想知道哪个事件在什么时候被调用，这是一个好方法
				//'debug':true,


				//文件上传对象的name值 默认是：Filedata
				//PHP服务端用 $_FILES['Filedata']
				//'fileObjName':'Filedata',

				//文件大小限制
				//单位可以是(B, KB, MB, or GB)  默认 KB  设为0表示不限制
				//'fileSizeLimit' : '100KB',

				//文件类型描述 点击浏览按扭，弹出的选择文件
				//可选择的文件的描述。此字符串出现在浏览文件对话框，在文件类型下拉。
				//默认是All Files  效果为 All Files
				//'fileTypeDesc':'选择文件',

				//允许上传的扩展名  在文件浏览窗口，将只显示这些扩展名文件
				//用户可以直接输入文件，来绕过此检查，php服务端还需要检查
				'fileTypeExts' : '*.gif; *.jpg; *.png; *.jpeg',

				/*表单数据
				服务端用$_POST['someKey']接收
				如果想动态设置，可以在onUploadStart事件中设置
				'onUploadStart' : function(file) {
		            $("#file_upload").uploadify("settings", "someKey", "someValue");
		        }
       			*/
				//'formData': {'someKey' : 'someValue', 'someOtherKey' : 1},
				

				//用什么方法上传，默认为post(建议)   可选get
				//无论是post或get都能上传文件，但会影响formData数据的接收
				//'method':'post',

				/*
				在ItemTemplate选项允许你指定一个特殊的HTML模板添加到队列中的每个项目。
				    模板中可用变量: instanceID、fileID 、fileName、fileSize、
				*/
				/*
				'itemTemplate' : '\
					<div id="${fileID}" class="uploadify-queue-item">\
                    <div class="cancel">\
                        <a href="javascript:$(\'#${instanceID}\').uploadify(\'cancel\', \'${fileID}\')">X</a>\
                    </div>\
                    <span class="fileName">${fileName} (${fileSize})</span>\
                    <span class="data"></span>\
                	</div>' ,
				//*/


				//自动删除上传完成的项，默认为true
				//'removeCompleted':false,

				//自动删除时的延时，默认3秒
				'removeTimeout':10,

				//取消事件
				//下面这样，将取消掉onUploadProgress和onUploadComplete事件
				//上传时，将不会更新进度条，完成后，也不会自动关闭文件列表
				//'overrideEvents':['onUploadComplete','onUploadProgress'],

				//防止缓存 默认为true，一个随机值将被添加到SWF文件的URL
				//'preventCaching':true,

				//进度条数据：百分比 percentage or 速度speed
				'progressData':'percentage',

				//文件上传队列，显示到哪个地方
				//例如：显示在id为queue的div中
				//没有指定此属性，则自动生成一个id为file_upload-queue的div
				'queueID'  : 'queue',

				/*
				队列长度限制
				在同一时间，可以在队列中的文件的最大数量。这不会限制可以上传文件的数量。可以上传的文件的数量进行限制，使用uploadLimit“。如果选择添加到队列中的文件数超过此限制，onSelectError的事件被触发。
				*/
				'queueSizeLimit':3,
				
				/*
				允许您上传的文件的最大数量。当达到或超过这个数字，onUploadError事件被触发。
				默认999
				*/
				'uploadLimit':2,

				//如果有误，是否自动多次偿试从新上传
				//'requeueErrors' : true,

				//文件发送完后，等待服务端响应的时间
				//如果超过此时间，还是没有响应，则onUploadSuccess事件回调时，
				//设置第三个参数response为false
				'successTimeout' : 5,

				//上传成功回调函数
        		'onUploadSuccess' : function(file, data, response) {
        			/*
        			file 已成功上传的文件对象
        				index [number]  文件索引(当前完成的是第几个，从0开始)
	        			name [string]	文件名
						size [number]   文件大小
						type [string]   文件类型(扩展名)  如png  jpg
					data 服务端返回的数据
					response boolean 服务端是否有响应。文件发送完后，如果等待一定时间后，
						服务器还是没有返回，则为false。测试时，加一个在接收文件上传的php文件最后，加一个sleep(40)，就能看到结果
						默认是30秒,可以通过successTimeout改变这个值。
						response并不能说明文件是否被成功上传，只是判断是否有服务端响应
					*/
                                var pic = "<img src='http://localhost/upload/uploads/"+data+"' />";
                                $('.pic').html(pic);                                
        			alert('已将'+file.name + '上传为：'+ data);
			    	
			    },

			    //上传完成
			    //会先调用onUploadSuccess然后才调用onUploadComplete
			    'onUploadComplete' : function(file) {
		                alert(file.name + '完成');
		            }

			   


			});
		});
	</script>


</body>
</html>
