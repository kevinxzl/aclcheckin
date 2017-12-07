<?php


namespace App\Http\Controllers\Member;


use App\Http\Controllers\Controller;
use App\Entity\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    //首页搜索学生ID
    public function getMemberId(Request $request)
    {
        if($request->get("conference_id"))
        {
            $conference_id = $request->get("conference_id");
            $conference_id = trim($conference_id);
            $check_results = DB::table("ml_conference")->select()->where("conference_id" , $conference_id)->get();
            foreach($check_results as $v)
            {

            }
            if(isset($v))
            {
                return view("Member.result")->with("check_results" , $v);
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();
        }
    }
    /**
     * 搜索
     * @param Request $request
     * @return $this
     */
     public function getMemberInfo(Request $request)
     {
         if($request->get("telephone") || $request->get("id_name") || $request->get("conference_id") || $request->get("email"))
        {

            $arr = [];
            $arr["telephone"] = $request->get("telephone");
            $arr["id_name"] = $request->get("id_name");
            $arr["conference_id"] = $request->get("conference_id");
            $arr["email"] = $request->get("email");

            $arr["telephone"] = trim($arr["telephone"] );
            $arr["id_name"] = trim($arr["id_name"]);
            $arr["conference_id"] = trim($arr["conference_id"]);
            $arr["email"] = trim($arr["email"]);


            if($arr["conference_id"])
            {
                $conference_id_get_results = DB::table("ml_conference")->select()->where("conference_id" , "like" , "%" . $arr["conference_id"] . "%")->get();
                foreach($conference_id_get_results as $v)
                {

                }
                if(isset($v))
                {
                    return view("Member.result")->with("check_results" , $v);
                }else
                {
                    return redirect()->back();
                }
            }

            if($arr["telephone"]){
                $conference_id_get_results = DB::table("ml_conference")->select()->where("telephone" , $arr["telephone"])->get();
                foreach($conference_id_get_results as $v){

                }
                if(isset($v)){
                    return view("Member.result")->with("check_results" , $v);
                }else{
                    return redirect()->back();
                }
            }

            $results = DB::table("ml_conference")
                ->where("id_name" , "like" , "%" . $arr["id_name"] . "%")
                ->where("email" , "like" , "%" . $arr["email"] . "%")
                ->get();
            $arr = [];
            foreach($results as $va)
            {
                $arr[] = $va;
            }
            if(isset($va))
            {
                if(count($arr) < 2)
                {
                    foreach($arr as $value)
                    {
                        return view("Member.result")->with("check_results" , $value);
                    }
                }
                else
                {
                    return view("Member.multiple_results")->with("check_results" , $arr);
                }
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
          return redirect()->back();
        }
     }

    /**
     * 获取指定Id的信息
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getMultipleId()
    {
        $id = $_GET["id"];
        $results = DB::table("ml_conference")->select()->where("conference_id" , $id)->get();
        foreach($results as $v){

        }
        return view("Member.result")->with("check_results" , $v);
    }


    public function addmember(Request $request)
    {
        if($request->get("id_name") || $request->get("telephone") || $request->get("email") || $request->get("table_id") || $request->get("seat_id")){
            $id_name = $request->get("id_name");
            $telephone = $request->get("telephone");
            $email = $request->get("email");
            $table_id = $request->get("table_id");
            $seat_id = $request->get("seat_id");
            $birthday = date("Y-m-d");
            $date_added = date("Y-m-d H:i:s");
            $confirm_time = date("Y-m-d H:i:s");


                $db_results = DB::table("ml_conference")->insert(
                    array(
                      "id_name" => $id_name,
                      "telephone" => $telephone,
                      "email"  => $email,
                      "table_id" => $table_id,
                      "seat_id" => $seat_id,
                      "recommended_id" => 888888,
                      "recommended_name" => '88888',
                      "customer_name"    => '888888',
                      "birthday"         => $birthday,
                      "gender"           => 0,
                      "booking"          => 1,
                      "free_hotel"       => 0,
                      "date_added"       =>   $date_added,
                      "passport_status"  =>  1,
                      "room_type"        => 1,
                      "roommate_name"    => 'aaaa',
                      "roommate_phone"   => 8888,
                      "belong_system"    => '8888',
                      "confirm_time"     =>  $confirm_time,
                      "canceled"         => 0,
                      "checkin"          => 0,
                      "match_id"         => '8888'

                    ));

            if($db_results){
                return 1;
            }
        }
    }

    public function updateusercheckin(Request $request)
    {
        if($request->get("conference_id"))
        {
          $conference_id = $request->get("conference_id");
          $affected = DB::table('ml_conference')->where('conference_id',$conference_id)->update(['checkin'=>1]);
          if($affected)
          {
            return 1;
          }
        }
    }
}
