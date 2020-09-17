<?php


namespace App\Http\Controllers;


class ApiController extends Controller
{
    private $status;

    /**
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function response($data = null)
    {
        return response()->json([
            'data' => $data,
            'status' => $this->status
        ], $this->status);
    }

    /**
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseOk($data = null)
    {
        return $this->setStatus(200)->response($data);
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }
}
