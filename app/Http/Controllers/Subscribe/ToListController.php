<?php

namespace App\Http\Controllers\Subscribe;

use App\Exceptions\CouldNotSubscribeException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subscribe\ToListRequest;
use App\Services\Subscribe\ToListService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class ToListController extends Controller
{
    /**
     * @var ToListService
     */
    private $subscribeToListService;

    /**
     * ToListController constructor.
     * @param ToListService $toListService
     */
    public function __construct(ToListService $toListService)
    {
        $this->subscribeToListService = $toListService;
    }

    /**
     * Handle the incoming request.
     *
     * @param ToListRequest $request
     * @return JsonResponse
     */
    public function __invoke(ToListRequest $request)
    {
        $data = $request->only(ToListRequest::ATTRIBUTES);
        $payload = Collection::make($data);

        try {
            $this->subscribeToListService->handle($payload);
        } catch (CouldNotSubscribeException $exception) {
            return JsonResponse::create([
                'error' => $exception->getMessage()
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return JsonResponse::create(true, JsonResponse::HTTP_OK);
    }
}
