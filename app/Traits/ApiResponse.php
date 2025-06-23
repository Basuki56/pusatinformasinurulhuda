<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data, $message = null, $code = 200)
    {
        // Reorder jika data berupa objek atau array
        if (is_object($data)) {
            $data = $this->reorderIdFirst($data->toArray());
        } elseif (is_array($data) && isset($data[0])) {
            $data = array_map([$this, 'reorderIdFirst'], $data);
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    protected function errorResponse($message, $code = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => null
        ], $code, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Memastikan key 'id' berada paling atas
    private function reorderIdFirst(array $data)
    {
        if (!isset($data['id']))
            return $data;

        return array_merge(
            ['id' => $data['id']],
            collect($data)->except('id')->toArray()
        );
    }
}
