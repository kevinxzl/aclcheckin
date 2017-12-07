<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>ACL Checkin</title>
    <link rel="stylesheet" href="{{asset('css/my.css')}}" />
    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="overflow:-Scroll;overflow-y:hidden">
<div class="all">

    <div class="top"><img src="{{asset('images/bg_top.png')}}" width="100%"></div>

    <div class="middle">
        <div class="page0mid"><img src="{{asset('images/bg_middle.png')}}" width="80%"></div>

        <div class="cell0">
            <form action="{{route('get_id')}}" method="get">
                <input type="text" class="nr0" id="conference_id" name="conference_id"/>
                <button class="btn0 hidden" id="get_id" style="position:relative; top:30px;"></button>

                <a href="{{route('search')}}">
      						<img class="btn0" src="{{asset('images/btn_seach1.png')}}"/>
      					</a>
            </form>
        </div>
    </div>

    <div class="bottom">
        <img src="{{asset('images/bg_bottom.png')}}" width="100%" />
    </div>

</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
