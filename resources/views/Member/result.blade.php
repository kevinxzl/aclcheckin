<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>ACL Checkin</title>
    <link rel="stylesheet" href="{{asset('./css/my.css')}}" />
    <!-- Bootstrap -->
    <link href="{{asset('./css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="overflow:-Scroll;overflow-y:hidden">
<div class="all">

    <div class="top"><img src="{{asset('./images/bg_top.png')}}" width="100%"></div>

    <div class="middle">

        <div class="cell">
            <div class="left">
                <span class="span1">手机</span>
                <br/>
                <span class="span2">Cell</span>
            </div>
            <input type="text" class="nr" value="{{$check_results->telephone}}" readonly/><br>
        </div>

        <div class="cell">
            <div class="left">
                <span class="span1">姓名</span>
                <br/>
                <span class="span2">Name</span>
            </div>
            <input type="text" id="id_name" class="nr" value="{{$check_results->id_name}}" readonly/>
        </div>

        <div class="cell">
            <div class="left">
                <span class="span1">邮箱</span>
                <br/>
                <span class="span2">E-mail</span>
            </div>
            <input type="text" class="nr" value="{{$check_results->email}}" readonly/><br>
        </div>

        <div class="cell">
            <div class="left">
                <span class="span1">会议</span><span class="span2">ID</span>
                <br/>
                <span class="span2">Meeting ID</span>
            </div>
            <input type="text" class="nr" id="barcode" value="{{$check_results->conference_id}}"  readonly/><br/>
            <input type="text" class="nr hidden" id="checkin" value="{{$check_results->checkin}}"  readonly/><br/>
        </div>

        <div class="zh">
            <div class="left-f" style="margin-right: 18px;">
                <div class="left" style="margin-right: 18px;">
                    <span class="span1">桌号</span><br/>
                    <span class="span2">Table #</span>
                </div>
                <input type="text" id="table_id" class="nr-1" value="{{$check_results->table_id}}" readonly/>
            </div>

            <div class="left-r">
                <div class="left" style="margin-right: -8px;">
                    <span class="span1">座号</span><br/>
                    <span class="span2">Seat #</span>
                </div>
                <input type="text" id="seat_id" class="nr-1" value="{{$check_results->seat_id}}" readonly/>
            </div>
        </div>


        <div class="cell">
           <button class="btn" onclick="onPrintClick();"><img src="{{asset('./images/btn_print.png')}}" width="100%" height="100%"></button>
           <button class="btn" onclick="onBtnBack();"><img src="{{asset('./images/btn_back.png')}}" width="100%" height="100%"></button>
       </div>

    <div class="bottom">
        <img src="{{asset('images/bg_bottom.png')}}" width="100%" />
    </div>
</div>
</div>

<script type="text/html" id="modal-tpl">
  <form>
    <div class="form-group">
       <h3><span class="label label-danger">此用户已经打印过，请输入密码，确认再次打印！</span> </h3>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
  </form>
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('./js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('./js/bootstrap.min.js')}}"></script>
<script src="{{asset('./js/jQuery.Hz2Py-min.js')}}"></script>
<script src="{{asset('./js/LodopFuncs.js')}}"></script>
<script src="{{asset('./js/dialog.js')}}"></script>

<script type="text/javascript">
function onPrintClick()
{
  var checkin = $('#checkin').val();
  if(checkin == 0)
  {
    startPrint();
  }
  else
  {
    var modal = new Modal({
        title: '重复打印',
        content: $('#modal-tpl').html(),
        width: 500,
        onOk: function(){
            var $form = this.$modal.find('form');
            var data = $form.serializeArray();
            var postData = {};
            data.forEach(function(obj)
       {
               postData[obj.name] = obj.value;
            });

            var deferred = $.Deferred();
            if(!postData.password)
       {
                Confirm({
                    msg: 'Password为空，是否要继续？',
                    onOk: function(){
                        _post();
                    },
                    onCancel: function(){
                        deferred.reject();
                    }
                })
            }
       else
       {
                _post();
            }

            return $.when(deferred);

            function _post(){
                //模拟异步任务
                setTimeout(function()
         {
                    if(postData.password === '123')
           {
                        Alert({
                            msg: '开始打印！',
                            onOk: function(){
                                startPrint();
                                deferred.resolve();
                            }
                        });
                    }
           else
           {
                        Alert({
                            msg: '密码错误！',
                            onOk: function(){
                                deferred.reject();
                            }
                        });
                    }
                },30);
            }
        },
        onModalShow: function () {
            var $form = this.$modal.find('form');
            $form[0].reset();
        }
    });

    modal.open();
  }

}

function startPrint()
{
  CreatePrintPage();
  LODOP.PRINT();
  updateusercheckin();
}

function CreatePrintPage()
	{
    var username  = $('#id_name').val();
    var barcode   = $('#barcode').val();
    var table_id  = $('#table_id').val();
    var seat_id   = $('#seat_id').val();
    username = jQuery.trim(username);
    barcode  = jQuery.trim(barcode);
    table_id = jQuery.trim(table_id);
    seat_id  = jQuery.trim(seat_id);

    var pattern  =   /^([\u4E00-\u9FA5]|[\uFE30-\uFFA0])*$/gi;
    var isChinese = (pattern.test(username))?true:false;
    var firstname = '';
    var lastname = '';
    var pinyinname = '';
    if(isChinese)
    {
      var pinyin = $('#id_name').toPinyin();
      pinyin = jQuery.trim(pinyin);
      var fullname = new Array();
      fullname = pinyin.split(' ');
      var len = fullname.length;
      if( len == 3 )
      {
          lastname  = fullname[0];
          firstname = fullname[1] + fullname[2].toLowerCase();
      }
      if( username.length == 2 )
      {
        lastname  = fullname[0];
        firstname = fullname[1];
      }
      if( username.length == 4 )
      {
        lastname  = fullname[0] + fullname[1].toLowerCase();
        firstname = fullname[2] + fullname[3].toLowerCase();
      }
      pinyinname = firstname + '  ' + lastname;

    }

    LODOP.SET_LICENSES("","7D1FC053246D707DE4F13FED5F9890CF","C94CEE276DB2187AE6B65D56B3FC2848","");
		LODOP=getLodop();
		LODOP.PRINT_INIT("USACL");
		//LODOP.SET_PRINT_PAGESIZE(3, "79mm","10mm","CreateCustomPage");
		LODOP.SET_PRINT_PAGESIZE (2, 540, 700,"CreateCustomPage");//定义纸张，方向
		LODOP.SET_PRINT_STYLE("FontSize",25);
	//	LODOP.ADD_PRINT_TEXT(0,0,300,25,"李锋杰");
    LODOP.ADD_PRINT_TEXT(0,0,300,25,username);
		LODOP.SET_PRINT_STYLE("FontSize",20);
	//	LODOP.ADD_PRINT_TEXT(35,0,300,20,"Fengjie Li");
    LODOP.ADD_PRINT_TEXT(35,0,300,20,pinyinname);

		LODOP.SET_PRINT_STYLE("FontSize",12);
		LODOP.ADD_PRINT_TEXT(70,0,300,12, "桌号");
		LODOP.ADD_PRINT_TEXT(85,0,300,12, "Table#");


		LODOP.SET_PRINT_STYLE("FontSize",25);
    if (table_id != 0)
    {
      LODOP.ADD_PRINT_TEXT(68,60,300,25, table_id);
    }
    else
    {
      LODOP.ADD_PRINT_TEXT(68,60,300,25, "无");
    }


    LODOP.SET_PRINT_STYLE("FontSize",12);
		LODOP.ADD_PRINT_TEXT(70,143,300,12, "座号");
		LODOP.ADD_PRINT_TEXT(85,143,300,12, "Seat#");

		LODOP.SET_PRINT_STYLE("FontSize",25);
    if(seat_id != 0)
    {
      LODOP.ADD_PRINT_TEXT(68,193,300,25, seat_id);
    }
    else
     {
      LODOP.ADD_PRINT_TEXT(68,193,300,25, "无");
    }

		LODOP.SET_PRINT_STYLE("FontSize",8)
		LODOP.ADD_PRINT_BARCODE(120,0,200,60,"128A",barcode);

	};

  function onBtnBack()
  {
    location.href = "{{route('index')}}"
  }

  function updateusercheckin()
  {
    var $conference_id = $('#barcode').val();
    var $controller_url = "{{route('updateusercheckin')}}";
    $.ajax({
        type: "post",
        url: $controller_url,
        data: {conference_id : $conference_id ,  _token: "{{csrf_token()}}"},
        dataType: 'json',
        success: function(data) {
            if(data == 1){
                location.href = "{{route('index')}}";
            }
        }
    });
  }

</script>



</body>
</html>
