<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WarehouseModel;
use App\Models\SlotModel;
use App\Models\RackModel;
use App\Models\OrderModel;
use App\Models\OrderDataModel;
use App\Models\OrderDetailModel;
use App\Models\User;

use DB;
use Auth;
use Hash;

class SatkerController extends Controller
{
    public function index()
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $warehouse09    = DB::table('tbl_warehouses')
                            ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                            ->where('id_warehouse', 'G09')
                            ->get();

        $warehouse05B   = DB::table('tbl_warehouses')
                            ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                            ->where('id_warehouse', 'G05B')
                            ->get();

        $pallet         = DB::table('tbl_slots_names')
                            ->join('tbl_slots','tbl_slots.id_slot','tbl_slots_names.pallet_id')
                            ->get();

        $palletavail09  = DB::table('tbl_slots')->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->where('warehouse_id','G09')->where('slot_status','Tersedia')->count();

        $palletavail05b = DB::table('tbl_slots')->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->where('warehouse_id','G05B')->where('slot_status','Tersedia')->count();

        // SELECT RACK

        $rack_pallet_one_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','I')
                                ->where('rack_level','Bawah')
                                ->get();

        $rack_pallet_one_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','I')
                                ->where('rack_level','Atas')
                                ->get();

        $rack_pallet_two_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','II')
                                ->where('rack_level','Bawah')
                                ->get();
        $rack_pallet_two_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','II')
                                ->where('rack_level','Atas')
                                ->get();

        $rack_pallet_three_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','III')
                                ->where('rack_level','Bawah')
                                ->get();
        $rack_pallet_three_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','III')
                                ->where('rack_level','Atas')
                                ->get();  

        $rack_pallet_four_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','IV')
                                ->where('rack_level','Bawah')
                                ->get();
        $rack_pallet_four_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','IV')
                                ->where('rack_level','Atas')
                                ->get();

        return view('v_satker.index', compact('warehouse09','warehouse05B','pallet','rack_pallet_one_lvl1',
                'rack_pallet_one_lvl2','rack_pallet_two_lvl1','rack_pallet_two_lvl2','idorderdata','order_id',
                'rack_pallet_three_lvl1','rack_pallet_three_lvl2','rack_pallet_four_lvl1','rack_pallet_four_lvl2',
                'palletavail09','palletavail05b'));
    }

    // ====================
    // SLOT
    // ====================

    public function detailSlot($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $pallet_slot  = DB::table('tbl_slots')
                        ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->where('id_slot', $id)
                        ->get();

        $pbm_pallet_orderid  = DB::table('tbl_orders')
                                ->join('tbl_orders_data','tbl_orders_data.order_id','tbl_orders.id_order')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                                ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                                ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                                ->where('slot_id', $id)
                                ->where('id_order_data','like', 'PBM-%')
                                ->where('is_delete','false')
                                ->get();

        $pbk_pallet_orderid  = DB::table('tbl_orders')
                                ->join('tbl_orders_data','tbl_orders_data.order_id','tbl_orders.id_order')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                                ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                                ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                                ->where('slot_id', $id)
                                ->where('id_order_data','like', 'PBK-%')
                                ->where('is_delete','false')
                                ->get();

        $rack_slot    = DB::table('tbl_rack_details')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                        ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->where('id_slot', $id)
                        ->get();

        $pbm_entry      = DB::table('tbl_orders_detail')
                            ->select('tbl_orders.*','tbl_orders_data.*','tbl_slots.*','tbl_warehouses.*','tbl_item_category.*',
                                    'users.*','tbl_roles.*','tbl_workunits.*','tbl_slots_names.*','tbl_orders_detail.*')
                            ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                            ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                            ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                            ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                            ->join('tbl_slots_names','tbl_slots_names.pallet_id','tbl_slots.id_slot')
                            ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->join('users','users.id','tbl_orders.adminuser_id')
                            ->join('tbl_roles','tbl_roles.id_role','users.role_id')
                            ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                            ->where('slot_id',$id)
                            ->where('id_order_data','like', 'PBM-%')
                            ->where('is_delete','false')
                            ->get();

        $pbk_exit     = DB::table('tbl_orders_detail')
                            ->select('tbl_orders.*','tbl_orders_data.*','tbl_slots.*','tbl_warehouses.*','tbl_item_category.*',
                                    'users.*','tbl_roles.*','tbl_workunits.*','tbl_slots_names.*','tbl_orders_detail.*')
                            ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                            ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                            ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                            ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                            ->join('tbl_slots_names','tbl_slots_names.pallet_id','tbl_slots.id_slot')
                            ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->join('users','users.id','tbl_orders.adminuser_id')
                            ->join('tbl_roles','tbl_roles.id_role','users.role_id')
                            ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                            ->where('slot_id',$id)
                            ->where('id_order_data','like', 'PBK-%')
                            ->where('is_delete','false')
                            ->get();

        $pbm_entryrack   = DB::table('tbl_orders_detail')
                                ->select('tbl_orders.*','tbl_orders_data.*','tbl_slots.*','tbl_warehouses.*','tbl_orders_detail.*',
                                    'users.*','tbl_roles.*','tbl_workunits.*','tbl_rack_details.*','tbl_item_category.*')
                                ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                                ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                                ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                                ->join('tbl_rack_details','tbl_rack_details.id_slot_rack','tbl_orders_data.slot_id')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                                ->join('users','users.id','tbl_orders.adminuser_id')
                                ->join('tbl_roles','tbl_roles.id_role','users.role_id')
                                ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                                ->where('slot_id',$id)
                                ->where('id_order_data','like', 'PBM-%')
                                ->where('is_delete','false')
                                ->get();

        $pbk_exitrack   = DB::table('tbl_orders_detail')
                                ->select('tbl_orders.*','tbl_orders_data.*','tbl_slots.*','tbl_warehouses.*','tbl_orders_detail.*',
                                    'users.*','tbl_roles.*','tbl_workunits.*','tbl_rack_details.*','tbl_item_category.*')
                                ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                                ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                                ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                                ->join('tbl_rack_details','tbl_rack_details.id_slot_rack','tbl_orders_data.slot_id')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                                ->join('users','users.id','tbl_orders.adminuser_id')
                                ->join('tbl_roles','tbl_roles.id_role','users.role_id')
                                ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                                ->where('slot_id',$id)
                                ->where('id_order_data','like', 'PBK-%')
                                ->where('is_delete','false')
                                ->get();



        return view('v_satker/detail_slot',compact('pbm_entry','pbm_pallet_orderid','pbm_entryrack','pallet_slot',
                                                    'rack_slot','idorderdata','pbk_pallet_orderid','pbk_exit','pbk_exitrack'));
    }

    // ====================
    // PROFILE
    // ====================

    public function showProfile($id)
    {
        $satker = DB::table('users')->where('id', $id)->get();
        return view('v_satker/show_profile', compact('satker'));

    }

    public function editProfile(Request $request, $id)
    {
        $editprofile    = User::where('id',$id)
                            ->update([
                                'id'            => $request->id,
                                'workunit_id'   => $request->workunit_id,
                                'email'         => $request->email,
                                'username'      => $request->username,
                                'password'      => $request->password
                            ]);
        return redirect('satker/dashboard')->with('success','BERHASIL MENGUBAH DATA PROFIL !');
    }

    public function editPassword(Request $request, $id)
    {
        $cekpassword    = Hash::check($request->oldpassword, $request->cekpassword);
        
        if($cekpassword == 'true')
        {
            $editpassword    = User::where('id',$id)
                                    ->update([
                                        'password'  => Hash::make($request->password)
                                    ]);
            return redirect('signout')->with('success','BERHASIL MENGUBAH PASSWORD !');
        }

        return redirect('satker/show_profile/'. $id)->with('failed','PASSWORD LAMA ANDA SALAH !');
    }
}
