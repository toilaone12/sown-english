<?php

namespace App\Http\Services;

use App\Repositories\QuestionRepositoryInterface;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class QuestionService
{
    protected $questionRepository;

    public function __construct(QuestionRepositoryInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    // Lấy danh sách câu hỏi
    public function list()
    {
        try {
            $lists = $this->questionRepository->all();
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

    // Thêm một câu hỏi mới
    public function insert(Request $request)
    {
        try {
            $all = $request->all();
            $request->validate([
                'name' => 'required',
                'type_id' => 'required|numeric',
            ], [
                'name.required' => 'Tên câu hỏi bắt buộc phải có',
                'type_id.required' => 'Số lượng câu hỏi bắt buộc phải có',
                'type_id.numeric' => 'Số lượng câu hỏi bắt buộc phải có',
            ]);
            // dd($all);
            $number = $all['type_id'];
            $arrAnswer = [''];
            $letters = ['A','B','C','D'];
            $jsonAnswer = '';
            if(isset($all['answer']) && $all['answer']) {
                $answers = $all['answer'];
                foreach ($answers as $index => $answer) {
                    if ($index < $number) $arrAnswer[$index+1][$letters[$index]] = $answer;
                }
                $arrAnswer = array_filter($arrAnswer);
                $jsonAnswer = json_encode($arrAnswer);
            }else{
                $jsonAnswer = '';
            }
            $insert = $this->questionRepository->create([
                'name' => $all['name'],
                'type_id' => $all['type_id'],
                'answer' => $jsonAnswer,
                'correct' => $all['correct'],
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

    // Lấy một câu hỏi
    public function getOne(Request $request)
    {
        try {
            $id = $request->get('id');
            $one = $this->questionRepository->find($id);
            return $id;
            return [
                'status' => 'success',
                'message' => 'Lấy câu hỏi thành công',
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

    // Cập nhật câu hỏi
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
            $update = $this->questionRepository->update([
                'name' => $all['name'],
                'number' => $all['number'],
            ],$id);
            if ($update) {
                return [
                    'status' => 'success',
                    'message' => 'Cập nhật câu hỏi thành công'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Không thể cập nhật câu hỏi vào cơ sở dữ liệu'
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

    // Xóa tạm thời câu hỏi
    public function delete(Request $request)
    {
        try {
            $id = $request->get('id');
            $delete = $this->questionRepository->delete($id);
            if ($delete) {
                return [
                    'status' => 'success',
                    'message' => 'Đã cho câu hỏi đó vào thùng rác'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Không thể xóa câu hỏi vào cơ sở dữ liệu'
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

    // Xem câu hỏi đã cho vào thùng rác
    public function trash()
    {
        try {
            // $data = Question::onlyTrashed()->get();
            $data = $this->questionRepository->allOnlyTrashed();
            return [
                'status' => 'success',
                'message' => 'Lấy câu hỏi thành công',
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
            $restore = $this->questionRepository->restoreTrashed($id);
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
