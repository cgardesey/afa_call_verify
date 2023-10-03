<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CallLogsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CallLog\DestroyCallLog;
use App\Http\Requests\Admin\CallLog\IndexCallLog;
use App\Http\Requests\Admin\CallLog\StoreCallLog;
use App\Http\Requests\Admin\CallLog\UpdateCallLog;
use App\Models\CallLog;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CallLogsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCallLog $request
     * @return Response|array
     */
    public function index(IndexCallLog $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(CallLog::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            [
//                'id',
                'caller_phonenumber',
                'callee_phonenumber',
//                'call_id',
//                'user_id'
            ],

            // set columns to searchIn
            [
//                'id',
                'caller_phonenumber',
                'callee_phonenumber',
//                'call_id'
            ]
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        $users = DB::table('users')->select('name', 'email')->get();

        return view('admin.call-log.index', [
            'data' => $data,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.call-log.create');

        return view('admin.call-log.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCallLog $request
     * @return Response|array
     */
    public function store(StoreCallLog $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the CallLog
        $callLog = CallLog::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/call-logs'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/call-logs');
    }

    /**
     * Display the specified resource.
     *
     * @param CallLog $callLog
     * @throws AuthorizationException
     * @return void
     */
    public function show(CallLog $callLog)
    {
        $this->authorize('admin.call-log.show', $callLog);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CallLog $callLog
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(CallLog $callLog)
    {
        $this->authorize('admin.call-log.edit', $callLog);


        return view('admin.call-log.edit', [
            'callLog' => $callLog,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCallLog $request
     * @param CallLog $callLog
     * @return Response|array
     */
    public function update(UpdateCallLog $request, CallLog $callLog)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values CallLog
        $callLog->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/call-logs'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/call-logs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCallLog $request
     * @param CallLog $callLog
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyCallLog $request, CallLog $callLog)
    {
        $callLog->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyCallLog $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyCallLog $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    CallLog::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    /**
     * Export entities
     *
     * @return BinaryFileResponse|null
     */
    public function export(): ?BinaryFileResponse
    {
        return Excel::download(app(CallLogsExport::class), 'callLogs.xlsx');
    }
}
