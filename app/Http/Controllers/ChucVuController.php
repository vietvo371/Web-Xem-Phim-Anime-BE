<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use App\Models\PhanQuyen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ChucVuController extends Controller
{
    public function getData()
    {
        $id_chuc_nang = 3;
        $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
        $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
        $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)
                            ->where('id_chuc_nang', $id_chuc_nang)
                            ->first();
        if(!$check) {
            return response()->json([
                'status'  =>  false,
                'message' =>  'Bạn không có quyền chức năng này'
            ]);
        }
        $dataAmin       = ChucVu::select('chuc_vus.*')
                         ->get(); // get là ra 1 danh sách
           return response()->json([
           'chuc_vu_admin'  =>  $dataAmin,
           ]);
    }

    public function taoChucVu(Request $request)
    {
        try {
            $id_chuc_nang = 3;
        $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
        $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
        $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)
                            ->where('id_chuc_nang', $id_chuc_nang)
                            ->first();
        if(!$check) {
            return response()->json([
                'status'  =>  false,
                'message' =>  'Bạn không có quyền chức năng này'
            ]);
        }
            ChucVu::create([
                'ten_chuc_vu'   =>$request->ten_chuc_vu,
                'slug_chuc_vu'  =>$request->slug_chuc_vu,
                'tinh_trang'    =>$request->tinh_trang,
                ]);
                return response()->json([
                    'status'   => true ,
                    'message'  => 'Bạn thêm Thể Chức Vụ thành công!',
                ]);
        } catch (ExceptionEvent $e) {
                return response()->json([
                    'status'     => false,
                    'message'    => 'Xoá Thể Chức Vụ không thành công!!'
                ]);
        }
    }
    public function timChucVu(Request $request)
    {
        $key    = '%'. $request->key . '%';
        $data   = ChucVu::select('chuc_vus.*')
                    ->where('ten_chuc_vu', 'like', $key)
                    ->get(); // get là ra 1 danh sách
        return response()->json([
        'chuc_vu_admin'  =>  $data,
        ]);
    }
    public function capnhatChucVu(Request $request)
    {
        try {
            $id_chuc_nang = 3;
            $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
            $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
            $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)
                                ->where('id_chuc_nang', $id_chuc_nang)
                                ->first();
            if(!$check) {
                return response()->json([
                    'status'  =>  false,
                    'message' =>  'Bạn không có quyền chức năng này'
                ]);
            }
            ChucVu::where('id', $request->id)
                    ->update([
                        'ten_chuc_vu'   =>$request->ten_chuc_vu,
                        'slug_chuc_vu'  =>$request->slug_chuc_vu,
                        'tinh_trang'    =>$request->tinh_trang,
                            ]);

            return response()->json([
                'status'     => true,
                'message'    => 'Đã Cập Nhật thành ' . $request->ten_the_loai,
            ]);
        } catch (Exception $e) {
            //throw $th;
            return response()->json([
                'status'     => false,
                'message'    => 'Cập Nhật Chức Vụ không thành công!!'
            ]);
        }
    }
    public function xoaChucVu($id)
    {
        try {
            $id_chuc_nang = 3;
            $user   = Auth::guard('sanctum')->user(); // Chính là người đang login
            $user_chuc_vu   = $user->id_chuc_vu;    // Giả sử
            $check  = PhanQuyen::where('id_chuc_vu', $user_chuc_vu)
                                ->where('id_chuc_nang', $id_chuc_nang)
                                ->first();
            if(!$check) {
                return response()->json([
                    'status'  =>  false,
                    'message' =>  'Bạn không có quyền chức năng này'
                ]);
            }
            ChucVu::where('id', $id)->delete();

            return response()->json([
                'status'     => true,
                'message'    => 'Đã xoá Chức vụ thành công!!'
            ]);
        } catch (ExceptionEvent $e) {
            //throw $th;
            return response()->json([
                'status'     => false,
                'message'    => 'Xoá Chức vụ không thành công!!'
            ]);

        }

    }
    public function thaydoiTrangThaiChucVu(Request $request)
    {
        try {
            $tinh_trang_moi = !$request->tinh_trang;
            //   $tinh_trang_moi là trái ngược của $request->tinh_trangs
            ChucVu::where('id', $request->id)
                    ->update([
                        'tinh_trang'    =>$tinh_trang_moi
                    ]);

            return response()->json([
                'status'     => true,
                'message'    => 'Cập Nhật Trạng Thái thành công!! '
            ]);
        } catch (Exception $e) {
            //throw $th;
            return response()->json([
                'status'     => false,
                'message'    => 'Cập Nhật Trạng Thái không thành công!!'
            ]);
        }
    }
    public function kiemTraSlugChucVu(Request $request)
    {
        $tac_gia = ChucVu::where('slug_chuc_vu', $request->slug)->first();

        if(!$tac_gia) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Tên Chức Vụ phù hợp!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tên Chức Vụ Đã Tồn Tại!',
            ]);
        }
    }
    public function kiemTraSlugChucVuUpdate(Request $request)
    {
        $mon_an = ChucVu::where('slug_chuc_vu', $request->slug)
                                     ->where('id', '<>' , $request->id)
                                     ->first();

        if(!$mon_an) {
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Tên Chức Vụ phù hợp!',
            ]);
        } else {
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Tên Chức Vụ Đã Tồn Tại!',
            ]);
        }
    }
}
