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

    <div class="top"><img src="{{asset('images/bg-top.jpg')}}" width="100%"></div>

      <div class="middle">

                <div class="cell">
                    <div class="left">
                        <span class="span1">姓名</span>
                        <br/>
                        <span class="span2">Name</span>
                    </div>
                    <input type="text" id="id_name" class="nr" name="id_name"/><br>
                </div>

              <div class="cell">
                  <div class="left">
                      <span class="span1">手机</span>
                      <br/>
                      <span class="span2">Cell</span>
                  </div>
                  <input type="text" id="telephone" class="nr" name="telephone"/><br>
              </div>



              <div class="cell">
                  <div class="left">
                      <span class="span1">邮箱</span>
                      <br/>
                      <span class="span2">E-mail</span>
                  </div>
                  <input type="text" id="email" class="nr" name="email"/><br>
              </div>

              <div class="zh">
                  <div class="left-f" style="margin-right: 18px;">
                      <div class="left" style="margin-right: 18px;">
                          <span class="span1">桌号</span><br/>
                          <span class="span2">Table #</span>
                      </div>
                      <input type="text" id="table_id" class="nr-1" name="table_id"  />
                  </div>

                  <div class="left-r">
                      <div class="left" style="margin-right: -8px;">
                          <span class="span1">座号</span><br/>
                          <span class="span2">Seat #</span>
                      </div>
                      <input type="text" id="seat_id" class="nr-1" name="seat_id"/>
                  </div>
              </div>


              <div class="form-group">
								<div class="col-sm-offset-2 col-sm-8">
									<button id="btnadd" class="btn btn-primary btn-sm">增加会员</button>
                  <button id="btnback" class="btn btn-primary btn-sm">返回</button>
								</div>
							</div>

      </div>


    <div class="bottom">
        <img src="{{asset('images/bg-bottom.jpg')}}" width="100%" />
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script>
    $(document).ready(function (){
      $("#btnadd").click(function (){
          var $id_name = $("#id_name").val();
          var $telephone = $("#telephone").val();
          var $email = $("#email").val();
          var $table_id = $("#table_id").val();
          var $seat_id = $("#seat_id").val();
          var $controller_url = "{{route('addmember_add')}}";
          $.ajax({
              type: "post",
              url: $controller_url,
              data: {id_name : $id_name , telephone : $telephone , email : $email , table_id : $table_id , seat_id : $seat_id,  _token: "{{csrf_token()}}"},
              dataType: 'json',
              success: function(data) {
                  if(data == 1){
                    //  alert("xxx");
                      location.href = "{{route('index')}}";
                  }
              }
          });
      })

          $("#btnback").click(function (){
              location.href = "{{route('index')}}"
          })

    })
</script>


</body>
</html>
