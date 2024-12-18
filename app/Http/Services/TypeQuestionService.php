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

    // Lấy danh sách thể loại câu hỏi
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

    // Thêm một thể loại câu hỏi mới
    public function insert(Request $request)
    {
        try {
            $all = $request->all();
            $request->validate([
                'name' => 'required',
                'number' => 'required|unique:type_question,number'
            ], [
                'name.required' => 'Tên thể loại bắt buộc phải có',
                'number.unique' => 'Đã tồn tại thể loại câu hỏi',
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

    // Lấy một thể loại câu hỏi
    public function getOne(Request $request)
    {
        try {
            $id = $request->get('id');
            $one = $this->typeQuestionRepository->find($id);
            return [
                'status' => 'success',
                'message' => 'Lấy thể loại câu hỏi thành công',
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

    // Cập nhật thể loại câu hỏi
    public function update(Request $request)
    {
        try {
            $all = $request->all();
            $id = $request->get('id');
            $request->validate([
                'name' => 'required',
                'number' => 'required'
            ], [
                'name.required' => 'Tên thể loại bắt buộc phải có',
                'number.required' => 'Phải chọn số lượng',
            ]);
            $update = $this->typeQuestionRepository->update([
                'name' => $all['name'],
                'number' => $all['number'],
            ],$id);
            if ($update) {
                return [
                    'status' => 'success',
                    'message' => 'Cập nhật thể loại câu hỏi thành công'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Không thể cập nhật thể loại câu hỏi vào cơ sở dữ liệu'
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
                    'message' => 'Đã cho thể loại câu hỏi đó vào thùng rác'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Không thể xóa thể loại câu hỏi vào cơ sở dữ liệu'
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

    // Xem thể loại câu hỏi đã cho vào thùng rác
    public function trash()
    {
        try {
            // $data = TypeQuestion::onlyTrashed()->get();
            $data = $this->typeQuestionRepository->allOnlyTrashed();
            return [
                'status' => 'success',
                'message' => 'Lấy thể loại câu hỏi thành công',
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
    //Khôi phục
    public function restore(Request $request)
    {
        try {
            $id = $request->get('id');
            $restore = $this->typeQuestionRepository->restoreTrashed($id);
            if($restore) {
                return [
                    'status' => 'success',
                    'message' => 'Khôi phục thành công',
                ];
            }
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
