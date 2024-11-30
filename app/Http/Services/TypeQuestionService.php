<?php

namespace App\Http\Services;

use App\Repositories\TypeQuestionRepositoryInterface;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TypeQuestionService
{
    protected $typeQuestionRepository;

    public function __construct(TypeQuestionRepositoryInterface $typeQuestionRepository)
    {
        $this->typeQuestionRepository = $typeQuestionRepository;
    }

    // Lấy danh sách link liên kết
    public function list()
    {
        try {
            $lists = $this->typeQuestionRepository->all();
            return [
                'status' => 'success',
                'data' => $lists
            ];
        } catch (QueryException $e) {
            return [
                'status' => 'error',
                'message' => 'Lỗi truy vấn cơ sở dữ liệu: ' . $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Lỗi: ' . $e->getMessage()
            ];
        }
    }

    // Thêm một link liên kết mới
    public function insert(Request $request)
    {
        try {
            $all = $request->all();
            $request->validate([
                'name' => 'required',
                'number' => 'required|unique:type_question,number'
            ], [
                'name.required' => 'Tên thể loại bắt buộc phải có',
                'number.unique' => 'Chỉ nên chọn 1',
                'number.required' => 'Phải chọn số lượng',
            ]);
            $insert = $this->typeQuestionRepository->create([
                'name' => $all['name'],
                'number' => $all['number'],
            ]);
            if ($insert) {
                return [
                    'status' => 'success',
                    'message' => 'Thêm thành công'
                ];
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return [
                'status' => 'error',
                'message' => $e->errors()
            ];
        } catch (QueryException $e) {
            return [
                'status' => 'error',
                'message' => 'Lỗi truy vấn cơ sở dữ liệu: ' . $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ];
        }
    }

    // Lấy một link liên kết
    public function getOne(Request $request)
    {
        try {
            $id = $request->get('id');
            $one = $this->typeQuestionRepository->find($id);
            // $one = TypeQuestion::find($id);
            return [
                'status' => 'success',
                'message' => 'Lấy link liên kết thành công',
                'data' => $one
            ];
        } catch (QueryException $e) {
            return [
                'status' => 'error',
                'message' => 'Lỗi truy vấn cơ sở dữ liệu: ' . $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Lỗi: ' . $e->getMessage()
            ];
        }
    }

    // Cập nhật link liên kết
    public function update(Request $request)
    {
        try {
            $all = $request->all();
            $request->validate([
                'type' => 'required',
                'link' => 'required|url'
            ], [
                'type.required' => 'Loại liên kết bắt buộc phải có',
                'link.required' => 'Đường dẫn url bắt buộc phải có',
                'link.url' => 'Đường dẫn url phải đúng định dạng URL'
            ]);
            $update = $this->typeQuestionRepository->update([
                'type' => $all['type'],
                'link' => $all['link'],
                'admin_id' => 2,
            ],$all['id']);
            if ($update) {
                return [
                    'status' => 'success',
                    'message' => 'Cập nhật link liên kết thành công'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Không thể cập nhật link liên kết vào cơ sở dữ liệu'
                ];
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lỗi truy vấn cơ sở dữ liệu: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            // Xử lý các lỗi khác nếu có
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ], 500);
        }
    }

    // Xóa tạm thời sản phẩm
    public function delete(Request $request)
    {
        try {
            $id = $request->get('id');
            $delete = $this->typeQuestionRepository->delete($id);
            if ($delete) {
                return [
                    'status' => 'success',
                    'message' => 'Xóa thành link liên kết thành công'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Không thể xóa link liên kết vào cơ sở dữ liệu'
                ];
            }
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lỗi truy vấn cơ sở dữ liệu: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            // Xử lý các lỗi khác nếu có
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ], 500);
        }
    }

    // Xem link liên kết đã cho vào thùng rác
    public function trash()
    {
        try {
            // $data = TypeQuestion::onlyTrashed()->get();
            $data = $this->typeQuestionRepository->allOnlyTrashed();
            return [
                'status' => 'success',
                'message' => 'Lấy link liên kết thành công',
                'data' => $data
            ];
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lỗi truy vấn cơ sở dữ liệu: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ], 500);
        }
    }
}
