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
<body>
<div class="all">

    <div class="top"><img src="{{asset('images/bg_top.png')}}" width="100%"></div>

    @foreach($check_results as $v)
        <div class="middle">
            <a href="{{route('getMultipleId')}}?id={{$v->conference_id}}">
                <div class="cell">
                    <div class="left1">
                        <span class="span1" style="font-size:30px;">{{$v->id_name}}</span>
                    </div>
                    <span class="span2">{{$v->telephone}}</span></br>
                    <span class="span2">{{$v->email}}</span>
                </div>
            </a>
        </div><br/>
    @endforeach

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
