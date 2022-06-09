<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\RepositoryInterfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->userRepository->list();

        return $this->generateResponse(200, true, "User list found", $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->userRepository->add($request->all());
        return $this->generateResponse(200, true, "User added");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->show($id);

        return $this->generateResponse(200, true, "User details found", $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->userRepository->update($id, $request->all());
        return $this->generateResponse(200, true, "User updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return $this->generateResponse(200, true, "User removed");
    }

    private function generateResponse($code, $status, $message, $data = [])
    {
        return \response()->json([
            'code'     => $code,
            'status'   => $status,
            '$message' => $message,
            '$data'    => $data,
        ]);
    }
}
